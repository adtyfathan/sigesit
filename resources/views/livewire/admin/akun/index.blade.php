<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="bg-white/80 rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="mb-4 flex items-center">
                    <h2 class="text-2xl text-black font-bold">Data Akun Pengguna</h2>
                </div>

                <div class=" overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500">
                        <!-- Table Header -->
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Email
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Nama Pengguna
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Role
                                </th>
                                <th scope="col" class="py-3 px-6 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="text-center">
                            @foreach ($users as $user)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 max-w-xs">
                                        {{ $user->role->nama_role }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.akun.edit', $user->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 px-3 py-1 rounded-md bg-yellow-50 hover:bg-yellow-100 transition-colors"
                                                wire:navigate>
                                                Edit
                                            </a>
                                            <button wire:click="delete({{ $user->id }})"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Anda yakin menghapus akun ini?')" wire:navigate>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>