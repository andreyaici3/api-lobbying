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
        Schema::create('truck_tracking', function (Blueprint $table) {
            $table->id();
            $table->string("no_pol");
            $table->string("no_surat_jalan");
            $table->string("driver");
            $table->integer("suhu")->default(0);
            $table->string("foto")->nullable()->default(null);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_tracking');
    }
};
