<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

/**
 * CustomNotification Model
 * 
 * This model extends the default DatabaseNotification to add custom functionality
 * for handling notifications.
 */
class Notifications extends DatabaseNotification
{
    /**
     * Mark the notification as read.
     *
     * @return bool
     */
    public function markAsRead()
    {
        return $this->update(['read_at' => now()]);
    }

    /**
     * Mark the notification as unread.
     *
     * @return bool
     */
    public function markAsUnread()
    {
        return $this->update(['read_at' => null]);
    }

    /**
     * Check if the notification is read.
     *
     * @return bool
     */
    public function isRead()
    {
        return !is_null($this->read_at);
    }

    /**
     * Check if the notification is unread.
     *
     * @return bool
     */
    public function isUnread()
    {
        return is_null($this->read_at);
    }

    // Add any other custom methods you need for your application.
}
