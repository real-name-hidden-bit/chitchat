<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Profile Picture Selection -->
        <div class="mt-4">
            <x-input-label for="profile_picture" :value="__('Choose Profile Picture')" />
            <div class="grid grid-cols-5 gap-3 mt-2">
                @php
                    $avatars = ['😀', '😎', '🤓', '😊', '🥳', '🤩', '😇', '🥰', '😍', '🤗', '🧐', '🤔', '😏', '😌', '😴', '🤠', '🥸', '😈', '👾', '🤖'];
                @endphp
                @foreach($avatars as $index => $avatar)
                    <label class="cursor-pointer">
                        <input type="radio" name="profile_picture" value="{{ $avatar }}" class="hidden peer" {{ $index === 0 ? 'checked' : '' }}>
                        <div class="w-12 h-12 flex items-center justify-center text-2xl border-2 border-gray-300 rounded-full hover:border-sky-500 peer-checked:border-sky-500 peer-checked:bg-sky-50 transition">
                            {{ $avatar }}
                        </div>
                    </label>
                @endforeach
            </div>
            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
