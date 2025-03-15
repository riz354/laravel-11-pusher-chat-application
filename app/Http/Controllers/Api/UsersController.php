<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function store(Request $request)
    {

        // dd($request->all());
        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email'
            ],
            [
                'name.required' => 'Name is Required',
                'email.required' => 'Email is Required',
                'email.unique' => 'Email should unique. User is already registered with this email',
            ]
        );

        if ($validated->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validated->errors(),
            ]);
        }

        $user = User::updateOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User Registered Successfully'
        ]);
    }



    // public function processUsers()
    // {
    //     $path = storage_path('app/users.json');
    //     $users = json_decode(file_get_contents($path), true);
    //     foreach ($users as $user) {
    //         $existingUser = User::where('email', $user['email'])->first();
    //         if ($existingUser) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => "User with email {$user['email']} already exists."
    //             ], 400);
    //         }

    //         // $response = Http::post('api.store', $user);
    //         $response = Http::post(url('/api/store'), $user);

    //         // $request = new Request($user);
    //         // $response = $this->store($request);

    //         // if ($response->successful()) {
    //         //     echo "User {$user['email']} successfully processed.\n";
    //         // } else {
    //         //     // If there's an error, log the error message
    //         //     echo "Failed to process user {$user['email']}: {$response->body()}\n";
    //         // }
    //     }

    //     // Return a success response after processing all users
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'All users processed successfully.'
    //     ], 200);  // 200 - OK
    // }
}
