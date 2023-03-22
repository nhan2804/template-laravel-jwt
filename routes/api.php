<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ExportTicketController;
use App\Http\Controllers\ImportTicketController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StorageController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'userProfile']);
    Route::post(
        '/change-pass',
        [
            AuthController::class, 'changePassWord'
        ]
    );
});
Route::group([
    'middleware' => 'api',
], function () {
    Route::resource('products', ProductController::class);
    Route::resource('storages', StorageController::class);
    Route::resource('ticket/import', ImportTicketController::class);
    Route::resource('ticket/export', ExportTicketController::class);
    Route::resource('storages/{storage_id}/inventory', InventoryController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
