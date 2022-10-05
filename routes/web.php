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

Route::redirect('/', 'dashboard');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false
]);

Route::prefix('system')->group(function () {    

    Route::prefix('companies')->group(function () {    

        Route::match(['get', 'post'],'/',  [App\Http\Controllers\System\CompaniesController::class, 'index'])
        ->middleware(['permission:companies.index'])
        ->name('system.companies');

        Route::get('/register', [App\Http\Controllers\System\CompaniesController::class, 'register'])
        ->middleware(['permission:companies.create'])
        ->name('system.companies.register');
        Route::post('/store', [App\Http\Controllers\System\CompaniesController::class, 'store'])
        ->middleware(['permission:companies.create'])
        ->name('system.companies.store');

        Route::get('/edit/{id}', [App\Http\Controllers\System\CompaniesController::class, 'edit'])
        ->middleware(['permission:companies.update'])
        ->name('system.companies.edit');
        Route::post('/update/{id}', [App\Http\Controllers\System\CompaniesController::class, 'update'])
        ->middleware(['permission:companies.update'])
        ->name('system.companies.update');
    });

    Route::prefix('branches')->group(function () {    
        
        Route::match(['get', 'post'],'/', [App\Http\Controllers\System\BranchesController::class, 'index'])
        ->middleware(['permission:branches.index'])
        ->name('system.branches');

        Route::get('/register', [App\Http\Controllers\System\BranchesController::class, 'register'])
        ->middleware(['permission:branches.create'])
        ->name('system.branches.register');

        Route::post('/store', [App\Http\Controllers\System\BranchesController::class, 'store'])
        ->middleware(['permission:branches.create'])
        ->name('system.branches.store');

        Route::get('/edit/{id}', [App\Http\Controllers\System\BranchesController::class, 'edit'])
        ->middleware(['permission:branches.update'])
        ->name('system.branches.edit');

        Route::post('/update/{id}', [App\Http\Controllers\System\BranchesController::class, 'update'])
        ->middleware(['permission:branches.update'])
        ->name('system.branches.update');
    });

    Route::prefix('jop-position')->group(function () {
        Route::get('/', [App\Http\Controllers\System\JopPositionController::class, 'index'])
        ->middleware(['permission:jop.position.index'])
        ->name('system.jop.position.index');
        
        Route::get('/register', [App\Http\Controllers\System\JopPositionController::class, 'register'])
        ->middleware(['permission:jop.position.create'])
        ->name('system.jop.position.register');

        Route::post('/store', [App\Http\Controllers\System\JopPositionController::class, 'store'])
        ->middleware(['permission:jop.position.create'])
        ->name('system.jop.position.store');

        Route::get('/edit/{id}', [App\Http\Controllers\System\JopPositionController::class, 'edit'])
        ->middleware(['permission:jop.position.update'])
        ->name('system.jop.position.edit');
        
        Route::post('/update/{id}', [App\Http\Controllers\System\JopPositionController::class, 'update'])
        ->middleware(['permission:jop.position.update'])
        ->name('system.jop.position.update');
    });

    Route::prefix('departments')->group(function () {
        Route::get('/', [App\Http\Controllers\System\DepartmentsController::class, 'index'])
        ->middleware(['permission:departments.index'])
        ->name('system.departments');
        
        Route::get('/register', [App\Http\Controllers\System\DepartmentsController::class, 'register'])
        ->middleware(['permission:departments.create'])
        ->name('system.departments.register');
        
        Route::post('/store', [App\Http\Controllers\System\DepartmentsController::class, 'store'])
        ->middleware(['permission:departments.create'])
        ->name('system.departments.store');
        
        Route::get('/edit/{id}', [App\Http\Controllers\System\DepartmentsController::class, 'edit'])
        ->middleware(['permission:departments.update'])
        ->name('system.departments.edit');
        
        Route::post('/update/{id}', [App\Http\Controllers\System\DepartmentsController::class, 'update'])
        ->middleware(['permission:departments.update'])
        ->name('system.departments.update');
        
    });

    Route::prefix('users')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\UsersController::class, 'index'])
        ->middleware(['permission:users.index'])
        ->name('system.users');

        Route::get('/register', [App\Http\Controllers\System\UsersController::class, 'register'])
        ->middleware(['permission:users.create'])
        ->name('system.users.register');

        Route::post('/store', [App\Http\Controllers\System\UsersController::class, 'store'])
        ->middleware(['permission:users.create'])
        ->name('system.users.store');

        Route::get('/edit/{id}', [App\Http\Controllers\System\UsersController::class, 'edit'])
        ->middleware(['permission:users.update'])
        ->name('system.users.edit');

        Route::post('/update/{id}', [App\Http\Controllers\System\UsersController::class, 'update'])
        ->middleware(['permission:users.update'])
        ->name('system.users.update');

    });

    Route::prefix('roles')->group(function () {    
        Route::get('/', [App\Http\Controllers\System\RolesController::class, 'index'])
        ->middleware(['permission:roles.index'])
        ->name('system.roles');

        Route::get('/register', [App\Http\Controllers\System\RolesController::class, 'register'])
        ->middleware(['permission:roles.create'])
        ->name('system.roles.register');

        Route::post('/store', [App\Http\Controllers\System\RolesController::class, 'store'])
        ->middleware(['permission:roles.create'])
        ->name('system.roles.store');

        Route::get('/edit/{id}', [App\Http\Controllers\System\RolesController::class, 'edit'])
        ->middleware(['permission:roles.update'])
        ->name('system.roles.edit');

        Route::post('/update/{id}', [App\Http\Controllers\System\RolesController::class, 'update'])
        ->middleware(['permission:roles.update'])
        ->name('system.roles.update');

    });    
});

