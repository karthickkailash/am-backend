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
        Schema::create('activations_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('asset_id')->references('id')->on('assets')->nullable();
            $table->string('activation_code')->nullable();
            $table->string('asset_type')->nullable();
            $table->string('mac_id')->nullable();
            $table->timestamp('activation_date');
            $table->timestamp('deactivation_date')->nullable();
            $table->string('deactive_reason')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('activated_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','asset_id','asset_type','activation_code','activation_date','deactivation_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activations_history');
    }
};
