<?php
// Programmer Name: Ms. Lim Jia Yong, Project Manager
// Description: Definition of Discount table in SQLite database
// Edited on: 3 March 2022

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('discountCode');
            $table->smallInteger('percentage');
            $table->decimal('minSpend', 6, 2);
            $table->decimal('cap', 5, 2);
            $table->date('startDate'); // CONVERT TO DATE ONLY
            $table->date('endDate'); // CONVERT TO DATE ONLY
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
