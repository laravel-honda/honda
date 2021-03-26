<x-layout title="Login">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title :content="__('auth.login.title')" class="text-center" level="h1"/>
            <x-ui-paragraph :content="__('auth.login.details')" class="text-center mt-2"/>
        </div>
        <x-ui-form action="login" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-input name="email" placeholder="jack.martin@mail.com" :label="__('auth.login.inputs.email')" first/>
            <x-ui-password name="password" :label="__('auth.login.inputs.password')"
                           placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
            <div class="flex justify-between items-center mt-6">
                <x-ui-checkbox name="remember_me" :label="__('auth.login.remember_me')" first/>
                <x-ui-link href="password.request" :content="__('auth.login.forgot_password')"/>
            </div>
            <x-ui-button :content="__('auth.login.button')" class="w-full justify-center mt-6"/>

            <x-ui-paragraph class="text-center mt-4">
                {{ __('auth.login.register') }}
                <x-ui-link href="{{ route('register') }}">
                    {{ __('auth.login.register_link') }}
                </x-ui-link>
            </x-ui-paragraph>
        </x-ui-form>
    </div>
</x-layout>
