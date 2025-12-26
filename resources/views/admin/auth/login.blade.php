<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Surat Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-100/70 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-xl border border-emerald-100 shadow-xl rounded-2xl p-8 space-y-6">
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 text-xl font-bold">
                SR
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-emerald-950">Login Admin</h1>
                <p class="text-sm text-neutral-600">Masuk untuk mengelola pengajuan surat.</p>
            </div>
        </div>

        @if (session('status'))
            <div class="text-sm text-emerald-800 bg-emerald-50 border border-emerald-100 rounded-lg px-3 py-2">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-sm text-red-700 bg-red-50 border border-red-100 rounded-lg px-3 py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-semibold text-neutral-800" for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       class="w-full rounded-xl border border-emerald-100 bg-emerald-50/40 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                       placeholder="admin">
            </div>
            <div class="space-y-2">
                <label class="text-sm font-semibold text-neutral-800" for="password">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full rounded-xl border border-emerald-100 bg-emerald-50/40 px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/70 focus:border-emerald-500 outline-none"
                       placeholder="••••••••">
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center gap-2 text-neutral-700">
                    <input type="checkbox" name="remember" class="rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                    Ingat saya
                </label>
                <span class="text-neutral-400">Admin only</span>
            </div>
            <button type="submit"
                    class="w-full py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 via-emerald-400 to-emerald-300 text-sm font-semibold text-emerald-950 shadow-lg shadow-emerald-900/10 hover:brightness-110 transition">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>
