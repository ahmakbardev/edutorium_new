<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->where('id', Auth::id())->first();

        $isProfileEmpty = false;
        $showSelamatDatangModal = false;
        $showTugasAkhirModal = false;

        if ($user) {
            $fieldsToCheck = ['bio', 'phone', 'sekolah'];
            foreach ($fieldsToCheck as $field) {
                if (is_null($user->$field) || $user->$field === '') {
                    $isProfileEmpty = true;
                    break;
                }
            }

            // Check if profile is not empty and user hasn't started module_id 1
            if (!$isProfileEmpty) {
                $progressModule1 = DB::table('progress')
                    ->where('user_id', Auth::id())
                    ->where('module_id', 1)
                    ->exists();

                if (!$progressModule1) {
                    $showSelamatDatangModal = true;
                }
            }

            // // Step 1: Join modules with quizzes and livecode_tutorials
            // $modulesWithQuizAndLivecode = DB::table('modules')
            //     ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
            //     ->leftJoin('livecode_tutorials', 'modules.id', '=', 'livecode_tutorials.module_id')
            //     ->select('modules.id as module_id', 'quizzes.id as quiz_id', 'livecode_tutorials.id as livecode_id')
            //     ->get();
            // // dd($modulesWithQuizAndLivecode);

            // // Step 2: Join the result with progress
            // $modulesWithProgress = DB::table('modules')
            //     ->leftJoin('progress', function ($join) {
            //         $join->on('modules.id', '=', 'progress.module_id')
            //             ->where('progress.user_id', Auth::id());
            //     })
            //     ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
            //     ->leftJoin('livecode_tutorials', 'modules.id', '=', 'livecode_tutorials.module_id')
            //     ->select('modules.id as module_id', 'progress.id as progress_id', 'progress.quiz as progress_quiz', 'progress.livecode as progress_livecode', 'quizzes.id as quiz_id', 'livecode_tutorials.id as livecode_id')
            //     ->get();
            // // dd($modulesWithProgress);

            // Step 3: Apply the conditions to check if all modules are completed
            $allModulesCompleted = DB::table('modules')
                ->leftJoin('progress', function ($join) {
                    $join->on('modules.id', '=', 'progress.module_id')
                        ->where('progress.user_id', Auth::id());
                })
                ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
                ->leftJoin('livecode_tutorials', 'modules.id', '=', 'livecode_tutorials.module_id')
                ->select('modules.id as module_id', 'progress.id as progress_id', 'progress.quiz as progress_quiz', 'progress.livecode as progress_livecode', 'quizzes.id as quiz_id', 'livecode_tutorials.id as livecode_id')
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->whereNotNull('quizzes.id')
                            ->whereNotNull('progress.quiz');
                    })
                        ->orWhere(function ($query) {
                            $query->whereNotNull('livecode_tutorials.id')
                                ->whereNotNull('progress.livecode');
                        })
                        ->orWhere(function ($query) {
                            $query->whereNull('quizzes.id')
                                ->whereNull('livecode_tutorials.id');
                        });
                })
                ->whereNull('progress.id')
                ->doesntExist();

            // dd($allModulesCompleted);

            if ($allModulesCompleted) {
                $showTugasAkhirModal = true;
            }

            // dd($showTugasAkhirModal);
        }

        $isEmpty = true;

        if ($user) {
            $fields = [
                'bio' => $user->bio,
                'phone' => $user->phone,
                'sekolah' => $user->sekolah,
                'jurusan' => $user->jurusan,
                'name' => $user->name,
                'email' => $user->email,
                'tgl_lahir' => $user->tgl_lahir
            ];

            $isEmpty = !array_reduce($fields, function ($carry, $value) {
                return $carry && (!is_null($value) && $value !== '');
            }, true);
        }

        $userLivecodes = DB::table('progress')
            ->join('modules', 'progress.module_id', '=', 'modules.id')
            ->where('progress.user_id', Auth::id())
            ->whereNotNull('livecode')
            ->select('progress.*', 'modules.name as module_name')
            ->get();

        $allLivecodes = DB::table('progress')
            ->join('modules', 'progress.module_id', '=', 'modules.id')
            ->join('users', 'progress.user_id', '=', 'users.id') // Menambahkan join ke tabel users
            ->whereNotNull('livecode')
            ->select('progress.*', 'modules.name as module_name', 'users.name as user_name', 'users.pic as user_pic')
            ->get();

        $progress = DB::table('progress')
            ->join('modules', 'progress.module_id', '=', 'modules.id')
            ->join('users', 'progress.user_id', '=', 'users.id')
            ->select('progress.*', 'modules.name as module_name', 'users.name as user_name', 'users.sekolah')
            ->orderBy('progress.updated_at', 'desc')
            ->get();

        $history = DB::table('progress')
            ->join('modules', 'progress.module_id', '=', 'modules.id')
            ->where('progress.user_id', Auth::id())
            ->select('progress.*', 'modules.name as module_name')
            ->orderBy('progress.updated_at', 'desc')
            ->get();

        $latestProgress = DB::table('progress')
            ->join('modules', 'progress.module_id', '=', 'modules.id')
            ->where('progress.user_id', Auth::id())
            ->select('progress.*', 'modules.name as module_name')
            ->orderBy('progress.updated_at', 'desc')
            ->first();

        // Fetch livecode assessments for the current user
        $livecodeAssessments = DB::table('livecode_assessments')
            ->join('progress', 'livecode_assessments.livecode_tutorial_id', '=', 'progress.module_id')
            ->where('livecode_assessments.user_id', Auth::id())
            ->select('livecode_assessments.*', 'progress.module_id')
            ->get();

        // Calculate the average score for each assessment
        $assessments = collect();
        foreach ($livecodeAssessments as $assessment) {
            // Clean up the JSON string and decode it
            $cleanedJsonString = str_replace('\\"', '"', trim($assessment->kriteria_penilaian, '"'));
            $kriteriaPenilaian = json_decode($cleanedJsonString, true);

            // Check if JSON decoding was successful
            if (json_last_error() === JSON_ERROR_NONE && is_array($kriteriaPenilaian)) {
                $totalScore = array_sum(array_column($kriteriaPenilaian, 'nilai'));
                $averageScore = $totalScore / count($kriteriaPenilaian);
                $assessment->average_score = $averageScore;
            } else {
                $assessment->average_score = null;
            }

            $assessments->push($assessment);
        }

        // Combine userLivecodes with their respective assessments
        foreach ($userLivecodes as $livecode) {
            $livecodeAssessment = $assessments->firstWhere('module_id', $livecode->module_id);
            $livecode->average_score = $livecodeAssessment->average_score ?? null;
        }

        // Calculate the progress percentage
        if ($latestProgress) {
            $totalMateri = DB::table('materis')
                ->where('modul_id', $latestProgress->module_id)
                ->count();

            $completedMateri = count(json_decode($latestProgress->materi, true));

            $progressPercentage = ($completedMateri / $totalMateri) * 100;

            // Check if all materi are completed
            $isAllCompleted = $completedMateri == $totalMateri;

            if ($isAllCompleted) {
                // User has completed all materi, set the progress percentage to 100
                $progressPercentage = 100;
            } else {
                // Get the next materi
                $currentMateri = DB::table('materis')
                    ->where('modul_id', $latestProgress->module_id)
                    ->whereIn('urutan_materi', json_decode($latestProgress->materi, true))
                    ->orderBy('urutan_materi', 'desc')
                    ->first();

                $nextMateri = DB::table('materis')
                    ->where('modul_id', $currentMateri->modul_id ?? null)
                    ->where('urutan_materi', '>', $currentMateri->urutan_materi ?? 0)
                    ->orderBy('urutan_materi', 'asc')
                    ->first();
            }
        } else {
            $progressPercentage = 0;
        }

        // Fetch banners
        $banners = DB::table('banners')->get();

        return view('user.index', compact(
            'isEmpty',
            'isProfileEmpty',
            'showSelamatDatangModal',
            'showTugasAkhirModal',
            'userLivecodes',
            'allLivecodes',
            'history',
            'progress',
            'latestProgress',
            'progressPercentage',
            'assessments',
            'banners'
        ));
    }
}
