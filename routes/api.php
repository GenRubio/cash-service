<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Paypal\PayPaypalController;
use App\Http\Controllers\Api\Stripe\PayStripeCardController;
use App\Http\Controllers\Api\Stripe\PayStripeLayoutController;
use App\Http\Controllers\Api\Stripe\Coupons\GetStripeCouponsController;
use App\Http\Controllers\Api\Stripe\Coupons\CreateStripeCouponsController;
use App\Http\Controllers\Api\Stripe\Coupons\DeleteStripeCouponsController;

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
    Route::prefix('stripe')->group(function () {
        Route::prefix('coupons')->group(function () {
            Route::post('create', [CreateStripeCouponsController::class, 'index'])
                ->name('stripe.coupons.create');
            Route::post('delete', [DeleteStripeCouponsController::class, 'index'])
                ->name('stripe.coupons.delete');
            Route::post('get', [GetStripeCouponsController::class, 'index'])
                ->name('stripe.coupons.get');
        });
        Route::prefix('payment')->group(function () {
            Route::middleware('user.stripe.customer')->group(function () {
                Route::post('stripe-layout', [PayStripeLayoutController::class, 'index'])
                    ->name('payment.stripe.stripe-layout');
            });
            Route::post('card', [PayStripeCardController::class, 'index'])
                ->name('payment.stripe.card');
        });
    });
    Route::prefix('paypal')->group(function () {
        Route::prefix('payment')->group(function () {
            Route::post('create', [PayPaypalController::class, 'index'])
                ->name('payment.paypal.create');
        });
    });
});
