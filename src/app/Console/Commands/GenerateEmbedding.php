<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateEmbedding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-embedding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $users = User::whereNull('embedding')->take(20)->get();

        foreach ($users as $user) {
            $user->generateEmbedding();
            dump("=> " . $user->name . " embedding generated");
        };
    }
}
