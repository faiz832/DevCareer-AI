<!-- Sidebar -->
<div class="bg-white w-1/6 hidden lg:block rounded-lg">
    <div class="px-6 py-4">
        <h2 class="text-lg font-bold text-slate-900 mb-4">MENU</h2>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center {{ Route::is('dashboard') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                    @if (Route::is('dashboard'))
                        <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                    @endif
                    <svg class="h-5 w-5 mr-3 {{ Route::is('dashboard') ? 'text-blue-500' : 'text-slate-900' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            @role('student')
                <li>
                    <a href="{{ route('mycourses.index') }}"
                        class="flex items-center {{ Route::is('mycourses.index') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                        @if (Route::is('mycourses.index'))
                            <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        @endif
                        <svg class="h-5 w-5 mr-3 {{ Route::is('mycourses.index') ? 'text-blue-500' : 'text-slate-900' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>My Courses</span>
                    </a>
                </li>
            @endrole
            @role('owner')
                <li>
                    <a href="{{ route('admin.teachers.index') }}"
                        class="flex items-center {{ Route::is('admin.teachers.index') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                        @if (Route::is('admin.teachers.index'))
                            <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        @endif
                        <svg class="h-5 w-5 mr-3 {{ Route::is('admin.teachers.index') ? 'text-blue-500' : 'text-slate-900' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <span>Teachers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center {{ Route::is('admin.categories.index') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                        @if (Route::is('admin.categories.index'))
                            <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        @endif
                        <svg class="h-5 w-5 mr-3 {{ Route::is('admin.categories.index') ? 'text-blue-500' : 'text-slate-900' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Categories</span>
                    </a>
                </li>
            @endrole
            @role('owner|teacher')
                <li>
                    <a href="{{ route('admin.courses.index') }}"
                        class="flex items-center {{ Route::is('admin.courses.index') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                        @if (Route::is('admin.courses.index'))
                            <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        @endif
                        <svg class="h-5 w-5 mr-3 {{ Route::is('admin.courses.index') ? 'text-blue-500' : 'text-slate-900' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Courses</span>
                    </a>
                </li>
            @endrole
            @role('owner')
                <li>
                    <a href="{{ route('admin.subscribe_transactions.index') }}"
                        class="flex items-center {{ Route::is('admin.subscribe_transactions.index') ? 'text-blue-500 relative' : 'text-slate-900' }}">
                        @if (Route::is('admin.subscribe_transactions.index'))
                            <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        @endif
                        <svg class="h-5 w-5 mr-3 {{ Route::is('admin.subscribe_transactions.index') ? 'text-blue-500' : 'text-slate-900' }}"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Transactions</span>
                    </a>
                </li>
            @endrole
            <li>
                <a href="/profile" class="flex items-center text-slate-900">
                    <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="{{ route('settings.edit') }}" class="flex items-center text-slate-900">
                    <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center text-slate-900">
                    <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="absolute left-0 top-12" x-data="{ open: false }" @click.away="open = false">
    <!-- Menu Button (visible on lg and smaller screens) -->
    <button @click="open = !open" class="lg:hidden">
        <div class="bg-white p-4 cursor-pointer rounded-r shadow-lg">
            <svg class="h-5 w-5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </button>
    <!-- Sidebar -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 -translate-x-full"
        x-transition:enter-end="transform opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 translate-x-0"
        x-transition:leave-end="transform opacity-0 -translate-x-full" style="display: none;"
        class="fixed top-0 left-0 h-full w-2/4 max-w-[212px] bg-white shadow-lg z-40 lg:hidden" @click.stop>
        <div class="p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">MENU</h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center text-blue-500 relative">
                        <div class="absolute -left-6 h-full w-1 bg-blue-500"></div>
                        <svg class="h-5 w-5 mr-3 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                @role('owner|teacher')
                    <li>
                        <a href="{{ route('admin.courses.index') }}" class="flex items-center text-slate-900">
                            <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span>Courses</span>
                        </a>
                    </li>
                @endrole
                @role('student')
                    <li>
                        <a href="{{ route('mycourses.index') }}" class="flex items-center text-slate-900">
                            <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span>My Courses</span>
                        </a>
                    </li>
                @endrole
                @role('owner')
                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center text-slate-900">
                            <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.teachers.index') }}" class="flex items-center text-slate-900">
                            <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path
                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                            <span>Teachers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subscribe_transactions.index') }}"
                            class="flex items-center text-slate-900">
                            <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Transactions</span>
                        </a>
                    </li>
                @endrole
                <li>
                    <a href="#" class="flex items-center text-slate-900">
                        <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-slate-900">
                        <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-slate-900">
                        <svg class="h-5 w-5 mr-3 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
