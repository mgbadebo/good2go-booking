<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="email" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="name@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="space-y-1.5">
            <label for="password" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="Your password">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 text-xs text-slate-600">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" name="remember">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-semibold text-indigo-600 hover:text-indigo-500" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500">
            Log in
        </button>

        <p class="text-center text-xs text-slate-500">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Create one</a>
        </p>
    </form>
</x-guest-layout>
