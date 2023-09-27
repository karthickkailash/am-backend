<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('country_id')->references('id')->on('countries')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->nullable();
            $table->string('building_name')->nullable();
            $table->string('floor')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','country_id', 'state_id','city_id','building_name','floor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
