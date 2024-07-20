<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tugas_akhir_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tugas_akhir_id');
            $table->text('additional_info')->nullable();
            $table->string('github_url')->nullable();
            $table->string('web_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tugas_akhir_id')->references('id')->on('tugas_akhirs')->onDelete('cascade');
        });

        Schema::create('tugas_akhir_submission_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('submission_id')->references('id')->on('tugas_akhir_submissions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tugas_akhir_submission_files');
        Schema::dropIfExists('tugas_akhir_submissions');
    }
};
