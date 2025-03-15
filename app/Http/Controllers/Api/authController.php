<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    //

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'wrong credentials',
            ], 401);
        }

        $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'message' => 'login success'
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^\S*$/',
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        if ($user) {
            $token = $user->createToken($user->name . 'Auth-Token')->plainTextToken;
            return response()->json([
                'message' => 'reguister success',
                'token' => $token,

            ], 201);
        }else{
            return response()->json([
                'message' => 'something wriong',
            ], 500);
        }

    }


    public function posts()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        // Decode JSON data from response
        $posts = $response->json();

        // Return only the decoded data in JSON format
        return response()->json([
            'posts' => $posts
        ]);
    }


    public function checkAuth(Request $request)
    {

        return response()->json([
            'message' => 'Yes authenticated route good alhumdulillah'
        ]);
    }



    public function storeFile(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'file'=>'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'message'=>'validation failes',
                'errors' =>$validate->errors(),
            ]);
        }

       if($request->file('file')){
       $path =  $request->file('file')->store('filesPras','public');
       }

        return response()->json([
            'message' => 'Yes upload',
            'path' => $path
        ]);
    }



    public function storeFilePublic(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'file'=>'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'message'=>'validation failes',
                'errors' =>$validate->errors(),
            ]);
        }

       if($request->file('file')){
        $file = $request->file('file');

        $filename = $file->getFilename();
       $path =$file->move(public_path('images'),$filename);
       }

        return response()->json([
            'message' => 'Yes upload',
            'path' => $path
        ]);
    }




}
