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
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no');
            $table->timestamp('ticket_date');
            $table->integer('asset_id')->nullable();
            $table->integer('asset_owner_id')->nullable();
            $table->integer('asset_incharge_id')->nullable();
            $table->text('issues')->nullable();
            $table->timestamp('ticket_picked_date')->nullable();
            $table->timestamp('ticket_resolved_date')->nullable();
            $table->text('fix_comments')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','ticket_no', 'ticket_date','asset_id','asset_owner_id','asset_incharge_id','ticket_picked_date','ticket_resolved_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
