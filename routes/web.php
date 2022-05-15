<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::post('/', [FrontendController::class, 'membershipStore'])->name('membershipStore');
Route::get('/', [FrontendController::class, 'membershipIndex'])->name('front.index');
Route::get('membership-list', [FrontendController::class, 'memberlists'])->name('memberlists');
route::get('processSuccess', [FrontendController::class, 'processSuccess'])->name('processSuccess');
route::get('processCancel', [FrontendController::class, 'processCancel'])->name('processCancel');
route::get('membership-list', [FrontendController::class, 'membershipList'])->name('membershipList');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/change-user-status/{user}', [UserController::class, 'changeUserStatus'])->name('users.changeUserStatus');
    Route::resource('users', UserController::class);
});
