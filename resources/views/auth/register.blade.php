<x-layout title="Login">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">
                {{ __('auth.register.title') }}
            </x-ui-title>
            <x-ui-paragraph class="text-center mt-2">
                {{ __('auth.register.details') }}
            </x-ui-paragraph>
        </div>
        <x-ui-form action="register" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-input color="{{ settings('color') }}" name="name" placeholder="Jack Martin" :label="__('auth.register.inputs.name')" first />
            <x-ui-input color="{{ settings('color') }}" name="email" placeholder="jack.martin@mail.com" :label="__('auth.register.inputs.email')"/>
            <x-ui-password color="{{ settings('color') }}" name="password" :label="__('auth.register.inputs.password')"
                        placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"/>
            <x-ui-button color="{{ settings('color') }}" :content="__('auth.register.button')" class="w-full justify-center mt-6"/>

            <x-ui-paragraph class="mt-4 text-center">
                {{ __('auth.register.login')}}
                <a href="{{ route('login') }}">
                    {{ __('auth.register.login_link') }}
                </a>
            </x-ui-paragraph>
        </x-ui-form>
    </div>
</x-layout>
