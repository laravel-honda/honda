<div>
    @for ($i = 0; $i < 6; $i++)
        @php($today = today()->addDays($i)->format('Y-m-d'))
        @php($current = $blocks[$today] ?? null)

        <div>
            <h3>{{ $today }}</h3>
            @if ($current === null)
                Nothing today
            @else
                @foreach($current as $block)
                    {{ $block->title }}
                @endforeach
            @endif
        </div>
    @endfor
</div>
