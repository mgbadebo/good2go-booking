<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="space-y-1.5">
            <label for="name" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Full name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="Jane Doe">
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
        </div>

        <div class="space-y-1.5">
            <label for="phone" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Phone number</label>
            <input id="phone" type="tel" name="phone" :value="old('phone')" required autocomplete="tel"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="+234 801 234 5678">
            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs" />
        </div>

        <div class="space-y-1.5">
            <label for="email" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Email (optional)</label>
            <input id="email" type="email" name="email" :value="old('email')" autocomplete="username"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="you@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
        </div>

        <div class="space-y-1.5">
            <label for="password" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="Create a password">
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
        </div>

        <div class="space-y-1.5">
            <label for="password_confirmation" class="text-xs font-semibold uppercase tracking-wide text-slate-600">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm font-medium text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/40" placeholder="Re-enter password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
        </div>

        <button type="submit" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500">
            Create account
        </button>

        <p class="text-center text-xs text-slate-500">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Log in</a>
        </p>
    </form>
</x-guest-layout>
