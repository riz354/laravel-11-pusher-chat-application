<?php

namespace App\Services;

use App\Jobs\UserProcessJob;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class UserService
{
    public function processUsers()
    {
        $path = storage_path('app/users.json');


        if (!file_exists($path)) {
            Log::error('Users file not found.');
            return;
        }

        $users = json_decode(file_get_contents($path), true);

        if (empty($users)) {
            Log::error('No users found in the file.');
            return;
        }

        foreach ($users as $user) {
            try {

                // UserProcessJob::dispatch($user);
                // new UserProcessJob($user);
                dispatch(new UserProcessJob($user));

                Log::info("Dispatched job for user with email {$user['email']}.");

                // $response = Http::post(config('app.url') . '/api/store', $user);
                // if ($response->successful()) {
                //     Log::info("User with email {$user['email']} successfully processed.");
                // } else {
                //     Log::error("Failed to process user with email {$user['email']}: " . $response->body());
                // }
            } catch (\Exception $e) {
                Log::error("An error occurred while processing user {$user['email']}: " . $e->getMessage());
            }
        }
    }
}
