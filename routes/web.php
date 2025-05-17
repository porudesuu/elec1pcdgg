<?php


use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ControlStructureController;
use App\Http\Controllers\manageEmployeeController;
use App\Http\Controllers\ShrekControlsMe;
use App\Http\Controllers\ControllerMW;
use App\Http\Controllers\ControllerLog;
use App\Http\Middleware\SessionUserAccountMW;
use App\Http\Controllers\studentController;
use App\Http\Controllers\manageClient;
use App\Http\Controllers\ClientController;

// Public routes
Route::get('/', function () {
    return view('login');
});

Route::get('/login', [UserAccountController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserAccountController::class, 'login'])->name('login');
Route::post('/logout', [UserAccountController::class, 'logout'])->name('logout');

// // Password update route (requires login but not admin)
// Route::middleware([SessionUserAccountMW::class])->group(function () {
//     Route::get('/update-password', [UserAccountController::class, 'showUpdatePasswordForm'])
//         ->name('update.password.form');
//     Route::post('/update-password', [UserAccountController::class, 'updatePassword'])
//         ->name('update.password');
// });

// Admin routes
Route::middleware(['web', SessionUserAccountMW::class, AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('administrator.dashboard');

    Route::get('/admin/create-user', [UserAccountController::class, 'showCreateUserForm'])
        ->name('create.user.form');
    Route::post('/admin/create-user', [UserAccountController::class, 'createUser'])
        ->name('create.user');
    Route::get('/user-accounts', [UserAccountController::class, 'showUserAccountsList'])
        ->name('user.accounts.list');

    Route::get('/user/{id}/edit', [UserAccountController::class, 'showEditUserForm'])
        ->name('user.edit');
    Route::put('/user/{id}', [UserAccountController::class, 'updateUser'])
        ->name('user.update');
    Route::delete('/user/{id}', [UserAccountController::class, 'deleteUser'])
        ->name('user.delete');
});

Route::middleware(['web', SessionUserAccountMW::class])->group(function () {
    // All authenticated routes go here
    Route::get('/update-password', [UserAccountController::class, 'showUpdatePasswordForm'])
        ->name('update.password.form');

    // Route::post('/update-password', [UserAccountController::class, 'updatePassword'])
    //     ->name('update.password');

    Route::post('/update-password', [UserAccountController::class, 'updatePassword'])
        ->name('update.password')
        ->middleware(['web', SessionUserAccountMW::class]);
});


Route::middleware(['web', SessionUserAccountMW::class])->group(function () {

});



// // Admin routes (requires login AND admin privileges)
// Route::middleware([SessionUserAccountMW::class, AdminMiddleware::class])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })
//         ->name('administrator.dashboard');
//     Route::get('/admin/create-user', [UserAccountController::class, 'showCreateUserForm'])
//         ->name('create.user.form');
//     Route::post('/admin/create-user', [UserAccountController::class, 'createUser'])
//         ->name('create.user');
//     Route::get('/user-accounts', [UserAccountController::class, 'showUserAccountsList'])
//         ->name('user.accounts.list');

//     // User management routes
//     Route::get('/user/{id}/edit', [UserAccountController::class, 'showEditUserForm'])
//         ->name('user.edit');
//     Route::put('/user/{id}', [UserAccountController::class, 'updateUser'])
//         ->name('user.update');
//     Route::delete('/user/{id}', [UserAccountController::class, 'deleteUser'])
//         ->name('user.delete');
// });

// Employee routes (requires login but not admin privileges)
Route::middleware([SessionUserAccountMW::class])->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('dashboardpage');
    })->name('employee.dashboard');
    Route::get('employee/contacts', [AdministratorController::class, 'contacts']);
    Route::get('employee/aboutus', [AdministratorController::class, 'aboutus']);
    Route::get('employee/cs/{score?}', [ControlStructureController::class, 'info']);
    Route::resource('/employee', manageEmployeeController::class);
    Route::get('/employee', [manageEmployeeController::class, 'index'])
        ->name('employeelist');
    Route::get('/employees/{id}/edit', [manageEmployeeController::class, 'edit'])
        ->name('employees.edit');
    Route::put('/employees/{id}', [manageEmployeeController::class, 'update'])
        ->name('employees.update');
    Route::get('/log', [ControllerLog::class, 'index']);
});

// Other public routes (no auth required)
Route::middleware(['web', SessionUserAccountMW::class])->group(function () {
    Route::get('/namedroute', [ShrekControlsMe::class, 'index'])->name('namedIndex');
    Route::get('/redirectnamedroute', function () {
        return redirect()->route("namedIndex");
    });

    Route::get('/downsyndrome', [ControllerMW::class, 'downdowndown'])->name('down');
    Route::get('/downdown', function () {
        return redirect()->route("downsyndrome");
    });
});

// Admin seed route (should be removed in production)
Route::get('/seed-admin', function () {
    \App\Models\UserAccount::create([
        'username' => 'admin',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'defaultpassword' => false
    ]);
    return 'Admin account created';
});



// Route::prefix('administrator')
//     ->middleware(['your-middleware-name'])
//     ->group(function () {
//         Route::get('/dashboard', [AdministratorController::class, 'dashboard'])->name('administrator.dashboard');
//         Route::get('/contacts', [AdministratorController::class, 'contacts']);
//         Route::get('/aboutus', [AdministratorController::class, 'aboutus']);
//         Route::get('/cs/{score?}', [ControlStructureController::class, 'info']);
//     });


// Route::middleware([SessionUserAccountMW::class])->group(function () {
//     // Route::get('/admin/create-user', [UserAccountController::class, 'showCreateUserForm'])->name('create.user.form');
//     // Route::post('/admin/create-user', [UserAccountController::class, 'createUser'])->name('create.user');

//     Route::group(['prefix' => 'administrator'], function () {
//         Route::get('/dashboard', [AdministratorController::class, 'dashboard'])->name('administrator.dashboard');
//         Route::get('/contacts', [AdministratorController::class, 'contacts']);
//         Route::get('/aboutus', [AdministratorController::class, 'aboutus']);
//         Route::get('/cs/{score?}', [ControlStructureController::class, 'info']);
//     });
// });

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::prefix('administrator')->group(function () {
//         Route::get('/dashboard', [AdministratorController::class, 'dashboard'])->name('administrator.dashboard');
//         Route::get('/contacts', [AdministratorController::class, 'contacts']);
//         Route::get('/aboutus', [AdministratorController::class, 'aboutus']);
//         Route::get('/cs/{score?}', [ControlStructureController::class, 'info']);
//     });
// });




// use App\Http\Controllers\AdministratorController;
// 
// use App\Http\Controllers\ConditionalsController;
// use App\Http\Controllers\ControllerLog;
// use App\Http\Controllers\ControllerMW;
// use App\Http\Controllers\ControlStructureController;
// use App\Http\Controllers\EmployeeController;
//
// use App\Http\Controllers\manageEmployeeController;
// use App\Http\Controllers\manageStudentController;
// use App\Http\Controllers\ShrekControlsMe;
// 
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\UserAccountController;
// use App\Http\Middleware\SessionUserAccountMW;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/required/{name}', [studentController::class, 'reqs']);
// Route::get('/optional', [studentController::class, 'ops']);
// Route::resource('/manageclientcontroller', manageClient::class);
// Route::get('/greet/{name?}', [ClientController::class, 'greet']);


// Route::get('/required/{name}', [studentController::class, 'reqs']);
// Route::get('/optional', [studentController::class, 'ops']);
// Route::resource('/manageclientcontroller', manageClient::class);
// Route::get('/greet/{name?}', [ClientController::class, 'greet']);


















