<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetasses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Assigned_user_id')->nullable();
            $table->foreign('Assigned_user_id')->references('id')->on('users');
            $table->tinyText('Status')->nullable();
            $table->tinyText('Is_due')->nullable();
            $table->tinyText('Due_date')->nullable();
            $table->unsignedBigInteger('AssetId')->nullable();
            $table->foreign('AssetId')->references('id')->on('assets');
            $table->tinyText('Assigned_by')->nullable();
            $table->tinyText('Assignment_date')->nullable();
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
        Schema::dropIfExists('assetasses');
    }
}
