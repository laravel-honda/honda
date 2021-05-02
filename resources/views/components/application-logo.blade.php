@switch($context)
    @case('sidebar')
    @case('topbar')
    <span class="text-white font-semibold">{{ config('app.name') }}</span>
    @break
    @case('sidebar-mobile')
    <span class="text-gray-700 font-semibold">{{ config('app.name') }}</span>
    @break
    @default
    {{ config('app.name') }}
@endswitch
