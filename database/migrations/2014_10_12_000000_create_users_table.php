<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('partner_id');
            $table->string('name',50);
            $table->string('last_name',50);
            $table->string('email',50)->unique();
            $table->string('password', 60);
            $table->integer('status')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('type')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            //$table->primary('partner_id');
            $table->foreign('country_id')
                ->references('id_pais')->on('paises')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
