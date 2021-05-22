<x-layout title="Reset your password">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">
                {{ __('auth.reset-password.title') }}
            </x-ui-title>
            <x-ui-paragraph class="text-center mt-2">
                {{ __('auth.reset-password.details') }}
            </x-ui-paragraph>
        </div>

        <x-ui-form action="password.update" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <input type="hidden" name="token" value="{{ $request->route('token') }}"/>
            <x-ui-input color="{{ settings('color') }}" name="email" placeholder="jack.martin@mail.com" :label="__('auth.reset-password.inputs.email')"
                     :first="session('status') === null" :value="old('email', $request->email)"/>
            <x-ui-password color="{{ settings('color') }}" name="password" :label="__('auth.reset-password.inputs.password')"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
            <x-ui-button class="w-full mt-6">
                {{ __('auth.reset-password.button') }}
            </x-ui-button>
        </x-ui-form>
    </div>
</x-layout>
