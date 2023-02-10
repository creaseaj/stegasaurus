<section>
    <div id="api-token">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('API Key') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                @if ($user->api_token)
                {{ __("Update / Remove the API Key used for steganographic detection over networks") }}
                @else
                {{ __("Create the API Key used for steganographic detection over networks") }}

                @endif
            </p>
        </header>
        @if (session('status') === 'token-created')
        <p x-data="{ show: true }" x-transition x-init="setTimeout(() => show = false, 2000)" :class='"text-sm text-gray-100 p-2 bg-green-500 rounded-sm w-max transition-all " + (show ? " opacity-100" : "opacity-0" )'>{{ __('Created.') }}</p>
        @elseif (session('status') === 'token-deleted')
        <p x-data="{ show: true }" x-transition x-init="setTimeout(() => show = false, 2000)" :class='"text-sm text-gray-100 bg-red-500 p-2 rounded-sm w-max transition-all " + (show ? "opacity-100" : "opacity-0") '>{{ __('Deleted.') }}</p>
        @endif

        @if ($user->api_token)
        <div class="my-[10px]">
            <x-copy-to-clipboard content="{{ $user->api_token }}" />
        </div>
        <!-- <x-text-input id="api_token" name="api_token" type="text" class="mt-1 block w-full" :value="old('api_token', $user->api_token)" required readonly" /> -->

        <!-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> -->
        <div class="flex gap-4 mt-2">
            <form method="post" action="{{ route('profile.api-token.delete') }}">
                @csrf
                @method('delete')
                <x-danger-button class="mt-1" warning>{{ __('Delete API Token') }}</x-danger-button>
            </form>
            <form method="post" action="{{ route('profile.api-token.create') }}">
                @csrf
                @method('post')
                <x-primary-button class="mt-1">{{ __('Refresh API Token') }}</x-primary-button>
            </form>
        </div>
        @else
        <form method="post" action="{{ route('profile.api-token.create') }}" class="mt-6 space-y-6">
            @csrf
            @method('post')
            <div>
                <!-- <x-input-label for="apiKey" :value="__('API Key')" /> -->

                <x-primary-button class="mt-1">{{ __('Create API Token') }}</x-primary-button>
            </div>


            <!-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div> -->

            <!-- <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div> -->
        </form>
        @endif
    </div>
</section>