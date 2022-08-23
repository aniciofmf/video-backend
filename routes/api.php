<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout']);
Route::patch('/changepassword', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword']);


Route::get('/user', [App\Http\Controllers\Auth\UserController::class, 'getUser']);
Route::get('/user/usage', [App\Http\Controllers\UserUsageController::class, 'getStorageUsage']);


Route::get('/files', [App\Http\Controllers\FileController::class, 'index']);
Route::post('/files', [App\Http\Controllers\FileController::class, 'store']);
Route::delete('/files/{file:uuid}', [App\Http\Controllers\FileController::class, 'destroy']);
Route::post('/files/signed', [App\Http\Controllers\FileController::class, 'signedURL']);

Route::get('/plans', [App\Http\Controllers\PlanController::class, 'getPlans']);
Route::get('/subscriptions/intent', [App\Http\Controllers\StripeIntentController::class, 'getClientSecret']);

Route::post('/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'createSubscription']);
Route::get('/subscriptions/plans', [App\Http\Controllers\UserPlanAvailabilityController::class, 'getPlans']);
Route::patch('/subscriptions/swap', [App\Http\Controllers\SubscriptionController::class, 'swapSubscription']);

Route::post('/file/{file:uuid}/share', [App\Http\Controllers\FileShareController::class, 'createShareURL']);
Route::get('/file/{file:uuid}/download', [App\Http\Controllers\FileShareController::class, 'downloadFile']);