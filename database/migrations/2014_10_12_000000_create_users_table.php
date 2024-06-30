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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('pic')->nullable(); // Kolom untuk gambar profil
            $table->text('bio')->nullable(); // Kolom untuk bio
            $table->string('phone')->nullable(); // Kolom untuk nomor telepon
            $table->string('sekolah')->nullable(); // Kolom untuk sekolah
            $table->string('kelas')->nullable(); // Kolom untuk kelas
            $table->string('jurusan')->nullable(); // Kolom untuk jurusan
            $table->date('tgl_lahir')->nullable(); // Kolom untuk tanggal lahir
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
