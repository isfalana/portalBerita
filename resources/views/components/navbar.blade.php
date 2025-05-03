<nav class="bg-gray-800 sticky top-0 z-50 shadow-md" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="h-8 w-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo">
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @foreach ($menus->where('parent_menu', null) as $menu)
                            @if ($menu->submenu->isNotEmpty())
                                <div x-data="{ openDropdown: false }" class="relative">
                                @php
                                    $isActive = $menu->submenu->contains(function ($submenu) {
                                        return request()->is(ltrim($submenu->url_menu, '/'));
                                    });
                                @endphp
                                    <button @click="openDropdown = !openDropdown"
                                        class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
                                        {{ $menu->nama_menu }}
                                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="openDropdown" @click.away="openDropdown = false"
                                        x-transition
                                        class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20">
                                        <div class="py-1">
                                            @foreach ($menu->submenu as $submenu)
                                                <a href="{{ url($submenu->url_menu) }}" target="{{ $submenu->target_menu ?? '_self' }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    {{ $submenu->nama_menu }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ url($menu->url_menu) }}" target="{{ $menu->target_menu ?? '_self' }}"
                                    class="{{ request()->is(ltrim($menu->url_menu, '/')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} px-3 py-2 rounded-md text-sm font-medium">
                                    {{ $menu->nama_menu }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{ 'hidden': open, 'block': !open }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{ 'block': open, 'hidden': !open }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            @foreach ($menus->where('parent_menu', null) as $menu)
                @if ($menu->submenu->isNotEmpty())
                    <div x-data="{ openSubmenu: false }">
                    @php
                        $isActive = $menu->submenu->contains(function ($submenu) {
                            return request()->is(ltrim($submenu->url_menu, '/'));
                        });
                    @endphp
                        <button @click="openSubmenu = !openSubmenu"
                            class="block w-full text-left rounded-md px-3 py-2 text-base font-medium {{ $isActive ? 'bg-gray-900 text-white' : 'text-white hover:bg-gray-700' }}">
                            {{ $menu->nama_menu }}
                        </button>
                        <div x-show="openSubmenu" x-transition class="pl-5">
                            @foreach ($menu->submenu as $submenu)
                                <a href="{{ url($submenu->url_menu) }}" target="{{ $submenu->target_menu ?? '_self' }}"
                                    class="block rounded-md px-3 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                                    {{ $submenu->nama_menu }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ url($menu->url_menu) }}" target="{{ $menu->target_menu ?? '_self' }}"
                        class="{{ request()->is(ltrim($menu->url_menu, '/')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
                        {{ $menu->nama_menu }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</nav>
