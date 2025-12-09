<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="font-header text-3xl font-bold uppercase tracking-wide">Login</h2>
        <p class="text-gray-500 font-sans text-sm mt-2">Welcome back to the club.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />
            <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />

            <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center group">
                <input id="remember_me" type="checkbox" class="rounded-none border-2 border-gray-300 text-hubbub-black shadow-none focus:ring-0 cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-600 group-hover:text-hubbub-black transition-colors font-sans">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col space-y-4">
            <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase py-4 hover:bg-hubbub-pink transition-colors tracking-widest shadow-lg">
                {{ __('Log in') }}
            </button>

            <div class="flex items-center justify-between text-sm">
                @if (Route::has('password.request'))
                    <a class="underline text-gray-500 hover:text-hubbub-pink transition-colors font-sans" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
                
                <a class="text-hubbub-black font-bold uppercase hover:text-hubbub-pink transition-colors font-header tracking-wide border-b-2 border-transparent hover:border-hubbub-pink" href="{{ route('register') }}">
                    {{ __('Create Account') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
