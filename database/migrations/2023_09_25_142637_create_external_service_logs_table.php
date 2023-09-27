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
        Schema::create('external_service_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->text('issues')->nullable();
            $table->string('service_status')->comments('Open','In-Progress','Resolved')->nullable();
            $table->timestamp('given_date')->nullable();
            $table->timestamp('resolved_date')->nullable();
            $table->text('comments')->nullable();
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','supplier_id', 'ticket_id','service_status','given_date','resolved_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_service_logs');
    }
};
