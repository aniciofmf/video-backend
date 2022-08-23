<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->boolean('is_free');
            $table->string('stripe_id')->nullable();
            $table->unsignedBigInteger('storage');
            $table->timestamps();
        });

        DB::table('plans')->insert([
            ["name" => "Gratis", "slug" => "gratis", "price" => 0, "is_free" => true, "stripe_id" => NULL, "storage" => 10485760],
            ["name" => "Plata", "slug" => "plata", "price" => 500, "is_free" => false, "stripe_id" => "price_1IV00dAFysyXrDU5SOXiup5z", "storage" => 20971520],
            ["name" => "Oro", "slug" => "oro", "price" => 1000, "is_free" => false, "stripe_id" => "price_1IV01vAFysyXrDU50qHV4ubj", "storage" => 31457280]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
