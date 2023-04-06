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
        Schema::create('user_detiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('profile')->nullable();
            $table->string('first_name')->default('')->nullable();
            $table->string('middle_name')->default('')->nullable();
            $table->string('last_name')->default('')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('job_status')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('State')->nullable();
            $table->string('country')->nullable();
            $table->string('m_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('work_now')->nullable();
            $table->string('website')->nullable();
            $table->string('hero')->nullable();
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
        Schema::dropIfExists('user_detiles');
    }
};
