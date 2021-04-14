<div class="w-full @if (!$first) mt-4 @endif" x-data="{ @alpine($values, $selected)}">
    @if ($name && $label)
        <label for="{{ $name }}" class="block  font-medium text-gray-700">{{ $label }}</label>
    @endif
    <div class="flex items-center @if ($name && $label) mt-1 @endif space-x-4">
        @foreach($values as $k => $value)
            <button
                @click="selected = {{ js($k) }}"
                type="button"
                class="flex items-center justify-between bg-white rounded-lg shadow-sm p-4 focus:border-opacity-0 focus:outline-none focus:ring-2 focus:ring-{{ $color }}-500 focus:ring-offset-2 w-full border border-gray-300 transition ease-in-out duration-150">
                <svg x-show="selected === {{ js($k) }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                     fill="currentColor" class="w-6 h-6 text-green-500">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd"/>
                </svg>
                <x-ui-icon x-show="selected !== {{ js($k) }}" name="circle" class="text-gray-300" size="6"/>

                {{ $value }}
                <div></div>
            </button>
        @endforeach
    </div>

    @if ($name)
        @error($name)
        <p class="flex items-center text-red-500 mt-2">
            <x-ui-icon name="alert-circle" solid size="5"/>
            <span class="inline-block ml-2">{{ $message }}</span>
        </p>
        @enderror
        <x-ui-value x-bind:value="selected" key="{{ $name }}"/>
    @endif
</div>
