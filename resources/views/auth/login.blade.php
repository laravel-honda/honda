<x-layout title="Login">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">{{ __('auth.login.title') }}</x-ui-title>
            <x-ui-paragraph class="text-center mt-2">{{ __('auth.login.details') }}</x-ui-paragraph>
        </div>
        <x-ui-form action="login" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-input color="{{ settings('color') }}" name="email" placeholder="jack.martin@mail.com" :label="__('auth.login.inputs.email')" first/>
            <x-ui-input color="{{ settings('color') }}" name="password" :label="__('auth.login.inputs.password')"/>
            <div class="flex justify-between items-center mt-6">
                <x-ui-checkbox color="{{ settings('color') }}" name="remember_me" :label="__('auth.login.remember_me')" first/>
                <a href="{{ route('password.request') }}" class="font-semibold text-{{ settings('color') }}-500">
                    {{ __('auth.login.forgot_password')}}       
                </a>
            </div>
            <x-ui-button color="{{ settings('color') }}" class="w-full justify-center mt-6">
                {{ __('auth.login.button') }}
            </x-ui-button>
            <x-ui-paragraph class="text-center mt-4">
                {{ __('auth.login.register') }}
                <a class="font-semibold text-{{ settings('color') }}-500" href="{{ route('register') }}">
                    {{ __('auth.login.register_link') }}
                </a>
            </x-ui-paragraph>
        </x-ui-form>
    </div>
</x-layout>
