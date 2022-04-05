<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ConsignerController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BrokerController;

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
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('/', App\Http\Controllers\DashboardController::class);

    Route::resource('users', UserController::class);
    Route::post('users/update-user', [UserController::class, 'updateUser']);
    Route::post('users/delete-user', [UserController::class, 'deleteUser']);

    Route::resource('roles', RoleController::class);
    Route::post('roles/add-role', [RoleController::class, 'addRole']);
    Route::post('roles/update-role', [RoleController::class, 'updateRole']);
    Route::post('roles/delete-role', [RoleController::class, 'deleteRole']);
    Route::any('roles/get-role', [RoleController::class, 'editRole']);

    Route::resource('permissions', PermissionController::class);

    Route::resource('branches', BranchController::class);
    Route::post('branches/update-branch', [BranchController::class, 'updateBranch']);
    Route::post('branches/delete-branch', [BranchController::class, 'deleteBranch']);
    Route::post('branches/delete-branchimage', [BranchController::class, 'deletebranchImage']);

    Route::resource('consigners', ConsignerController::class);
    Route::post('consigners/update-consigner', [ConsignerController::class, 'updateConsigner']);
    Route::post('consigners/delete-consigner', [ConsignerController::class, 'deleteConsigner']);

    Route::resource('consignees', ConsigneeController::class);
    Route::post('consignees/update-consignee', [ConsigneeController::class, 'updateConsignee']);
    Route::post('consignees/delete-consignee', [ConsigneeController::class, 'deleteConsignee']);

    Route::resource('brokers', BrokerController::class);
    Route::post('brokers/update-broker', [BrokerController::class, 'updateBroker']);
    Route::post('brokers/delete-broker', [BrokerController::class, 'deleteBroker']);
    Route::post('/brokers/delete-brokerimage', [BrokerController::class, 'deletebrokerImage']);

    Route::resource('drivers', DriverController::class);
    Route::post('drivers/update-driver', [DriverController::class, 'updateDriver']);
    Route::post('drivers/delete-driver', [DriverController::class, 'deleteDriver']);
    Route::post('/drivers/delete-licenseimage', [DriverController::class, 'deletelicenseImage']);

});

Route::get('forbidden-error', [App\Http\Controllers\DashboardController::class, 'ForbiddenPage']);