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
        Schema::create('fort_detiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('fortfolio_id')->constrained();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('name_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fort_detiles');
    }
};
