<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        session(['previous_route' => route('user.quiz.index')]);

        $modules = DB::table('modules')->get();
        $materis = DB::table('materis')->get();
        $userProgresses = DB::table('progress')
            ->where('user_id', Auth::id())
            ->get()
            ->keyBy('module_id');

        foreach ($modules as $module) {
            $userProgress = $userProgresses->get($module->id);

            if ($userProgress) {
                $allMaterisCompleted = DB::table('materis')
                    ->where('modul_id', $module->id)
                    ->pluck('nama_materi')
                    ->every(function ($materi_name) use ($userProgress) {
                        return in_array($materi_name, json_decode($userProgress->materi, true));
                    });
            } else {
                $allMaterisCompleted = false;
            }

            $module->all_materis_completed = $allMaterisCompleted;
            $module->progress_exists = $userProgress ? true : false;
        }

        return view('bootcamp.quiz.list', compact('modules', 'materis', 'userProgresses'));
    }


    public function show($module_id)
    {
        $user_id = Auth::id();
        $progress = DB::table('progress')->where('user_id', $user_id)->where('module_id', $module_id)->first();

        if ($progress && !is_null($progress->quiz)) {
            $lastMateri = null;

            if ($progress) {
                $materiProgress = json_decode($progress->materi, true);
                if (is_array($materiProgress) && !empty($materiProgress)) {
                    $lastMateri = end($materiProgress);
                }
            }

            $module = DB::table('modules')->where('id', $module_id)->first();
            $module_name = $module->name;

            if ($lastMateri) {
                $lastMateriSlug = strtolower(str_replace(' ', '-', $lastMateri));
                $moduleSlug = strtolower(str_replace(' ', '-', $module_name));
                return redirect()->route('user.bootcamp.modul.materi', ['modul' => $moduleSlug, 'materi' => $lastMateriSlug]);
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Mengambil data kuis berdasarkan module_id
        $quiz = DB::table('quizzes')->where('module_id', $module_id)->first();

        if (!$quiz) {
            abort(404, 'Quiz not found');
        }

        $cleanQuestionsJson = str_replace(["\n", "\r", "\\"], '', $quiz->questions);
        $cleanQuestionsJson = trim($cleanQuestionsJson, '"');
        $questions = json_decode($cleanQuestionsJson, true);

        if (is_array($questions)) {
            foreach ($questions as &$question) {
                $question['timeLimit'] = 10;
            }
            unset($question);
        } else {
            $questions = [];
        }

        $lastMateri = null;

        if ($progress) {
            $materiProgress = json_decode($progress->materi, true);
            if (is_array($materiProgress) && !empty($materiProgress)) {
                $lastMateri = end($materiProgress);
            }
        }

        $module = DB::table('modules')->where('id', $module_id)->first();
        $module_name = $module->name;

        return view('bootcamp.quiz.index', compact('questions', 'module_id', 'lastMateri', 'module_name'));
    }


    public function savePartialQuizScore(Request $request)
    {
        $user_id = Auth::id();
        $module_id = $request->input('module_id');
        $score = $request->input('score');

        DB::table('progress')->updateOrInsert(
            ['user_id' => $user_id, 'module_id' => $module_id],
            ['quiz' => $score, 'updated_at' => now()]
        );

        return response()->json(['message' => 'Partial quiz score saved successfully']);
    }


    public function saveQuizScore(Request $request)
    {
        $user_id = Auth::id();
        $module_id = $request->input('module_id');
        $score = $request->input('score');

        DB::table('progress')->updateOrInsert(
            ['user_id' => $user_id, 'module_id' => $module_id],
            ['quiz' => $score, 'updated_at' => now()]
        );

        return response()->json(['message' => 'Quiz score saved successfully']);
    }
}
