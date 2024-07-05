<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->unsignedBigInteger('mobile_no');
            $table->string('address');
            $table->unsignedBigInteger('state');
            $table->unsignedBigInteger('city');
            $table->unsignedBigInteger('pincode');
            $table->string('marital_status');
            $table->date('wedding_date')->nullable();
            $table->json('hobbies')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('families');
    }
}