<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// =========================
// ADMIN CONTROLLERS
// =========================
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;
use App\Http\Controllers\Admin\RecommendationAnalysisController;
// =========================
// SELLER CONTROLLERS
// =========================
use App\Http\Controllers\Admin\SellerController;

// =========================
// FRONTEND CONTROLLERS
// =========================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\RatingController;

// =========================
// COSINE SIMILIARITY - TEST MATRIX
// =========================
use App\Services\CosineSimilarityService;
use App\Services\RatingMatrixService;

use App\Models\Rating;

Route::get('/cek-rating-user', function () {

    dd(
        Rating::where('user_id', 2)->count()
    );

});

Route::get('/cek-matrix', function (
    App\Services\RatingMatrixService $matrix
) {

    $ratings = $matrix->getMatrix()[2];

    dd(array_filter($ratings));

});

Route::get('/test-recommendation', function (
    App\Services\RecommendationService $service
) {

    dd(
        $service->getRecommendations(2)
    );

});
Route::get('/cek-rating', function (
    App\Services\RatingMatrixService $matrix
) {
    dd(count($matrix->getMatrix()[2]));
    
});
// Route::get('/test-similarity', function (
//     RatingMatrixService $matrix
    
// ) {

//     $ratings = $matrix->getMatrix();

//    dd([
//     'User 2' => $ratings[2],
//     'User 10' => $ratings[10],
// ]);

// });

Route::get('/test-similarity', function (
    RatingMatrixService $matrix,
    CosineSimilarityService $cosine
) {

    $ratings = $matrix->getMatrix();

    foreach ($ratings as $userA => $vectorA) {

        foreach ($ratings as $userB => $vectorB) {

            if ($userA == $userB) {
                continue;
            }

           $result = $cosine->calculate($vectorA, $vectorB);

echo
"User {$userA} ↔ User {$userB}
 | Similarity = {$result['similarity']}
 | Co-Rated = {$result['coRated']}
 <br>";

        }

        echo "<hr>";
    }

});

Route::get('/test-matrix', function (RatingMatrixService $service) {

    dd($service->getMatrix());

});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/{product}', [FrontendProductController::class, 'show'])
    ->name('products.show');

Route::get('/search-products', [HomeController::class, 'search'])
    ->name('products.search');

Route::get('/products/{product}', [FrontendProductController::class, 'show'])
    ->name('products.show');
/*
|--------------------------------------------------------------------------
| USER ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','user'])->group(function () {

    // =====================
    // CART
    // =====================

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{product}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::post('/cart/increase/{product}', [CartController::class, 'increase'])
        ->name('cart.increase');

    Route::post('/cart/decrease/{product}', [CartController::class, 'decrease'])
        ->name('cart.decrease');

    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // =====================
    // CHECKOUT
    // =====================


    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');
    
    Route::get('/checkout/{order}/payment', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

    Route::post('/checkout/{order}/payment', [CheckoutController::class, 'confirmPayment'])
    ->name('checkout.confirm');

    // =====================
    // USER ORDERS
    // =====================

    Route::get('/orders', [FrontendOrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{order}', [FrontendOrderController::class, 'show'])
        ->name('orders.show');

        

    // =====================
    // RATINGS
    // =====================

    Route::post('/ratings/{product}', [RatingController::class, 'store'])
        ->name('ratings.store');

    // =====================
    // PROFILE
    // =====================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::resource('products', ProductController::class);

        // Route::resource('orders', AdminOrderController::class);

        Route::resource('orders', AdminOrderController::class)
    ->only([
        'index',
        'show',
        'update'
    ]);

    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])
        ->name('orders.destroy');
    

    Route::resource('users', UserController::class)
    ->only(['index', 'show', 'update']);

     Route::resource('ratings', AdminRatingController::class)
    ->only(['index']);

    Route::resource('sellers', SellerController::class);
    });

Route::get(
    '/admin/recommendation-analysis',
    [RecommendationAnalysisController::class, 'index']
)->name('recommendation.analysis');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';