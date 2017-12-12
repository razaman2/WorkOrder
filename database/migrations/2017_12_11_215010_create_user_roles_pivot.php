<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesPivot extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->primary(['role_id', 'user_id']);
	        $table->integer('role_id');
	        $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
