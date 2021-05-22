<x-layout title="Forgot your password?">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">
                {{ __('auth.forgot-password.title') }}
            </x-ui-title>
            <x-ui-paragraph class="text-center mt-2">
                {{ __('auth.forgot-password.details') }}
            </x-ui-paragraph>
        </div>

        <x-ui-form action="password.email" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-alert type="status" closeable />
            <x-ui-input color="{{ settings('color') }}" name="email" placeholder="jack.martin@mail.com" :label="__('auth.forgot-password.inputs.email')" :first="session('status') === null" />
            <x-ui-button color="{{ settings('color') }}" class="mt-6 w-full">
                {{ __('auth.forgot-password.button') }}
            </x-ui-button>
        </x-ui-form>
    </div>
</x-layout>
