<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <x-jet-authentication-card-logo />
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="bg-gray-100 border-amber-600 text-center rounded-lg p-6">
                <h3 class="font-extrabold text-xl">USER GUIDELINES</h3>
                <div class="bg-red-600 p-2 rounded-md text-white text-sm">
                    <h4 class="font-semibold underline underline-offset-2">NOTE</h4>
                    <p class=""> Join discord <a href="https://discord.gg/szzH2GPh2X"><i class="fa-brands fa-discord text-white bg-blue-400 rounded-lg p-1"></i></a> to complete your registration or your account <em class="font-extrabold">will be deleted</em></p>
                </div>
                <div class="p-2 mt-2 rounded-md text-sm">
                    <h4 class="font-semibold">NAME & PROFILE PICTURE GUIDELINES</h4>
                    <ul class="text-xs list-disc text-left">
                        <li>Absolutely no offensive names or pictures are to be used.</li>
                        <li>Keep your name short and easily pronounceable</li>
                        <li>Ensure your in game arma name matches with your discord name</li>
                    </ul>
                </div>
            </div>

            <div>
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
