<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('street_1');
            $table->string('street_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('county')->nullable();
            $table->string('country');
	        $table->integer('addressable_id')->unsigned();
	        $table->string('addressable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
