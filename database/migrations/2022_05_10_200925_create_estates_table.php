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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('description');
            $table->integer('roomnumber');
            $table->string('state');
            $table->integer('price');
            $table->text('local');
            $table->string('photo');
            $table->integer('bathroomnumber');
            $table->integer('bedroomnumber');
            $table->string('propartytype');

            $table->softDeletes();
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
        Schema::dropIfExists('estates');
    }
};
