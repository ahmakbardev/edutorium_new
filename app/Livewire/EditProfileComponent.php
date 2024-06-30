<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditProfileComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $bio;
    public $phone;
    public $sekolah;
    public $kelas;
    public $jurusan;
    public $tgl_lahir;
    public $pic;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->phone = $user->phone;
        $this->sekolah = $user->sekolah;
        $this->kelas = $user->kelas;
        $this->jurusan = $user->jurusan;
        $this->tgl_lahir = $user->tgl_lahir;
        $this->pic = $user->pic;
    }

    public function updatedPic()
    {
        $this->validate([
            'pic' => 'image|max:1024', // 1MB Max
        ], [
            'pic.image' => 'File harus berupa gambar.',
            'pic.max' => 'Ukuran gambar tidak boleh lebih dari 1MB.',
        ]);
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|regex:/^[0-9]{10,16}$/',
            'sekolah' => 'nullable|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'bio.string' => 'Bio harus berupa teks.',
            'phone.regex' => 'Nomor telepon harus berupa angka dan panjang antara 10 hingga 16 digit.',
            'sekolah.string' => 'Sekolah harus berupa teks.',
            'sekolah.max' => 'Sekolah tidak boleh lebih dari 255 karakter.',
            'kelas.string' => 'Kelas harus berupa teks.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 255 karakter.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',
            'tgl_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->bio = $this->bio;
        $user->phone = $this->phone;
        $user->sekolah = $this->sekolah;
        $user->kelas = $this->kelas;
        $user->jurusan = $this->jurusan;
        $user->tgl_lahir = $this->tgl_lahir;

        if ($this->pic && is_string($this->pic) === false) {
            $path = $this->pic->store('profile', 'public');
            $user->pic = $path;
        }

        $user->save();

        session()->flash('message', 'Profil berhasil diperbarui.');
        $this->dispatch('profile-updated');
    }

    public function render()
    {
        return view('livewire.edit-profile-component');
    }
}
