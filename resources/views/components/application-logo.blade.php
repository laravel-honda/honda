<a href="{{route('home')}}">
    @switch($context)
        @case('sidebar')
        <span class="text-white font-semibold">{{ config('app.name') }}</span>
        @break
        @default
        {{ config('app.name') }}
    @endswitch
</a>
