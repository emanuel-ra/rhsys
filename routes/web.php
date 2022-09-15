<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('system')->group(function () {    

    Route::prefix('companies')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\CompaniesController::class, 'index'])->name('system.companies');
        Route::get('/register', [App\Http\Controllers\System\CompaniesController::class, 'register'])->name('system.companies.register');
        Route::post('/store', [App\Http\Controllers\System\CompaniesController::class, 'store'])->name('system.companies.store');
        Route::get('/edit/{id}', [App\Http\Controllers\System\CompaniesController::class, 'edit'])->name('system.companies.edit');
        Route::post('/update/{id}', [App\Http\Controllers\System\CompaniesController::class, 'update'])->name('system.companies.update');
    });

    Route::prefix('branches')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\BranchesController::class, 'index'])->name('system.branches');
        Route::get('/register', [App\Http\Controllers\System\BranchesController::class, 'register'])->name('system.branches.register');
        Route::post('/store', [App\Http\Controllers\System\BranchesController::class, 'store'])->name('system.branches.store');
        Route::get('/edit/{id}', [App\Http\Controllers\System\BranchesController::class, 'edit'])->name('system.branches.edit');
        Route::post('/update/{id}', [App\Http\Controllers\System\BranchesController::class, 'update'])->name('system.branches.update');
    });

    Route::prefix('users')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\UsersController::class, 'index'])->name('system.users');
        Route::get('/register', [App\Http\Controllers\System\UsersController::class, 'register'])->name('system.users.register');
        Route::post('/store', [App\Http\Controllers\System\UsersController::class, 'store'])->name('system.users.store');
        Route::get('/edit/{id}', [App\Http\Controllers\System\UsersController::class, 'edit'])->name('system.users.edit');
        Route::post('/update/{id}', [App\Http\Controllers\System\UsersController::class, 'update'])->name('system.users.update');
    });

    Route::prefix('roles')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\RolesController::class, 'index'])->name('system.roles');
        Route::get('/register', [App\Http\Controllers\System\RolesController::class, 'register'])->name('system.roles.register');
        Route::post('/store', [App\Http\Controllers\System\RolesController::class, 'store'])->name('system.roles.store');
        Route::get('/edit/{id}', [App\Http\Controllers\System\RolesController::class, 'edit'])->name('system.roles.edit');
        Route::post('/update/{id}', [App\Http\Controllers\System\RolesController::class, 'update'])->name('system.roles.update');
    });
    
});

Route::prefix('recruitment')->group(function () {
    Route::get('/census', [App\Http\Controllers\Recruitment\CensusController::class, 'index'])->name('home');
});
