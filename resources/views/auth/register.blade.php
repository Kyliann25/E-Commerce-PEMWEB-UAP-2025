<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="font-header text-3xl font-bold uppercase tracking-wide">Create Account</h2>
        <p class="text-gray-500 font-sans text-sm mt-2">Join the movement.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />
            <x-text-input id="name" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />
            <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />

            <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Min. 8 characters" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-header font-bold uppercase text-xs mb-2 text-hubbub-black !text-hubbub-black" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full border-2 border-gray-200 p-3 font-sans focus:border-hubbub-black focus:ring-0 rounded-none shadow-none"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Re-enter password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4 pt-2">
             <button type="submit" class="w-full bg-hubbub-black text-white font-header font-bold uppercase py-4 hover:bg-hubbub-pink transition-colors tracking-widest shadow-lg">
                {{ __('Register') }}
            </button>

            <div class="text-center">
                <a class="underline text-sm text-gray-500 hover:text-hubbub-pink transition-colors font-sans" href="{{ route('login') }}">
                    {{ __('Already have an account?') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
