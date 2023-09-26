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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('storage')->nullable();
            $table->string('ram')->nullable();
            $table->text('cache')->nullable();
            $table->string('firewall_disable')->nullable();
            $table->string('battery_percentage')->nullable();
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->integer('read_status')->default('0')->comments('0 - Unread','1 - Read');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','storage', 'ram','cache','firewall_disable','battery_percentage','asset_id','read_status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
