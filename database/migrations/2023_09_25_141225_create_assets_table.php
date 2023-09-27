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
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tag');
            $table->string('asset_type')->comments('Laptop','Desktop','I/O Devices');
            $table->integer('io_device_status',2)->nullable();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('activation_code')->nullable();
            $table->integer('activated_status')->comments('0 - Inactive','1 - Active');
            $table->integer('asset_incharge_id');
            $table->string('employee_ids');
            $table->string('mac_physical_address');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->text('asset_full_spec')->nullable();
            $table->string('installed_ram_capacity');
            $table->integer('status')->default('1')->comments('0 - Inactive','1 - Active')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['id','asset_type', 'location_id','employee_ids','asset_incharge_id','team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
