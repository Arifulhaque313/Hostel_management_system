<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('owner');
            $table->string('slug');
            $table->string('owner_num');
            $table->string('type');
            $table->string('person')->nullable();
            $table->string('area');
            $table->string('address');
            $table->string('rent');
            $table->string('status')->default(1);
            $table->string('description')->nullable();
            $table->string('thumbnail')->nullable();

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
        Schema::dropIfExists('hostels');
    }
}
