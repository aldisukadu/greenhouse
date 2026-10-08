<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::orderBy('name')->paginate(20),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());
        $user = new User;
        $user->fill(collect($data)->except(['role', 'password'])->all());
        $user->password = Hash::make($data['password']);
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate($this->rules($user));

        if ($user->is(auth()->user()) && $data['role'] !== User::ROLE_ADMIN) {
            return back()->withErrors(['role' => 'Akun admin yang sedang digunakan tidak dapat diubah rolenya.']);
        }

        if ($user->isAdmin() && $data['role'] !== User::ROLE_ADMIN && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            return back()->withErrors(['role' => 'Akun admin terakhir tidak dapat diubah menjadi pekerja atau peminjam.']);
        }

        $user->fill(collect($data)->except(['role', 'password'])->all());
        $user->role = $data['role'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) {
            return back()->withErrors(['hapus' => 'Akun yang sedang digunakan tidak dapat dihapus.']);
        }

        if ($user->isAdmin() && User::where('role', User::ROLE_ADMIN)->count() <= 1) {
            return back()->withErrors(['hapus' => 'Akun admin terakhir tidak dapat dihapus.']);
        }

        if ($user->peminjamans()->exists()) {
            return back()->withErrors(['hapus' => 'Akun memiliki riwayat peminjaman dan tidak dapat dihapus.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }

    private function rules(?User $user = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user?->id)],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_PEKERJA, User::ROLE_PEMINJAM])],
            'status_pengguna' => ['nullable', Rule::in(['mahasiswa', 'siswa', 'dosen', 'kelompok'])],
            'no_hp' => ['nullable', 'regex:/^\\+?[0-9]{8,18}$/'],
            'password' => [$user ? 'nullable' : 'required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}