<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;

    public function __construct($user)
    {
    $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $response = Http::post(config('app.url') . '/api/store', $this->user);
            if ($response->successful()) {
                Log::info("User with email {$this->user['email']} successfully processed.");
            } else {
                Log::error("Failed to process user with email {$this->user['email']}: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("An error occurred while processing user {$this->user['email']}: " . $e->getMessage());
        }
    }
}
