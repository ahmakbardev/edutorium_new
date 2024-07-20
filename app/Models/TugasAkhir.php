<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhirs';
    protected $fillable = ['modul_id', 'nama', 'deskripsi', 'deskripsi_pdf', 'deadline', 'kriteria_penilaian'];

    public function submissions()
    {
        return $this->hasMany(TugasAkhirSubmission::class);
    }
}
