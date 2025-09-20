<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white dark:bg-gray-900 p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center">Вход в Mini-CRM</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700">
                <label for="remember_me" class="ml-2 block text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-3" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Registration Prompt -->
        <div class="mt-6 text-center">
            <span class="text-gray-600 dark:text-gray-400 mr-2">Ещё нет аккаунта?</span>
            <a href="{{ route('register') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded transition">
                Зарегистрироваться
            </a>
        </div>
    </div>
</x-guest-layout>
