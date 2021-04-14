<x-assets-style href="https://unpkg.com/trix@1.2.3/dist/trix.css"/>
<x-assets-script href="https://unpkg.com/trix@1.2.3/dist/trix.js"/>
<div wire:ignore {{ $attributes->whereDoesntStartWith('wire') }}>
    <trix-editor
        x-data
        x-on:trix-change="$dispatch('input', event.target.value)"
        wire:model.debounce.1000ms="{{$attributes->get('wire:model')}}"
        wire:key="{{ $name }}"
    ></trix-editor>
</div>
