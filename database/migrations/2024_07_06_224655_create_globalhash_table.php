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
        Schema::create('globalHash', function (Blueprint $table) {
            $table->id();
            $table->integer('idUser')->nullable();
            $table->integer('idEmpresa')->nullable();
            $table->string('hash');
            $table->string('lapso')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('globalHash');
    }
};
