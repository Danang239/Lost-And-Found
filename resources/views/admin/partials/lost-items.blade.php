<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
            <tr>
                <th class="px-6 py-3">Nama Barang</th>
                <th class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">
            @forelse ($items as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-3 text-slate-800">
                        {{ $item->name }}
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-end gap-2">
                            {{-- Tombol Edit --}}
                            <a
                                href="{{ route('admin.items.edit', $item->id) }}"
                                class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                       text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition"
                            >
                                Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <form
                                action="{{ route('admin.items.destroy', $item->id) }}"
                                method="POST"
                                class="inline-flex"
                                onsubmit="return confirm('Yakin ingin menghapus barang ini?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold
                                           text-red-600 bg-red-50 hover:bg-red-100 transition"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="px-6 py-6 text-center text-sm text-slate-400">
                        Belum ada laporan barang untuk ditampilkan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