Route::prefix('hr')->group(function () {    
    
    Route::prefix('staff')->group(function (){
       
        Route::match(['get', 'post'],'/', [App\Http\Controllers\HumanResources\StaffController::class, 'index'])
        ->middleware(['permission:staff.index'])
        ->name('hr.staff');

        Route::get('/register', [App\Http\Controllers\HumanResources\StaffController::class, 'register'])
        ->middleware(['permission:staff.create'])
        ->name('hr.staff.register');

        Route::post('/store', [App\Http\Controllers\HumanResources\StaffController::class, 'store'])
        ->middleware(['permission:staff.create'])
        ->name('hr.staff.store');

        Route::get('/edit/{id}', [App\Http\Controllers\HumanResources\StaffController::class, 'edit'])
        ->middleware(['permission:staff.update'])
        ->name('hr.staff.edit');

        Route::post('/update/{id}', [App\Http\Controllers\HumanResources\StaffController::class, 'update'])
        ->middleware(['permission:staff.update'])
        ->name('hr.staff.update');  
        
        Route::get('/view/{id}', [App\Http\Controllers\HumanResources\StaffController::class, 'view'])
        ->middleware(['permission:staff.view'])
        ->name('hr.staff.view');


        Route::get('/unsubscribe/{id}', [App\Http\Controllers\HumanResources\StaffController::class, 'unsubscribe_from'])
        ->middleware(['permission:staff.unsubscribe'])
        ->name('hr.staff.unsubscribe');  

        Route::post('/unsubscribe', [App\Http\Controllers\HumanResources\StaffController::class, 'unsubscribe'])
        ->middleware(['permission:staff.unsubscribe'])
        ->name('hr.staff.post.unsubscribe');  

        Route::prefix('PDF')->group(function (){
            Route::get('/contract/{id}', [App\Http\Controllers\HumanResources\StaffController::class, 'pdf_contract'])
            //->middleware(['permission:staff.unsubscribe'])
            ->name('hr.staff.pdf.contract');  
        });
             
    });  
    
    Route::prefix('authorized-jop-vacancy')->group(function (){
        
        Route::match(['get', 'post'],'/', [App\Http\Controllers\HumanResources\AuthotizedJopVacancyController::class, 'index'])
        ->middleware(['permission:authorized.job.vacancies.index'])
        ->name('authorized.job.vacancies');

        Route::get('/config/{company_id}/{branch_id}', [App\Http\Controllers\HumanResources\AuthotizedJopVacancyController::class, 'config'])
        ->middleware(['permission:authorized.job.vacancies.config'])
        ->name('authorized.job.vacancies.config');

        Route::post('/config', [App\Http\Controllers\HumanResources\AuthotizedJopVacancyController::class, 'store'])
        ->middleware(['permission:authorized.job.vacancies.config'])
        ->name('authorized.job.vacancies.config.post');
        
        // Route::get('/view/{id}', [App\Http\Controllers\HumanResources\AuthotizedJopVacancyController::class, 'view'])
        // ->middleware(['permission:authorized.job.vacancies.view'])
        // ->name('authorized.job.vacancies.view');

    }); 

});


Route::prefix('recruitment')->group(function () {    
    Route::get('/census', [App\Http\Controllers\Recruitment\CensusController::class, 'index'])
    ->middleware(['permission:census.index'])
    ->name('census');
});

Route::prefix('ajax')->group(function () {    
    Route::post('/branches', [App\Http\Controllers\System\BranchesController::class, 'getJson']);
    Route::post('/states', [App\Http\Controllers\System\StatesController::class, 'getJson']);
});


