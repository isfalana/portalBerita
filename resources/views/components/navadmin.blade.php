<nav class="bg-gray-800 sticky top-0 z-50 shadow-md" x-data="{isOpen : false}">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 items-center justify-between">
                        <div class="flex items-center">
                            <div class="shrink-0">
                                <img
                                    class="size-8"
                                    src="{{ asset('storage/Logo/logo.png') }}"
                                    alt="Your Company"
                                />
                            </div>
                            <div class="hidden md:block">
                                <div
                                    class="ml-10 flex items-baseline space-x-4"
                                >
                                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                    <x-navlink href="/admin" :active="request()->is('admin')">Admin</x-navlink>
                                    <x-navlink href="/admin/berita" :active="request()->is('admin/berita*')">Berita</x-navlink>
                                    <x-navlink href="/admin/kategori" :active="request()->is('admin/kategori*')">Kategori</x-navlink>
                                    <x-navlink href="/admin/page" :active="request()->is('admin/page*')">Page</x-navlink>
                                    <x-navlink href="/admin/menu" :active="request()->is('admin/menu*')">Menu</x-navlink>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-4 flex items-center md:ml-6">
                                

                                <!-- Profile dropdown -->
                                <div class="relative ml-3">
                                    <div>
                                        <button
                                            @click="isOpen = !isOpen"
                                            type="button"
                                            class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                                            id="user-menu-button"
                                            aria-expanded="false"
                                            aria-haspopup="true"
                                        >
                                            <span
                                                class="absolute -inset-1.5"
                                            ></span>
                                            <span class="sr-only"
                                                >Open user menu</span
                                            >
                                            <div class="size-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-semibold text-sm">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                        </button>
                                    </div>

                                    <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                                    <div
                                        x-show="isOpen"
                                        x-transition:enter="transition ease-out duration-100 transform"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75 transform"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="user-menu-button"
                                        tabindex="-1"
                                    >
                                        <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                                        <a
                                            href="{{ route('admin.profile') }}"
                                            class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-0"
                                            >Your Profile</a
                                        >
                                        <a
                                            href="{{ route('logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-2"
                                            >Sign out</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="-mr-2 flex md:hidden">
                            <!-- Mobile menu button -->
                            <button
                                @click="isOpen = !isOpen"
                                type="button"
                                class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                                aria-controls="mobile-menu"
                                aria-expanded="false"
                            >
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">Open main menu</span>
                                <!-- Menu open: "hidden", Menu closed: "block" -->
                                <svg
                                    class="block size-6"
                                    :class="{'hidden' : isOpen, 'block' : !isOpen}"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                    data-slot="icon"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                    />
                                </svg>
                                <!-- Menu open: "block", Menu closed: "hidden" -->
                                <svg
                                    class="hidden size-6"
                                    :class="{'block' : isOpen, 'hidden' : !isOpen}"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                    data-slot="icon"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18 18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div x-show="isOpen" class="md:hidden" id="mobile-menu">
                    <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a
                            href="/admin"
                            class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                        >
                            Admin
                        </a>
                        <a
                            href="/admin/berita"
                            class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/berita*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                        >
                            Berita
                        </a>
                        <a
                            href="/admin/kategori"
                            class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/kategori*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                        >
                            Kategori
                        </a>
                        <a
                            href="/admin/page"
                            class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/page*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                        >
                            Page
                        </a>
                        <a
                            href="/admin/menu"
                            class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('admin/menu*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
                        >
                            Menu
                        </a>

                    </div>
                    <div class="border-t border-gray-700 pt-4 pb-3">
                        <div class="flex items-center px-5">
                            <!-- Image Logo -->
                            <div class="shrink-0">
                                <img
                                    class="size-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                />
                            </div>
                            @if (Auth::check())
                                <div class="ml-3">
                                    <div class="text-base/5 font-medium text-white">
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-400">
                                        {{ Auth::user()->email }}
                                    </div>
                                </div>
                            @endif

                            <button
                                type="button"
                                class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                            >
                                <span class="absolute -inset-1.5"></span>
                                
                            </button>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            <a
                                href="{{ route('admin.profile') }}"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >
                                Your Profile
                            </a>
                            <a
                                href="{{ route('logout') }}"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                                >Sign out</a
                            >
                        </div>
                    </div>
                </div>
            </nav>