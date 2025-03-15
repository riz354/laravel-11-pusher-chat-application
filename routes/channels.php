<?php

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('one-to-one-message', function ($user) {
    return Auth::check();
});

Broadcast::channel('my-channel', function ($user) {
    return $user;
});

Broadcast::channel('presence-user-status', function ($user) {
    return $user;
});

Broadcast::channel('broadcast-message', function ($user) {
    return $user;
});


Broadcast::channel('message-deleted', function ($user) {
    return $user;
});


// Broadcast::channel('one-to-one-message', function ($user) {
//     Log::info('User authorized for one-to-one-message channel: ', ['user' => $user]);
//     return Auth::check();
// });

// Route::post('/broadcasting/auth', function (Request $request) {
//     if (Session::has('LoggedUserInfo')) {
//         $user = User::find(Session::get('LoggedUserInfo'));
//         Log::info('User found:', ['user' => $user]);
//         Auth::login($user); // Ensure user is logged in
//         return Broadcast::auth($request); // Authenticate broadcasting request
//     }
//     Log::warning('Unauthorized access attempt');
//     return response('Unauthorized', 403);
// });
