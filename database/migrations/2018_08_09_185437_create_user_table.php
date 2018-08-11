<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
    * Run the migrations. NEW
    *
    * @return void
    */
   public function up()
   {
       Schema::create('user', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('username');
           $table->string('email',60)->unique();
           $table->string('password');
           $table->rememberToken();
           $table->string('api_token',60)->unique();
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
       Schema::dropIfExists('user');
   }
}
