<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Paypal\PayPaypalController;
use App\Http\Controllers\Api\Stripe\PayStripeCardController;
use App\Http\Controllers\Api\Stripe\PayStripeLayoutController;
use App\Http\Controllers\Api\Stripe\CreateStripeCouponsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'v1',
    'as' => 'api.v1.',
], function () {
    Route::prefix('payment')->group(function () {
        Route::prefix('paypal')->group(function () {
            Route::post('create', [PayPaypalController::class, 'index'])
                ->name('payment.paypal.create');
        });
        Route::prefix('stripe')->group(function () {
            Route::middleware('user.stripe.customer')->group(function () {
                Route::post('stripe-layout', [PayStripeLayoutController::class, 'index'])
                    ->name('payment.stripe.stripe-layout');
            });
            Route::post('card', [PayStripeCardController::class, 'index'])
                ->name('payment.stripe.card');
        });
    });
    Route::prefix('stripe')->group(function () {
        Route::prefix('coupons')->group(function () {
            Route::post('create', [CreateStripeCouponsController::class, 'index'])
                ->name('stripe.coupons.create');
        });
    });
});
