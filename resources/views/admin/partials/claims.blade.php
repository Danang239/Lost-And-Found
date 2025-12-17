<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
            <tr>
                <th class="px-6 py-3">Nama Barang</th>
                <th class="px-6 py-3">Pengklaim</th>
                <th class="px-6 py-3">Pembuat Laporan</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">
            @forelse ($claims as $claim)
                <tr class="hover:bg-slate-50 transition-colors">
                    {{-- Nama barang --}}
                    <td class="px-6 py-3 text-slate-800">
                        {{ $claim->item->name }}
                    </td>

                    {{-- Pengklaim --}}
                    <td class="px-6 py-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                     bg-emerald-50 text-emerald-700">
                            {{ $claim->user->name }}
                        </span>
                    </td>

                    {{-- Pembuat laporan --}}
                    <td class="px-6 py-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                     bg-slate-50 text-slate-700">
                            {{ $claim->item->user->name }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-sm text-slate-400">
                        Belum ada klaim barang yang tercatat.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
