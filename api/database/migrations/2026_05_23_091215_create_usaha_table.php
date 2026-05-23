<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha', 100);
            $table->string('nama_pemilik', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('telepon', 20);
            $table->text('alamat');
            $table->string('logo')->nullable();
            $table->string('warna_primer', 7)->default('#8B4513');
            $table->string('warna_sekunder', 7)->default('#D2691E');
            $table->enum('role', ['usaha', 'super_admin'])->default('usaha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usaha');
    }
};
