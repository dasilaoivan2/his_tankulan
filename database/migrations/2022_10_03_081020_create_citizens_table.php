<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('household_id');
            $table->text('firstname');
            $table->text('middlename')->nullable();
            $table->text('lastname');
            $table->text('suffixname')->nullable();
            $table->date('birthdate');
            $table->foreignId('gender_id');
            $table->text('contact_no')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('familyrole_id');
            $table->foreignId('citizentype_id');
            $table->foreignId('work_id');
            $table->text('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizens');
    }
};
