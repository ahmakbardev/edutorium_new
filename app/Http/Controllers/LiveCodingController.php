<?php

namespace App\Http\Controllers;

use App\Models\LivecodeTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LiveCodingController extends Controller
{

    public function index()
    {
        $modules = DB::table('modules')
            ->leftJoin('livecode_tutorials', 'modules.id', '=', 'livecode_tutorials.module_id')
            ->select('modules.*')
            ->distinct()
            ->whereNotNull('livecode_tutorials.id')
            ->get();

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

        return view('bootcamp.livecode.list', compact('modules', 'materis', 'userProgresses'));
    }



    public function showTutorials($moduleId)
    {
        $tutorials = DB::table('livecode_tutorials')->where('module_id', $moduleId)->get();
        $module = DB::table('modules')->where('id', $moduleId)->first();

        return view('bootcamp.livecode.index', compact('tutorials', 'module'));
    }

    public function saveProgress(Request $request)
    {
        $user_id = Auth::id();
        $module_id = $request->input('module_id');
        $html = $request->input('html');
        $css = $request->input('css');
        $js = $request->input('js');
        $framework = $request->input('framework'); // Tambahkan framework
        $links = $request->input('links'); // Ambil links
        $scripts = $request->input('scripts'); // Ambil scripts
        $screenshot = $request->input('screenshot');

        // Simpan screenshot sebagai file
        $screenshotPath = null;
        if ($screenshot) {
            $screenshotData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $screenshot));
            $screenshotPath = 'screenshots/' . uniqid() . '.png';
            Storage::disk('public')->put($screenshotPath, $screenshotData);
        }

        DB::table('progress')->updateOrInsert(
            ['user_id' => $user_id, 'module_id' => $module_id],
            [
                'livecode' => json_encode([
                    'html' => $html,
                    'css' => $css,
                    'js' => $js,
                    'framework' => $framework,
                    'links' => $links, // Tambahkan links ke JSON yang disimpan
                    'scripts' => $scripts, // Tambahkan scripts ke JSON yang disimpan
                    'screenshot' => $screenshotPath
                ]),
                'updated_at' => now()
            ]
        );

        return response()->json(['status' => 'success', 'redirect' => route('user.dashboard'), 'message' => 'Anda telah menyelesaikan modul.']);
    }
}
