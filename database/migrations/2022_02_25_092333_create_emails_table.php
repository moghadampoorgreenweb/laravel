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
        Schema::create('emails', function (Blueprint $table) {
//            $table->id();
//            $table->string('email',255);
//            $table->string('title',255);
//            $table->string('body',255);
//            $table->string('status',255);
//            $table->dateTime('sent_at')->nullable();
//            $table->timestamps();
            $table->id();
            $table->string('email',255);
            $table->string('title' ,500);
            $table->string('type' , 100);
            $table->string('status' ,500);
            $table->dateTime('sent_at')->nullable();
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
        Schema::dropIfExists('emails');
    }
};
