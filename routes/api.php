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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// AUTHENTICATION FOR API
Route::post('/auth', [App\Http\Controllers\AuthApi\AuthController::class, 'auth'] );

// * PROTECTED ROUTES
Route::middleware(['auth:sanctum'])->group(function() {

    Route::prefix('companies')->group(function(){
        Route::get('/with/rfc', [App\Http\Controllers\Api\System\CompaniesController::class, 'getListWithRfc'] );    
    });

    Route::prefix('staff')->group(function(){
        // * REGISTER STAFF
        Route::post('/register', [App\Http\Controllers\Api\HumanResources\StaffController::class, 'store'] );    
    });

    // * LOGOUT
    Route::get('/logout', [App\Http\Controllers\AuthApi\AuthController::class, 'logout'] );
});

Route::post('/test', function(){
    return 'hello';
});