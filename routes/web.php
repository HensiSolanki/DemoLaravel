<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::middleware("auth")->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, "index"])->name("home");
    Route::get("/profile", [App\Http\Controllers\HomeController::class, "profile"])->name("auth.profile");

    Route::get("/edit/password", [App\Http\Controllers\HomeController::class, "passwordEdit"])->name("changePassword");
    Route::post("/edit/password", [App\Http\Controllers\HomeController::class, "passwordUpdate"])->name("password.update");

    Route::get("/edit/profile", [App\Http\Controllers\HomeController::class, "edit"])->name("profile");
    Route::post("/edit/profile", [App\Http\Controllers\HomeController::class, "update"])->name("auth.editprofile");

    Route::resource('/products', ProductController::class);
});

  // Dashboard
    // Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    // // Login
    // Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    // Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
    // Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    // // Products
    // Route::get("/profile", [App\Http\Controllers\Admin\HomeController::class, 'profile'])->name("profile");
    // Route::resource('/products', [App\Http\Controllers\Admin\ProductController::class]);
    // Route::get("/users", [App\Http\Controllers\Admin\UsersController::class, 'index'])->name("userIndex");
    // Route::get("/users/view/{id}", [App\Http\Controllers\Admin\UsersController::class, 'show'])->name("userView");
    // Route::delete("/users/delete/{id}", [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name("userDelete");
    // Route::get('users/datatable', [App\Http\Controllers\Admin\UsersController::class, 'getUsers'])->name('list-users');

    // // Register
    // Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

    // // Reset Password
    // Route::get('password/reset',  [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // Route::post('password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    // Route::get('password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    // Route::post('password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

    // // Confirm Password
    // Route::get('password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    // Route::post('password/confirm', [App\Http\Controllers\Admin\Auth\ConfirmPasswordController::class, 'confirm']);
