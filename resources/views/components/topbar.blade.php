<div class="bg-gray-100">
    <div>
        <nav x-data="{ open: false }" class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <x-application-logo context="topbar" />
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">

                                @foreach($items as $item)
                                    @if ($item instanceof \Honda\Navigation\Item)
                                        <a href="{{ $item->href }}"
                                           class="px-3 py-2 rounded-md text-base font-medium @if ($item->isActive()) bg-gray-900 text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif"
                                           @if ($item->isActive()) aria-current="page" @endif>
                                            <span
                                                class="font-medium leading-none text-gray-300 inline-block @if ($item->icon) ml-3 @endif">{{ $item->name }}</span>
                                        </a>
                                    @else
                                        Item type not supported yet
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <button type="button"
                                class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                aria-controls="mobile-menu" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                            <span class="sr-only">Open main menu</span>
                            <svg x-state:on="Menu open" x-state:off="Menu closed" class="block h-6 w-6"
                                 :class="{ 'hidden': open, 'block': !(open) }"
                                 x-description="Heroicon name: outline/menu" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg x-state:on="Menu open" x-state:off="Menu closed" class="hidden h-6 w-6"
                                 :class="{ 'block': open, 'hidden': !(open) }" x-description="Heroicon name: outline/x"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div x-description="Mobile menu, show/hide based on menu state." class="md:hidden" id="mobile-menu"
                 x-show="open" style="display: none;">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">

                    @foreach($items as $item)
                        @if ($item instanceof \Honda\Navigation\Item)
                            <a href="{{ $item->href }}"
                               class="block px-3 py-2 rounded-md text-base font-medium @if ($item->isActive()) bg-gray-900 text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif"
                               @if ($item->isActive()) aria-current="page" @endif>
                                <span
                                    class="font-medium leading-none text-gray-300 inline-block @if ($item->icon) ml-3 @endif">{{ $item->name }}</span>
                            </a>
                        @else
                            Item type not supported yet
                        @endif
                    @endforeach
                </div>
            </div>
        </nav>

        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              {{ $header }}
            </div>
        </header>
        @endisset
        <main>
            {{ $slot }}
        </main>
    </div>
</div>
