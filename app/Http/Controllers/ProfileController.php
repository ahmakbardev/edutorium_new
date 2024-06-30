<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->first();

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

            // Check if all fields are non-null and non-empty
            $isEmpty = !array_reduce($fields, function ($carry, $value) {
                return $carry && (!is_null($value) && $value !== '');
            }, true);

            // Debugging statement to check the values
            // dd($isEmpty, $fields);
        }

        return view('user.profile.index', compact('isEmpty'));
    }
}
