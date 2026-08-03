<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RatingMatrixService;
use App\Services\CosineSimilarityService;
use App\Services\RecommendationService;
use App\Models\Product;
use App\Models\Rating;


class RecommendationAnalysisController extends Controller
{
    public function index(
        RatingMatrixService $matrixService,
        CosineSimilarityService $similarityService,
        RecommendationService $recommendationService
    ) {

    $users = User::where('role', 'user')
        ->whereHas('ratings')
        ->withCount('ratings')
        ->orderBy('name')
        ->get();

    $userId = request('user_id');

    if (!$userId) {
    $userId = $users->first()->id;
    }

        $user = User::findOrFail($userId);
        

        $matrix = $matrixService->getMatrix();

        if (!isset($matrix[$userId])) {

    return view(
        'admin.recommendation-analysis.index',
        [
            'user' => $user,
            'userId' => $userId,
            'products' => Product::orderBy('id')->get(),

            'totalProducts' => Product::count(),
            'totalRatings' => 0,
            'unratedProducts' => Product::count(),
            'neighborCount' => 0,

            'matrix' => [],
            'similarities' => [],
            'topNeighbors' => [],
            'predictions' => collect(),
            'recommendations' => collect(),
        ]
    );
}

        $similarities = [];

        $totalProducts = Product::count();

        $totalRatings = Rating::where('user_id', $userId)->count();

        $unratedProducts = $totalProducts - $totalRatings;

        $neighborCount = count($similarities);

        foreach ($matrix as $otherUserId => $ratings) {

            if ($otherUserId == $userId) {
                continue;
            }

            $similarities[$otherUserId] =
                $similarityService->calculate(
                    $matrix[$userId],
                    $ratings
                );
        }

        arsort($similarities);

        $topNeighbors = array_slice(
            $similarities,
            0,
            5,
            true
        );

        $neighborCount = count($topNeighbors);
        
        $recommendations =
            $recommendationService
                ->getRecommendations($userId,8);

        $products = Product::orderBy('id')->get();

        $userNames = User::pluck('name', 'id');

        $predictions = $recommendationService
            ->getPredictedRatings($userId)
            ->take(10);

            return view(
            'admin.recommendation-analysis.index',
        compact(
            'users',
            'userNames',
            'user',
            'userId',
            'products',
            'totalProducts',
            'totalRatings',
            'unratedProducts',
            'neighborCount',
            'matrix',
            'similarities',
            'topNeighbors',
            'predictions',
            'recommendations'
        )
        );

    }
}