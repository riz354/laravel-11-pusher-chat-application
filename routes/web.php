<?php

use App\Events\privateTestEvent;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Api\authController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {

    event(new privateTestEvent('Thanks Allah Almighty'));

    return view('welcome');
});



Route::post('/user/save', [UsersController::class, 'save'])->name('user.save');
Route::post('/user/check', [UsersController::class, 'check'])->name('user.check');
Route::get('/user/logout', [UsersController::class, 'logout'])->name('user.logout');
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/login', [UsersController::class, 'login'])->name('user.login');
Route::get('/user/profile', [UsersController::class, 'profile'])->name('user.profile');
Route::get('/user/register', [UsersController::class, 'register'])->name('user.register');
Route::get('/user/profileview', [UsersController::class, 'profile'])->name('user.profileview');
Route::get('/user/profileedit', [UsersController::class, 'edit'])->name('user.profileedit');
Route::put('/user/updateProfile', [UsersController::class, 'updateProfile'])->name('user.updateProfile');
Route::get('/user/dashboard', [UsersController::class, 'dashboard'])->name('user.dashboard');


Route::post('/admin/save', [AdminsController::class, 'save'])->name('admin.save');
Route::post('/admin/check', [AdminsController::class, 'check'])->name('admin.check');
Route::get('/admin/logout', [AdminsController::class, 'logout'])->name('admin.logout');
Route::get('/admin/profileview', [AdminsController::class, 'profile'])->name('admin.profileview');
Route::get('/admin/profileedit', [AdminsController::class, 'edit'])->name('admin.profileedit');
Route::get('/admin/login', [AdminsController::class, 'login'])->name('admin.login');
Route::get('/admin/profile', [AdminsController::class, 'profile'])->name('admin.profile');
Route::get('/admin/register', [AdminsController::class, 'register'])->name('admin.register');
Route::get('/admin/dashboard', [AdminsController::class, 'dashboard'])->name('admin.dashboard');
Route::put('/admin/updateProfile', [AdminsController::class, 'updateProfile'])->name('admin.updateProfile');

Route::get('/posts', [authController::class, 'posts']);

Route::middleware(['auth'])->group(function () {

    Route::get('/whats-up', [ChatController::class, 'index'])->name('whats-up');
    Route::post('/save-chat', [ChatController::class, 'saveChat'])->name('save-chat');
    Route::post('/load-chats', [ChatController::class, 'loadChats'])->name('load-chats');
    Route::post('/delete-chat', [ChatController::class, 'deleteChat'])->name('delete-chat');
});




// Route::middleware(['web'])->group(function () {
//     Route::post('/broadcasting/auth', function (Request $request) {
//         if (Session::has('LoggedUserInfo')) {
//             $user = User::find(Session::get('LoggedUserInfo'));
//             Auth::login($user);

//             return Broadcast::auth($request);
//         }

//         return response('Unauthorized', 403);
//     });
// });
// Route::post('/broadcasting/auth', function (Request $request) {
//     if (Auth::check()) {
//         // Log the authenticated user
//         Log::info('Authenticated User:', ['user' => Auth::user()]);
//         return Broadcast::auth($request);
//     }
//     return response('Unauthorized', 403);
// });

// Broadcast::routes();
