@switch($status)
    @case('pending')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
            Menunggu Persetujuan
        </span>
        @break

    @case('diproses')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
            Sedang Diproses
        </span>
        @break

    @case('siap_ttd_kades')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
            Siap TTD Kepala Desa
        </span>
        @break

    @case('siap_diambil')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
            Siap Diambil
        </span>
        @break

    @case('selesai')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
            Selesai
        </span>
        @break

    @case('ditolak')
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
            Ditolak
        </span>
        @break

    @default
        <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
            {{ ucfirst($status) }}
        </span>
@endswitch
