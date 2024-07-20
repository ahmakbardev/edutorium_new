<?php

namespace App\Http\Controllers;

use App\Models\TugasAkhir;
use App\Models\TugasAkhirSubmission;
use App\Models\TugasAkhirSubmissionFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasAkhirController extends Controller
{
    public function index()
    {
        $tugasAkhirs = TugasAkhir::all();
        return view('tugas_akhir.index', compact('tugasAkhirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_akhir_id' => 'required|exists:tugas_akhirs,id',
            'additional_info' => 'nullable|string',
            'github_url' => 'nullable|url',
            'web_url' => 'nullable|url',
            'files.*' => 'required|file|mimes:pdf|max:3072'
        ]);

        $submission = TugasAkhirSubmission::create([
            'user_id' => Auth::id(),
            'tugas_akhir_id' => $request->tugas_akhir_id,
            'additional_info' => $request->additional_info,
            'github_url' => $request->github_url,
            'web_url' => $request->web_url
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('tugas_akhir_files', 'public');
                TugasAkhirSubmissionFile::create([
                    'submission_id' => $submission->id,
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('user.tugas-akhir.index')->with('success', 'Tugas akhir berhasil dikumpulkan.');
    }
}
