<!-- Navbar -->
<div id="navbar"
    class="sticky top-0 z-40 w-full backdrop-blur flex-none transition-colors duration-500 lg:z-50 bg-white supports-backdrop-blur:bg-white/60">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center h-[70px]">
        <div class="w-[1200px] relative flex items-center mx-auto p-4 py-6 lg:py-8">
            <div class="flex items-center gap-4 md:gap-0">
                <div class="flex items-center h-full">
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <!-- Menu Button (visible on md and smaller screens) -->
                        <button @click="open = !open" class="flex items-center md:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H20" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <!-- Backdrop -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" @click="open = false"
                            class="fixed h-screen inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40 lg:hidden"
                            style="display: none;"></div>

                        <!-- Sidebar -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 -translate-x-full"
                            x-transition:enter-end="transform opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 translate-x-0"
                            x-transition:leave-end="transform opacity-0 -translate-x-full" style="display: none;"
                            class="fixed top-0 left-0 h-screen w-2/4 max-w-[212px] bg-white shadow-lg z-50 md:hidden">
                            <div class="py-6 px-4">
                                <a href="{{ url('/') }}" class="text-2xl font-bold mr-4">CodeCareer</a>
                                <div class="border-t border-slate-300 my-4"></div>
                                <div class="pt-1">
                                    <x-search-bar />
                                </div>
                                <a href="{{ url('/course') }}" class="text-slate-900 block pt-4 px-4"
                                    role="menuitem">Course</a>
                                <a href="{{ url('/resume') }}" class="text-slate-900 block pt-4 px-4"
                                    role="menuitem">Resume</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Brand Name -->
                <a href="{{ url('/') }}" class="text-2xl font-semibold mr-4">CodeCareer</a>
            </div>

            <!-- Search Input (visible on larger screens) -->
            <div class="hidden md:block">
                <x-search-bar />
            </div>

            <!-- Desktop Navigation (hidden on md and smaller screens) -->
            <div class="hidden md:flex gap-4 lg:gap-8 mx-4">
                <a href="{{ route('front.course') }}"
                    class="font-semibold hover:text-blue-500 transition duration-300 ease-in-out">Course</a>
                <a href="{{ url('/resume') }}"
                    class="font-semibold hover:text-blue-500 transition duration-300 ease-in-out">Resume</a>
            </div>

            <!-- Search and Login Buttons -->
            <div class="flex items-center gap-4 ml-auto">
                <!-- Login Button -->
                @if (Route::has('login'))
                    <nav class="relative flex gap-4">
                        @auth
                            <!-- Dropdown Button -->
                            <div class="relative gap-2 py-2 cursor-pointer" x-data="{ open: false }">
                                <button @click="open = !open" @click.away="open = false" class="flex items-center">
                                    <div class="avatar">
                                        @php
                                            $avatarUrl = asset('assets/images/profile1.png'); // Default avatar URL

                                            if (Auth::user()->avatar) {
                                                if (Str::startsWith(Auth::user()->avatar, 'https://')) {
                                                    $avatarUrl = Auth::user()->avatar;
                                                } elseif (Str::startsWith(Auth::user()->avatar, 'avatars/')) {
                                                    $avatarUrl = Storage::url(Auth::user()->avatar);
                                                }
                                            }
                                        @endphp

                                        <img id="avatar-preview" class="h-[36px] w-[36px] object-cover rounded-full"
                                            src="{{ $avatarUrl }}" alt="User Avatar" />
                                    </div>
                                    <div class="hidden md:flex items-center">
                                        <span class="flex items-center font-semibold text-sm uppercase ms-2">
                                            {{ Auth::user()->name }}
                                            <svg class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                    </div>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-48 rounded shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                                    style="display: none;">
                                    <div class="py-1" role="none">
                                        <a href="{{ route('dashboard') }}"
                                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem">Dashboard</a>
                                        <a href="{{ route('profile.edit') }}"
                                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem">Profile</a>
                                        <a href="{{ route('settings.edit') }}"
                                            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem">Settings</a>
                                        <form method="POST" action="{{ route('logout') }}" role="none">
                                            @csrf
                                            <button type="submit"
                                                class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 hover:text-gray-900"
                                                role="menuitem"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                Log Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-full md:rounded bg-blue-500 md:bg-white hover:bg-blue-500 border border-blue-500 p-2 md:py-2 md:px-4 font-semibold text-blue-500 hover:text-white text-center transition duration-300 ease-in-out">
                                <span class="hidden md:inline">Log In</span>
                                <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 md:hidden"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="hidden md:inline rounded bg-blue-500 hover:bg-blue-600 border border-blue-500 hover:border-blue-600 py-2 px-4 font-semibold text-white text-center transition duration-300 ease-in-out">
                                    Sign Up
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const navbar = document.getElementById('navbar');

    // Scroll effect
    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            navbar.classList.add('border-b', 'border-slate-200', 'shadow-md');
        } else {
            navbar.classList.remove('border-b', 'border-slate-200', 'shadow-md');
        }
    });
</script>
