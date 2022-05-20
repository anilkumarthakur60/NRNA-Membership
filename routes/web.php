<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Middleware\CorMiddleware;
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
Route::get('get-couple-price/{membertype}', [FrontendController::class, 'getcouplePrice'])->name('getcouplePrice');



Route::get('processSuccess', [FrontendController::class, 'processSuccess'])->name('processSuccess');
Route::get('processCancel', [FrontendController::class, 'processCancel'])->name('processCancel');
Route::get('membership-list', [FrontendController::class, 'membershipList'])->name('membershipList');

Route::get('join-link/invitation-link={user:referal_code}', [FrontendController::class, 'joinInvitaionLink'])->name('joinInvitaionLink');
Route::post('join-by-link/{user:referal_code}', [FrontendController::class, 'joinInvitaionLinkPost'])->name('joinInvitaionLinkPost');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'admin',
])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('users/change-user-status/{user}', [UserController::class, 'changeUserStatus'])->name('users.changeUserStatus');
    Route::get('users/donor-list', [UserController::class, 'donorList'])->name('users.donorList');
    Route::resource('users', UserController::class);
    Route::resource('userTypes', UserTypeController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    route::get('generate-link', [FrontendController::class, 'GenerateLink'])->name('generateLink');
    Route::get('donor/dashboard', [DashboardController::class, 'donor'])->name('donor.dashboard');
    Route::get('users/change-user-status/{user}', [UserController::class, 'changeUserStatus'])->name('users.changeUserStatus');
    Route::resource('users', UserController::class);
    Route::post('send-email-invitation-link', [DashboardController::class, 'sendInivationLink'])->name('sendInivationLink');
});
