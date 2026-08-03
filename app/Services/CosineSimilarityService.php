<?php

namespace App\Services;

class CosineSimilarityService
{
    /**
     * Menghitung Cosine Similarity antar dua user.
     *
     * @param array $userA
     * @param array $userB
     * @return array
     */
    public function calculate(array $userA, array $userB): array
    {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        $coRated = 0;

        foreach ($userA as $productId => $ratingA) {

            $ratingB = $userB[$productId] ?? 0;

            // hanya produk yang dirating kedua user
            if ($ratingA == 0 || $ratingB == 0) {
                continue;
            }

            $coRated++;

            $dotProduct += ($ratingA * $ratingB);

            $normA += pow($ratingA, 2);

            $normB += pow($ratingB, 2);
        }

        /**
         * Minimal harus memiliki 3 produk yang sama-sama dirating.
         */
        if ($coRated < 3) {

            return [
                'similarity' => 0,
                'coRated' => $coRated,
            ];

        }

        if ($normA == 0 || $normB == 0) {

            return [
                'similarity' => 0,
                'coRated' => $coRated,
            ];

        }

        $similarity = $dotProduct / (sqrt($normA) * sqrt($normB));

        return [

            'similarity' => round($similarity, 4),

            'coRated' => $coRated,

        ];
    }
}