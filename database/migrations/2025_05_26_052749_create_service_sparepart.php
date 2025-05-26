<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_sparepart', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_price');
            $table->uuid('service_id');
            $table->uuid('sparepart_id');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('sparepart_id')->references('id')->on('spareparts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_sparepart');
    }
};
