<?php
// Programmer Name: Mr. Lai Pin Cheng, Developer
// Description: Adding extra fields to Menu table
// Edited on: 3 March 2022

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('type')->default('undefined');
            $table->decimal('estCost', 6, 2)->default('undefined');
            $table->integer('allergic')->default('0');
            $table->integer('vegetarian')->default('0');
            $table->integer('vegan')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('estCost');
            $table->dropColumn('allergic');
            $table->dropColumn('vegetarian');
            $table->dropColumn('vegan');
        });
    }
}
