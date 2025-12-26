<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - Surat Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-emerald-50 text-neutral-900">
    <div class="max-w-5xl mx-auto px-6 py-10 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-neutral-600">Halo, {{ auth('admin')->user()->nama ?? 'Admin' }}</p>
                <h1 class="text-2xl font-bold text-emerald-900">Dashboard Admin</h1>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition">
                    Logout
                </button>
            </form>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="bg-white rounded-xl border border-emerald-100 shadow-sm p-5">
                <h2 class="text-lg font-semibold text-emerald-900 mb-2">Ringkasan</h2>
                <p class="text-sm text-neutral-700">Tambahkan konten dashboard di sini.</p>
            </div>
            <div class="bg-white rounded-xl border border-emerald-100 shadow-sm p-5">
                <h2 class="text-lg font-semibold text-emerald-900 mb-2">Pengajuan Terbaru</h2>
                <p class="text-sm text-neutral-700">Integrasikan dengan data pengajuan surat.</p>
            </div>
        </div>
    </div>
</body>
</html>
