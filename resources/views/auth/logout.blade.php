<x-layout title="Logout">
    <div class="flex flex-col items-center justify-center mt-6 sm:mt-24">
        <div class="max-w-lg">
            <x-ui-title class="text-center" level="h1">{{ __('auth.logout.title') }}</x-ui-title>
        </div>
        <x-ui-form action="logout" class="bg-white sm:shadow-lg sm:max-w-lg w-full rounded-lg p-6 mt-8">
            <x-ui-button color="{{ settings('color') }}" class="w-full justify-center mt-6">
                {{ __('auth.logout.button') }}
            </x-ui-button>
        </x-ui-form>
    </div>
</x-layout>
