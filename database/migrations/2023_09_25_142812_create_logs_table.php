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
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asset_id')->nullable();
            $table->string('asset_type')->comments('Laptop','Desktop','I/O Devices');
            $table->integer('asset_owner_id')->nullable();
            $table->integer('asset_incharge_id')->nullable();
            $table->string('intelligent_batch_type')->nullable();
            $table->string('logon_user_name')->nullable();
            $table->dateTime('log_date_and_time')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','asset_id', 'asset_type','asset_owner_id','asset_incharge_id','intelligent_batch_type','logon_user_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
