<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhirSubmission extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir_submissions';
    protected $fillable = ['user_id', 'tugas_akhir_id', 'additional_info', 'github_url', 'web_url'];

    public function files()
    {
        return $this->hasMany(TugasAkhirSubmissionFile::class, 'submission_id');
    }

    public function tugasAkhir()
    {
        return $this->belongsTo(TugasAkhir::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
