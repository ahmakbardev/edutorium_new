<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhirSubmissionFile extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir_submission_files';
    protected $fillable = ['submission_id', 'file_path'];

    public function submission()
    {
        return $this->belongsTo(TugasAkhirSubmission::class);
    }
}
