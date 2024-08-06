<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BootcampController extends Controller
{
    public function modul()
    {
        $modules = DB::table('modules')->get();
        $materis = DB::table('materis')->orderBy('urutan_materi', 'asc')->get();
        $userProgress = DB::table('progress')->where('user_id', Auth::id())->get();

        // Iterate through each module to set their status
        foreach ($modules as $module) {
            $module->has_quiz = DB::table('quizzes')->where('module_id', $module->id)->exists();
            $module->has_livecode = DB::table('livecode_tutorials')->where('module_id', $module->id)->exists();

            $moduleProgress = $userProgress->where('module_id', $module->id)->first();
            $completedMateri = $moduleProgress ? json_decode($moduleProgress->materi, true) : [];

            $allMateriCompleted = count($completedMateri) === $materis->where('modul_id', $module->id)->count();

            if (!$module->has_quiz && !$module->has_livecode) {
                $module->is_done = $allMateriCompleted;
            } else {
                $module->is_done = $moduleProgress && $moduleProgress->quiz !== null && $moduleProgress->livecode !== null;
            }
        }

        return view('bootcamp.modul.index', compact('modules', 'materis', 'userProgress'));
    }



    public function materi($modul, $materi)
    {
        $module = DB::table('modules')->where('name', $modul)->first();
        $user_id = Auth::id();

        // Pengecekan modul sebelumnya
        $prevModuleId = $module->id - 1;
        if ($prevModuleId > 0) {
            $prevModule = DB::table('modules')->where('id', $prevModuleId)->first();

            if ($prevModule) {
                $prevModuleProgress = DB::table('progress')
                    ->where('user_id', $user_id)
                    ->where('module_id', $prevModuleId)
                    ->first();

                $allMateriCompleted = false;
                $quizCompleted = false;
                $livecodeCompleted = false;

                if ($prevModuleProgress) {
                    $completedMateri = json_decode($prevModuleProgress->materi, true);
                    $allMateriCompleted = count($completedMateri) === DB::table('materis')->where('modul_id', $prevModuleId)->count();
                    $quizCompleted = $prevModuleProgress->quiz !== null;
                    $livecodeCompleted = $prevModuleProgress->livecode !== null;
                }

                $prevModuleHasQuiz = DB::table('quizzes')->where('module_id', $prevModuleId)->exists();
                $prevModuleHasLivecode = DB::table('livecode_tutorials')->where('module_id', $prevModuleId)->exists();

                if (($prevModuleHasQuiz || $prevModuleHasLivecode) && (!$quizCompleted || !$livecodeCompleted)) {
                    return redirect()->route('user.bootcamp.modul.modul')->with('error', 'Anda harus menyelesaikan kuis dan livecode di modul sebelumnya terlebih dahulu.');
                } elseif (!$allMateriCompleted) {
                    return redirect()->route('user.bootcamp.modul.modul')->with('error', 'Anda harus menyelesaikan semua materi di modul sebelumnya terlebih dahulu.');
                }
            }
        }

        // Mengubah slug kembali ke format asli
        $original_materi_name = str_replace('-', ' ', ucwords($materi, '-'));
        $currentMateri = DB::table('materis')->where('nama_materi', $original_materi_name)->first();

        // Mengambil urutan materi berikutnya dan sebelumnya
        $nextMateri = DB::table('materis')
            ->where('modul_id', $currentMateri->modul_id)
            ->where('urutan_materi', '>', $currentMateri->urutan_materi)
            ->orderBy('urutan_materi', 'asc')
            ->first();

        $prevMateri = DB::table('materis')
            ->where('urutan_materi', '<', $currentMateri->urutan_materi)
            ->orderBy('urutan_materi', 'desc')
            ->first();

        // Panggil fungsi untuk menyimpan progress materi
        $this->saveMateriProgress($currentMateri);

        // Cek apakah data quiz ada untuk module_id
        $quizExists = DB::table('quizzes')->where('module_id', $module->id)->exists();

        // Cek apakah nilai kuis sudah ada dalam progress
        $quizProgress = DB::table('progress')
            ->where('user_id', $user_id)
            ->where('module_id', $module->id)
            ->value('quiz');
        $quizCompleted = $quizProgress !== null;

        // Cek apakah livecode sudah diselesaikan
        $livecodeProgress = DB::table('progress')
            ->where('user_id', $user_id)
            ->where('module_id', $module->id)
            ->value('livecode');
        $livecodeCompleted = $livecodeProgress !== null;

        return view('bootcamp.materi.index', compact('module', 'currentMateri', 'nextMateri', 'prevMateri', 'quizExists', 'quizCompleted', 'livecodeCompleted'));
    }



    private function saveMateriProgress($materi)
    {
        $user_id = Auth::id();
        $module_id = $materi->modul_id;

        // Ambil progress user dari tabel
        $progress = DB::table('progress')
            ->where('user_id', $user_id)
            ->where('module_id', $module_id)
            ->first();

        $materiProgress = $progress ? json_decode($progress->materi, true) : [];

        // Pastikan $materiProgress adalah array
        if (!is_array($materiProgress)) {
            $materiProgress = [];
        }

        if (!in_array($materi->nama_materi, $materiProgress)) {
            $materiProgress[] = $materi->nama_materi;
            DB::table('progress')
                ->updateOrInsert(
                    ['user_id' => $user_id, 'module_id' => $module_id],
                    ['materi' => json_encode($materiProgress), 'updated_at' => now()]
                );
        }
    }
}
