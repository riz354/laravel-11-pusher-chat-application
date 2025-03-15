<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\UsersController;
use App\Services\UserService;
use Illuminate\Console\Command;

class ProcessUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-user-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }


    public function handle(UserService $service)
    {
       $test = $service->processUsers();
    //    dd($test);
    }
}
