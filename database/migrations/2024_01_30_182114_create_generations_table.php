<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model_id');
            $table->string('market')->nullable();
            $table->string('name');
            $table->string('period')->nullable();
            $table->string('generation')->nullable();
            $table->string('image_path')->nullable();
            $table->string('tech_specs_path')->unique();
            $table->timestamps();

            $table->foreign('car_model_id')
                ->references('id')
                ->on('car_models')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('generations');
    }
};
