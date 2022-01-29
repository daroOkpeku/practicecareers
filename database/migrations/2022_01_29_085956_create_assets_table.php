<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->tinyText('Type')->nullable();
            $table->tinyText('SerialNumber')->nullable();
            $table->longText('Description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyText('FixedorMovable')->nullable();
            $table->tinyText('Picture_path')->nullable();
            $table->tinyText('Purchasedate')->nullable();
            $table->tinyText('Start_use_date')->nullable();
            $table->tinyText('Purchaseprice')->nullable();
            $table->tinyText('WarrantyExpirydate')->nullable();
            $table->tinyText('Degradationinyears')->nullable();
            $table->tinyText('CurrentValueinnaira')->nullable();
            $table->tinyText('Location')->nullable();

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
        Schema::dropIfExists('assets');
    }
}
