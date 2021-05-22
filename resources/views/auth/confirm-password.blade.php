<x-layout title="Confirm your password">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">
                {{ __('auth.confirm-password.title') }}
            </x-ui-title>
            <x-ui-paragraph class="text-center mt-2">
                {{ __('auth.confirm-password.details') }}
            </x-ui-paragraph>
        </div>
        <x-ui-form action="login" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-password color="{{ settings('color') }}" name="password" :label="__('auth.confirm-password.inputs.password')"
                        first
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
            <x-ui-button color="{{ settings('color') }}" class="w-full justify-center mt-6">
                {{ __('auth.confirm-password.button') }}
            </x-ui-button>
        </x-ui-form>
    </div>
</x-layout>
