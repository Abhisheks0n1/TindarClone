<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckPopularUsers extends Command
{
    protected $signature = 'users:check-popular';
    protected $description = 'Check users with more than 50 likes and email admin';

    public function handle()
    {
        $popularUsers = User::withCount('likesReceived')->having('likes_received_count', '>', 50)->get();

        if ($popularUsers->isNotEmpty()) {
            $message = "The following users have more than 50 likes:\n";
            foreach ($popularUsers as $user) {
                $message .= "- {$user->name} (ID: {$user->id}, Likes: {$user->likes_received_count})\n";
            }

            Mail::raw($message, function ($mail) {
                $mail->to(env('ADMIN_EMAIL'))
                     ->subject('Popular Users Notification');
            });

            $this->info('Email sent to admin.');
        } else {
            $this->info('No popular users found.');
        }
    }
}