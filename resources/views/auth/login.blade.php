<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div
    class="w-full max-w-md bg-surface-container-lowest p-10 rounded-xl shadow-on-surface/5 border border-outline-variant/10">
    <div class="mb-10 text-center lg:text-left">
        <h2 class="font-headline text-3xl font-bold text-primary mb-2">Bienvenue</h2>
        <p class="text-on-surface-variant text-sm">Veuillez entrer vos identifiants pour accéder à
            QueueFlow.</p>
    </div>
    <form class="space-y-6" method="post" action="{{ route('login') }}" >@csrf
        <!-- Email Field -->
        <div class="relative">
            <label class="block text-xs font-label uppercase tracking-wider text-on-surface-variant mb-2"
                for="email">Adresse Email</label>
            <div class="relative group">
                <span
                    class="material-symbols-outlined absolute left-0 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">mail</span>
                <input
                    class="w-full pl-10 pr-4 py-3 bg-surface-variant/30 border-b-2 border-transparent focus:border-primary focus:bg-surface-variant/10 transition-all outline-none text-on-surface placeholder:text-outline"
                    id="email" name="email" value="{{old('email')}}" placeholder="nom@entreprise.com" type="email" />
            </div>
        </div>
        <!-- Password Field -->
        <div class="relative">
            <label class="block text-xs font-label uppercase tracking-wider text-on-surface-variant mb-2"
                for="password">Mot de passe</label>
            <div class="relative group">
                <span
                    class="material-symbols-outlined absolute left-0 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                <input class="w-full pl-10 pr-12 py-3 bg-surface-variant/30 border-b-2 border-transparent focus:border-primary focus:bg-surface-variant/10 transition-all outline-none text-on-surface placeholder:text-outline"
                    id="password" name="password" placeholder="••••••••" type="password" />
                <button class="absolute right-0 top-1/2 -translate-y-1/2 text-outline hover:text-primary p-2"
                    type="button">
                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                </button>
            </div>
        </div>
        <!-- Helper Actions -->
        <div class="flex items-center justify-between py-2">
            <label class="flex items-center space-x-3 cursor-pointer group">
                <input
                    class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary-container transition-all"
                    type="checkbox" name="remember" />
                <span
                    class="text-xs font-label text-on-surface-variant group-hover:text-primary transition-colors">Rester
                    connecté</span>
            </label>
            <a class="text-xs font-label text-primary font-semibold hover:underline" href="{{ route('password.request') }}">Mot de
                passe oublié ?</a>
        </div>
        <!-- CTA Buttons -->
        <div class="pt-4 space-y-4">
            <button
                class="w-full py-4 bg-gradient-to-r from-primary to-primary-container text-white font-headline font-bold rounded-xl shadow-lg shadow-primary/10 hover:scale-[0.98] active:duration-150 transition-all"
                type="submit">
                Se Connecter
            </button>
            <button
                class="w-full py-4 border border-outline-variant/30 text-on-primary-fixed-variant font-headline font-bold rounded-xl hover:bg-surface-container-high transition-colors"
                type="button">
                Créer un compte
            </button>
        </div>
    </form>
    <!-- Footer Links (Contextual) -->
    <div class="mt-12 flex justify-center space-x-6">
        <a class="font-label text-[10px] uppercase tracking-widest text-slate-400 hover:text-blue-900 transition-colors"
            href="#">Politique de confidentialité</a>
        <a class="font-label text-[10px] uppercase tracking-widest text-slate-400 hover:text-blue-900 transition-colors"
            href="#">Conditions d'utilisation</a>
    </div>
</div>

</x-guest-layout>




















{{-- <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form> --}}
