<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateExistingReservationsWithDefaultUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Set a default user ID for existing reservations
        $defaultUserId = 1; // Replace with a valid user ID from your users table

        // Ensure the default user exists
        if (!DB::table('users')->where('id', $defaultUserId)->exists()) {
            throw new Exception('Default user ID does not exist in the users table.');
        }

        // Update existing reservations to set the default user ID
        DB::table('reservations')->whereNull('user_id')->update(['user_id' => $defaultUserId]);

        // Add the foreign key constraint
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Drop the foreign key constraint
         Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
