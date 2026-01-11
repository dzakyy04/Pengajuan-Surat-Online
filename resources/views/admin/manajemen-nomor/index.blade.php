@extends('admin.layout.app')

@section('title', 'Manajemen Nomor Surat')

@push('styles')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 0;
            border-radius: 1rem;
            width: 90%;
            max-width: 600px;
            animation: slideDown 0.3s;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .help-text {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .preview-box {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 2px dashed #10b981;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Manajemen Nomor Surat</h1>
                    <p class="text-gray-600 mt-2">Kelola nomor, tahun, dan format nomor surat untuk setiap jenis surat</p>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <p class="text-sm text-blue-700 font-semibold mb-1">Panduan Format Nomor:</p>
                    <ul class="text-sm text-blue-600 space-y-1">
                        <li><strong>[NO]</strong> - Akan diganti dengan nomor urut (contoh: 001, 002)</li>
                        <li><strong>[TAHUN]</strong> - Akan diganti dengan tahun (contoh: 2024, 2025)</li>
                        <li>Contoh: <code class="bg-blue-100 px-2 py-1 rounded">440/[NO]/SKTM/SR/[TAHUN]</code> → <code class="bg-blue-100 px-2 py-1 rounded">440/0001/SKTM/SR/2024</code></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($jenisSurat as $js)
                <div class="border border-emerald-200 bg-white rounded-2xl shadow-sm p-6 card-hover">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full p-3 flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $js->nama }}</h3>
                                <p class="text-sm text-emerald-600 font-semibold">{{ $js->kode }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Format Nomor -->
                    <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs text-gray-600 mb-1">Format Nomor:</p>
                                <p class="text-sm font-mono font-semibold text-gray-800 break-all">{{ $js->format_nomor }}</p>
                            </div>
                            <button onclick="openFormatModal({{ $js->id }}, '{{ $js->nama }}', '{{ addslashes($js->format_nomor) }}', {{ $js->counter_terakhir }}, {{ $js->tahun_counter }})"
                                class="ml-2 text-blue-600 hover:text-blue-700 transition" title="Edit Format">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-gray-600">Nomor Terakhir:</span>
                            <span
                                class="text-lg font-bold text-blue-600">{{ str_pad($js->counter_terakhir, 3, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                            <span class="text-sm text-gray-600">Tahun:</span>
                            <span class="text-lg font-bold text-purple-600">{{ $js->tahun_counter }}</span>
                        </div>

                        <div class="p-3 bg-emerald-50 rounded-lg">
                            <p class="text-xs text-gray-600 mb-1">Nomor Berikutnya:</p>
                            <p class="text-sm font-mono font-bold text-emerald-600 break-all" id="preview-{{ $js->id }}">
                                {{ str_replace(['[NO]', '[TAHUN]'], [str_pad($js->counter_terakhir + 1, 4, '0', STR_PAD_LEFT), $js->tahun_counter], $js->format_nomor) }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="w-full">
                        <button onclick="openEditModal({{ $js->id }}, '{{ $js->nama }}', {{ $js->counter_terakhir }}, {{ $js->tahun_counter }}, '{{ addslashes($js->format_nomor) }}')"
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow-sm transition text-sm font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Nomor Surat
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Modal (Counter & Tahun & Format) -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Nomor Surat
                    </h3>
                    <button onclick="closeEditModal()" class="text-white hover:text-gray-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Surat</label>
                    <input type="text" id="editNama" readonly
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-100 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Format Nomor <span class="text-red-500">*</span></label>
                    <input type="text" name="format_nomor" id="editFormatNomor" required
                        oninput="updatePreviewInModal()"
                        placeholder="Contoh: 440/[NO]/SKTM/SR/[TAHUN]"
                        class="w-full px-4 py-2.5 rounded-lg border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition font-mono">
                    <p class="help-text">Gunakan [NO] untuk nomor urut dan [TAHUN] untuk tahun</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Terakhir <span class="text-red-500">*</span></label>
                        <input type="number" name="counter_terakhir" id="editCounter" min="0" required
                            oninput="updatePreviewInModal()"
                            class="w-full px-4 py-2.5 rounded-lg border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun <span class="text-red-500">*</span></label>
                        <input type="number" name="tahun_counter" id="editTahun" min="2000" max="2100"
                            required
                            oninput="updatePreviewInModal()"
                            class="w-full px-4 py-2.5 rounded-lg border border-emerald-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 shadow-sm transition">
                    </div>
                </div>

                <div id="previewContainer" class="preview-box mb-6">
                    <p class="text-xs font-semibold text-emerald-700 mb-2">Preview Nomor Berikutnya:</p>
                    <p class="text-lg font-mono font-bold text-emerald-800" id="modalPreview">-</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition shadow-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="flex-1 px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition shadow-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Format Modal (Edit Format Only) -->
    <div id="formatModal" class="modal">
        <div class="modal-content">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Edit Format Nomor
                    </h3>
                    <button onclick="closeFormatModal()" class="text-white hover:text-gray-200 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <form id="formatForm" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Surat</label>
                    <input type="text" id="formatNama" readonly
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-100 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Format Nomor Saat Ini</label>
                    <input type="text" id="formatNomorLama" readonly
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50 text-gray-600 font-mono">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Format Nomor Baru <span class="text-red-500">*</span></label>
                    <input type="text" name="format_nomor" id="formatNomorBaru" required
                        oninput="updateFormatPreview()"
                        placeholder="Contoh: 440/[NO]/SKTM/SR/[TAHUN]"
                        class="w-full px-4 py-2.5 rounded-lg border border-blue-200 focus:ring-2 focus:ring-blue-200 focus:border-blue-300 shadow-sm transition font-mono">
                    <p class="help-text">Gunakan [NO] untuk nomor urut dan [TAHUN] untuk tahun</p>
                </div>

                <input type="hidden" id="formatCounter">
                <input type="hidden" id="formatTahun">

                <div id="formatPreviewContainer" class="preview-box mb-6">
                    <p class="text-xs font-semibold text-emerald-700 mb-2">Preview dengan Format Baru:</p>
                    <p class="text-lg font-mono font-bold text-emerald-800" id="formatPreview">-</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Format
                    </button>
                    <button type="button" onclick="closeFormatModal()"
                        class="flex-1 px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition shadow-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Edit Modal Functions (Edit All: Format + Counter + Tahun)
        function openEditModal(id, nama, counter, tahun, formatNomor) {
            document.getElementById('editForm').action = `/admin/manajemen-nomor/${id}/update`;
            document.getElementById('editNama').value = nama;
            document.getElementById('editCounter').value = counter;
            document.getElementById('editTahun').value = tahun;
            document.getElementById('editFormatNomor').value = formatNomor;
            updatePreviewInModal();
            document.getElementById('editModal').classList.add('show');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        function updatePreviewInModal() {
            const formatNomor = document.getElementById('editFormatNomor').value;
            const counter = parseInt(document.getElementById('editCounter').value) || 0;
            const tahun = document.getElementById('editTahun').value;
            
            const nomorBerikutnya = counter + 1;
            const paddedNo = String(nomorBerikutnya).padStart(4, '0');
            
            let preview = formatNomor.replace('[NO]', paddedNo).replace('[TAHUN]', tahun);
            document.getElementById('modalPreview').textContent = preview;
        }

        // Format Modal Functions (Edit Format Only)
        function openFormatModal(id, nama, formatNomor, counter, tahun) {
            document.getElementById('formatForm').action = `/admin/manajemen-nomor/${id}/update-format`;
            document.getElementById('formatNama').value = nama;
            document.getElementById('formatNomorLama').value = formatNomor;
            document.getElementById('formatNomorBaru').value = formatNomor;
            document.getElementById('formatCounter').value = counter;
            document.getElementById('formatTahun').value = tahun;
            updateFormatPreview();
            document.getElementById('formatModal').classList.add('show');
        }

        function closeFormatModal() {
            document.getElementById('formatModal').classList.remove('show');
        }

        function updateFormatPreview() {
            const formatNomor = document.getElementById('formatNomorBaru').value;
            const counter = parseInt(document.getElementById('formatCounter').value) || 0;
            const tahun = document.getElementById('formatTahun').value;
            
            const nomorBerikutnya = counter + 1;
            const paddedNo = String(nomorBerikutnya).padStart(4, '0');
            
            let preview = formatNomor.replace('[NO]', paddedNo).replace('[TAHUN]', tahun);
            document.getElementById('formatPreview').textContent = preview;
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const formatModal = document.getElementById('formatModal');

            if (event.target == editModal) {
                closeEditModal();
            }
            if (event.target == formatModal) {
                closeFormatModal();
            }
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditModal();
                closeFormatModal();
            }
        });
    </script>
@endpush