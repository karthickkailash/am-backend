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
        Schema::create('asset_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asset_id')->nullable();
            $table->date('asset_received_date')->nullable();
            $table->date('asset_surrender_date')->nullable();
            $table->integer('asset_noc_clearance')->default('0');
            $table->integer('asset_owner_id')->comments('employeeid')->nullable();
            $table->integer('asset_incharge_id')->nullable();
            $table->text('comments')->nullable();
            $table->string('reason')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','asset_received_date', 'asset_surrender_date','asset_id','asset_owner_id','asset_incharge_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_trackings');
    }
};
