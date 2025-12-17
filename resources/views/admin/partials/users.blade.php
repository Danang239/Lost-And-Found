<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
            <tr>
                <th class="px-6 py-3">Nama Pengguna</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">
            @forelse ($users as $user)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 text-slate-800">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-3 text-slate-600">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-3">
                        <div class="flex items-center justify-end gap-2">

                            {{-- Edit Button --}}
                            <a
                                href="{{ route('admin.users.edit', $user->id) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                       bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition"
                            >
                                Edit
                            </a>

                            {{-- Delete Button --}}
                            <form
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                class="inline-flex"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                           bg-red-50 text-red-600 hover:bg-red-100 transition"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-sm text-slate-400">
                        Belum ada pengguna terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
