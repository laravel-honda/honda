<div x-data="{}" class="flex flex-col items-center justify-center mt-6 sm:mt-24">
    <div class="max-w-lg">
        <x-ui-title class="text-center" level="h1">
            {{ __('auth.verify-email.title') }}
        </x-ui-title>
        <x-ui-paragraph class="text-center mt-2">
            {{ __('auth.verify-email.details') }}
        </x-ui-paragraph>
    </div>

    <form wire:submit.prevent="checkForVerification(Object.fromEntries(new FormData($event.target)))"
          class="flex flex-col items-center my-4">
        <x-ui- wire:ignore name="verification_code" hideLabel length="6"/>
        @error('verification_code')
            <p class="flex items-center text-red-500 mt-2">
                <x-ui-icon name="alert-circle" solid size="5"/>
                <span class="inline-block ml-2">{{ $message }}</span>
            </p>
        @enderror
        <div class="flex items-center mt-6">
            <x-ui-button color="{{ settings('color') }}">
                {{ __('auth.verify-email.verify') }}
            </x-ui-button>
            <span
                  class="inline-block ml-4 text-{{ settings('color') }}-500 font-semibold cursor-pointer"
                  @click="$event.target.innerText = '{{ __('auth.verify-email.sent') }}'; $wire.sendVerificationMail()">
            {{ __('auth.verify-email.resend') }}
        </span>
        </div>
    </form>
</div>
