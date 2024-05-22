<?php

namespace App\Listeners;

use App\Notifications\NewUserNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    public function handle(Registered $event)
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewUserNotification($event->user));
    }
}