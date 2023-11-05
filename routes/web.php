<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FormStatusController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardStatController;
use App\Http\Controllers\DashboardStatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
//admin use prefix 'admin' and fix route that have /admin
Route::get('/api/users', [UserController::class, 'index']);
Route::post('/api/users', [UserController::class, 'store']);
Route::patch('/api/users/{user}/change-role', [UserController::class, 'changeRole']);
Route::put('/api/users/{user}', [UserController::class, 'update']);
Route::delete('/api/users/{user}', [UserController::class, 'destroy']);
Route::delete('/api/users', [UserController::class, 'bulkDelete']);


Route::get('/api/form-status', [FormStatusController::class, 'getStatusWithCount']);
Route::get('/api/forms', [FormController::class, 'index']);
Route::post('/api/forms/create', [FormController::class, 'store']);
Route::get('/api/forms/{form}/edit', [FormController::class, 'edit']);
Route::put('/api/forms/{form}/edit', [FormController::class, 'update']);
Route::delete('/api/forms/{form}', [FormController::class, 'destroy']);


Route::get('/api/profile', [ProfileController::class, 'index']);
Route::put('/api/profile', [ProfileController::class, 'update']);
Route::post('/api/change-user-password', [ProfileController::class, 'changePassword']);

});

Route::get('{redirects}',HomeController::class)->where('redirects','(.*)')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});