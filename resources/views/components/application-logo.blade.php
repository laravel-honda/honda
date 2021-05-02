@switch($context)
    @case('sidebar')
    @case('topbar')
    <span class="text-white font-semibold">{{ config('app.name') }}</span>
    @break
    @default
    {{ config('app.name') }}
@endswitch
