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
        Schema::create('intelligent_batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('intelligent_batch_type_id')->references('id')->on('users')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','intelligent_batch_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intelligent_batches');
    }
};
