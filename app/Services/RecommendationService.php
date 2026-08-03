<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Rating;

class RecommendationService
{
    protected RatingMatrixService $matrixService;
    protected CosineSimilarityService $cosineService;

    public function __construct(
        RatingMatrixService $matrixService,
        CosineSimilarityService $cosineService
    ) {
        $this->matrixService = $matrixService;
        $this->cosineService = $cosineService;
    }

    public function getRecommendations(
    int $userId,
    int $limit = 8
    
)


{
    // Ambil rating matrix
    $matrix = $this->matrixService->getMatrix();

    if (!isset($matrix[$userId])) {
        return collect();
    }

    // Top-K Neighbor
    $similarUsers = $this->getSimilarUsers($userId);

    if (empty($similarUsers)) {
        return collect();
    }

    // Produk yang sudah dirating user
    $ratedProducts = [];

foreach ($matrix[$userId] as $productId => $rating) {

    if ($rating > 0) {

        $ratedProducts[] = $productId;

    }

}

    // Seluruh produk
    $products = Product::all();

    $predictions = [];

    foreach ($products as $product) {

        // Skip produk yang sudah pernah dirating
        if (in_array($product->id, $ratedProducts)) {
            continue;
        }

        $score = $this->predictRating(
            $userId,
            $product->id,
            $similarUsers
        );

        if ($score > 0) {

            $predictions[] = [

                'product' => $product,

                'score' => $score,

            ];

        }

    }

    // Urutkan berdasarkan prediksi tertinggi
    usort($predictions, function ($a, $b) {

        return $b['score'] <=> $a['score'];

    });

    return collect($predictions)
        ->take($limit);
}

    private function getSimilarUsers(int $userId): array
{
    // Ambil rating matrix
    $matrix = $this->matrixService->getMatrix();

    // Jika user tidak memiliki rating
    if (!isset($matrix[$userId])) {
        return [];
    }

    $currentUserRatings = $matrix[$userId];

    $similarities = [];

    foreach ($matrix as $otherUserId => $ratings) {

        if ($otherUserId == $userId) {
            continue;
        }

        $result = $this->cosineService->calculate(
            $currentUserRatings,
            $ratings
        );

        // Abaikan similarity = 0
        if ($result['similarity'] <= 0) {
            continue;
        }

        $similarities[$otherUserId] = $result['similarity'];
    }

    // Urutkan dari terbesar
    arsort($similarities);

    // Ambil Top 5 Neighbor
    return array_slice(
        $similarities,
        0,
        5,
        true
    );
}

public function getPredictedRatings(int $userId)
{
    $recommendations = $this->getRecommendations($userId, 100);

    return $recommendations;
}

   private function getAverageRating(array $ratings): float
{
    $ratings = array_filter($ratings);

    if (count($ratings) === 0) {
        return 0;
    }

    return array_sum($ratings) / count($ratings);
}

  private function predictRating(
    int $userId,
    int $productId,
    array $similarUsers
): float
{
    $matrix = $this->matrixService->getMatrix();

    $activeUserAverage = $this->getAverageRating(
        $matrix[$userId]
    );

    $numerator = 0;
    $denominator = 0;

    foreach ($similarUsers as $neighborId => $similarity) {

        if (
            !isset($matrix[$neighborId][$productId]) ||
            $matrix[$neighborId][$productId] == 0
        ) {
            continue;
        }

        $neighborAverage = $this->getAverageRating(
            $matrix[$neighborId]
        );

        $rating = $matrix[$neighborId][$productId];

        $numerator +=
            $similarity *
            ($rating - $neighborAverage);

        $denominator += abs($similarity);
    }

    if ($denominator == 0) {
        return 0;
    }

   $prediction = $activeUserAverage +
    ($numerator / $denominator);

// Batasi ke rentang rating 1–5
$prediction = max(1, min(5, $prediction));

return round($prediction, 4);
}
}