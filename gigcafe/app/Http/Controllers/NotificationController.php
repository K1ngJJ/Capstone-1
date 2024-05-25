<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications; // Assuming this is your Notifications model

class NotificationController extends Controller
{
    /**
     * Mark notification(s) as read.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function markNotification(Request $request)
    {
        $user = auth()->user();
        $notificationId = $request->input('id');

        if ($notificationId) {
            // Mark a specific notification as read and then delete it
            $notification = $user->unreadNotifications()->find($notificationId);
            if ($notification) {
                $notification->delete();
            }
        } else {
            // Mark all unread notifications as read and then delete them
            $user->unreadNotifications->each(function ($notification) {
                $notification->delete();
            });
        }

        return redirect()->back();
    }
}
