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
            $table->string('address1')->nullable();
            $table->string('city1')->nullable();
            $table->string('State1')->nullable();
            $table->string('country1')->nullable();
            $table->string('phone1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city2')->nullable();
            $table->string('State2')->nullable();
            $table->string('country2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('m_phone1')->nullable();
            $table->string('m_phone2')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
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
