<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Manajemen Akun</h2>
        <div class="mt-3">@include('partials.menu')</div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('partials.flash')

            <section class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-base font-semibold mb-4">Tambah akun</h3>
                <form method="POST" action="{{ route('admin.users.store') }}" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @csrf
                    <div>
                        <x-input-label for="new-name" value="Nama" />
                        <x-text-input id="new-name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                    </div>
                    <div>
                        <x-input-label for="new-email" value="Email" />
                        <x-text-input id="new-email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                    </div>
                    <div>
                        <x-input-label for="new-role" value="Role" />
                        <select id="new-role" name="role" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            @foreach (['peminjam' => 'Peminjam', 'pekerja' => 'Pekerja', 'admin' => 'Admin'] as $role => $label)
                                <option value="{{ $role }}" @selected(old('role', 'peminjam') === $role)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="new-status" value="Jenis pengguna" />
                        <select id="new-status" name="status_pengguna" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="">Tidak diisi</option>
                            @foreach (['mahasiswa', 'siswa', 'dosen', 'kelompok'] as $status)
                                <option value="{{ $status }}" @selected(old('status_pengguna') === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="new-phone" value="No. HP" />
                        <x-text-input id="new-phone" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp')" />
                    </div>
                    <div>
                        <x-input-label for="new-password" value="Password" />
                        <x-text-input id="new-password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                    </div>
                    <div>
                        <x-input-label for="new-password-confirmation" value="Konfirmasi password" />
                        <x-text-input id="new-password-confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
                    </div>
                    <div class="md:col-span-2 xl:col-span-3">
                        <x-primary-button>Tambah akun</x-primary-button>
                    </div>
                </form>
            </section>

            <section class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-base font-semibold mb-4">Daftar akun</h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1100px] text-sm text-left">
                        <thead class="text-xs uppercase text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-3 py-2">Nama</th><th class="px-3 py-2">Email</th><th class="px-3 py-2">Role</th>
                                <th class="px-3 py-2">Jenis pengguna</th><th class="px-3 py-2">No. HP</th><th class="px-3 py-2">Password baru</th><th class="px-3 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                @php($formId = 'update-user-'.$user->id)
                                <tr class="border-t border-gray-200 dark:border-gray-700 align-top">
                                    <td class="px-3 py-2">
                                        <form id="{{ $formId }}" method="POST" action="{{ route('admin.users.update', $user) }}">
                                            @csrf @method('PUT')
                                        </form>
                                        <input form="{{ $formId }}" name="name" value="{{ $user->name }}" required class="w-40 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                                    </td>
                                    <td class="px-3 py-2"><input form="{{ $formId }}" name="email" type="email" value="{{ $user->email }}" required class="w-52 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm"></td>
                                    <td class="px-3 py-2">
                                        <select form="{{ $formId }}" name="role" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                                            @foreach (['peminjam' => 'Peminjam', 'pekerja' => 'Pekerja', 'admin' => 'Admin'] as $role => $label)
                                                <option value="{{ $role }}" @selected($user->role === $role)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-2">
                                        <select form="{{ $formId }}" name="status_pengguna" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                                            <option value="">Tidak diisi</option>
                                            @foreach (['mahasiswa', 'siswa', 'dosen', 'kelompok'] as $status)
                                                <option value="{{ $status }}" @selected($user->status_pengguna === $status)>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-3 py-2"><input form="{{ $formId }}" name="no_hp" value="{{ $user->no_hp }}" class="w-36 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm"></td>
                                    <td class="px-3 py-2">
                                        <input form="{{ $formId }}" name="password" type="password" autocomplete="new-password" placeholder="Kosongkan" class="w-36 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                                        <input form="{{ $formId }}" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Konfirmasi" class="mt-1 w-36 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <button form="{{ $formId }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Simpan</button>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Hapus akun ini?')">
                                            @csrf @method('DELETE')
                                            <button class="ms-3 text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-3 py-4 text-gray-500">Belum ada akun.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $users->links() }}</div>
            </section>
        </div>
    </div>
</x-app-layout>