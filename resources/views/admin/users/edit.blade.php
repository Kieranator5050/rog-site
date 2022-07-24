<x-admin>
    <div class="p-6">
        <form method="POST" action="/admin/users/{{ $user->id }}">
            @csrf
            @method('PATCH')
            <h1>Editing {{ $user->username }}</h1>
            <div class="flex flex-col mt-6 mb-6 text-center">

                <h1 class="font-semibold">Profile Information</h1>
                <!--Username & Email -->
                    <x-forms.container-block>
                        <x-jet-label for="username" value="{{ __('Username') }}" />
                        <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="$user->username" required autofocus autocomplete="name" />
                        <x-jet-input-error for="username" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$user->email" required autofocus autocomplete="email" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </x-forms.container-block>
                <!-- UID & Discord Name -->
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <x-jet-label for="uid" value="{{ __('Arma 3 UID') }}" />
                        <x-jet-input id="uid" class="block mt-1 w-full" type="text" name="uid" :value="$user->uid" autofocus autocomplete="uid" />
                        <x-jet-input-error for="uid" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-jet-label for="discord_id" value="{{ __('Discord ID') }}" />
                        <x-jet-input id="discord_id" class="block mt-1 w-full" type="text" name="discord_id" :value="$user->discord_id" autofocus autocomplete="discord_id" />
                        <x-jet-input-error for="discord_id" class="mt-2" />
                    </x-forms.container-block>
                </div>

                <!-- Operation Count & Balance -->
                <h1 class="mt-4 font-semibold">Op Count & Balance</h1>
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <x-jet-label for="opCount" value="{{ __('Operation Count') }}" />
                        <x-jet-input id="opCount" class="block mt-1 w-full" type="text" name="opCount" :value="$user->opCount" autofocus autocomplete="opCount" />
                        <x-jet-input-error for="opCount" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-jet-label for="balance" value="{{ __('Account Balance') }}" />
                        <x-jet-input id="balance" class="block mt-1 w-full" type="text" name="balance" :value="$user->balance" autofocus autocomplete="balance" />
                        <x-jet-input-error for="balance" class="mt-2" />
                    </x-forms.container-block>
                </div>

                <!-- Permissions Grid -->
                <h1 class="mt-4 font-semibold">Permissions Grid</h1>
                <div class="grid grid-cols-4">
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isAdmin" label="isAdmin"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isTeamLead" label="isTL"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isQuartermaster" label="isQM"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isMissionMaker" label="isMM"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                </div>

                <!-- Access Grid -->
                <h1 class="mt-4 font-semibold">Access Grid</h1>
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isActive" label="isActive"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-forms.dropdown-tf-item :value="$user->isLocked" label="isLocked"></x-forms.dropdown-tf-item>
                    </x-forms.container-block>
                </div>

                <!-- Team & Rank -->
                <h1 class="mt-4 font-semibold">Team\Rank ID</h1>
                <div class="grid grid-cols-2">
                    <x-forms.container-block>
                        <x-jet-label for="team_id" value="{{ __('Team ID') }}" />
                        <x-jet-input id="team_id" class="block mt-1 w-full" type="text" name="team_id" :value="$user->team_id" autofocus autocomplete="team_id" />
                        <x-jet-input-error for="team_id" class="mt-2" />
                    </x-forms.container-block>
                    <x-forms.container-block>
                        <x-jet-label for="rank_id" value="{{ __('Rank ID') }}" />
                        <x-jet-input id="rank_id" class="block mt-1 w-full" type="text" name="rank_id" :value="$user->rank_id" autofocus autocomplete="rank_id" />
                        <x-jet-input-error for="rank_id" class="mt-2" />
                    </x-forms.container-block>
                </div>

            </div>


            <div>
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</x-admin>
