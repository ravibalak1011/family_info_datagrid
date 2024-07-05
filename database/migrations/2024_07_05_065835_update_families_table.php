<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFamiliesTable extends Migration
{
    public function up()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->unsignedBigInteger('mobile_no')->change();
            $table->unsignedBigInteger('state')->change();
            $table->unsignedBigInteger('city')->change();
            $table->unsignedBigInteger('pincode')->change();
        });
    }

    public function down()
    {
        Schema::table('families', function (Blueprint $table) {
            $table->string('mobile_no')->change();
            $table->string('state')->change();
            $table->string('city')->change();
            $table->string('pincode')->change();
        });
    }
}