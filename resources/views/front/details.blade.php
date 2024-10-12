<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Course Details - CodeCareer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide scrollbar in Chrome, Safari and Opera */
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Hero Section -->
        <div class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg h-max md:h-[400px]">
                <div class="flex flex-col md:flex-row md:items-center gap-8 md:gap-12 w-full h-full p-8 md:p-12">
                    <div class="relative overflow-hidden rounded-lg flex" x-data="{ open: false, videoSrc: '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}' }"
                        @click.away="open = false">
                        <button
                            @click="open = !open; if (!open) { videoSrc = ''; } else { videoSrc = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}'; }"
                            class="relative overflow-hidden rounded-lg md:w-[400px] md:h-[250px] hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20">
                                <div
                                    class="w-24 h-16 bg-red-500 rounded-xl flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                                    <div
                                        class="w-0 h-0 border-t-[12px] border-t-transparent border-l-[24px] border-l-white border-b-[12px] border-b-transparent ml-1">
                                    </div>
                                </div>
                            </div>
                            <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : asset('assets/images/thumbnail.jpg') }}"
                                alt="{{ $course->name }}" class="w-full h-full object-cover object-center"
                                loading="lazy">
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="transform opacity-0 -translate-x-full"
                            x-transition:enter-end="transform opacity-100 translate-x-0"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 translate-x-0"
                            x-transition:leave-end="transform opacity-0 -translate-x-full" style="display: none;"
                            class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 ease-in-out"
                            @click.away="open = false; videoSrc = ''">

                            <!-- Modal Content -->
                            <div class="bg-white flex flex-col items-center rounded-lg shadow-lg p-6"
                                @click.away="open = false; videoSrc = ''">
                                <iframe class="w-full h-full md:w-[560px] md:h-[315px]" :src="videoSrc"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 text-white">
                        <h1 class="text-3xl font-semibold">{{ $course->name }}</h1>
                        <!-- Category -->
                        <div class="flex gap-2 items-center">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="text-sm">{{ $course->category->name }}</span>
                        </div>
                        <!-- Students -->
                        <div class="flex gap-2 items-center">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm">{{ $course->students->count() }} Students</span>
                        </div>
                        <p class="">By {{ $course->teacher->user->name }}</p>
                        <p class="">{{ $course->about }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earn Section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <h1 class="text-2xl font-semibold mb-8">What you will get?</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="border rounded-lg h-max md:h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                viewBox="0 0 256 256">
                                <path
                                    d="M128,140a12,12,0,0,1-12,12H72a12,12,0,0,1,0-24h44A12,12,0,0,1,128,140ZM116,88H72a12,12,0,0,0,0,24h44a12,12,0,0,0,0-24Zm120,79.14V228a12,12,0,0,1-17.95,10.42L196,225.82,174,238.42A12,12,0,0,1,156,228V204H40a20,20,0,0,1-20-20V56A20,20,0,0,1,40,36H216a20,20,0,0,1,20,20V88.86a55.87,55.87,0,0,1,0,78.28ZM196,160a32,32,0,1,0-32-32A32,32,0,0,0,196,160Zm-40,20V167.14a56,56,0,0,1,56-92.8V60H44V180Zm56,27.32V181.66a55.87,55.87,0,0,1-32,0v25.66l10.05-5.74a12,12,0,0,1,11.9,0Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Certificate</p>
                            <span class="text-gray-400">Get your certificate after finishing the course.</span>
                        </div>
                    </div>
                </div>
                <div
                    class="border rounded-lg h-max md:h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                viewBox="0 0 256 256">
                                <path
                                    d="M216,36H40A20,20,0,0,0,20,56V160a20,20,0,0,0,20,20H216a20,20,0,0,0,20-20V56A20,20,0,0,0,216,36Zm-4,120H44V60H212Zm24,52a12,12,0,0,1-12,12H32a12,12,0,0,1,0-24H224A12,12,0,0,1,236,208ZM104,128V88a12,12,0,0,1,18.36-10.18l32,20a12,12,0,0,1,0,20.36l-32,20A12,12,0,0,1,104,128Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Tutorial</p>
                            <span class="text-gray-400 leading-7">Get video tutorial for this course from our
                                teacher.</span>
                        </div>
                    </div>
                </div>
                <div
                    class="border rounded-lg h-max md:h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000"
                                viewBox="0 0 256 256">
                                <path
                                    d="M220,32H76A20,20,0,0,0,56,52V72H36A20,20,0,0,0,16,92V204a20,20,0,0,0,20,20H180a20,20,0,0,0,20-20V184h20a20,20,0,0,0,20-20V52A20,20,0,0,0,220,32ZM176,96v16H40V96Zm0,104H40V136H176Zm40-40H200V92a20,20,0,0,0-20-20H80V56H216Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Project</p>
                            <span class="text-gray-400 leading-7">Build your own project from learning the
                                course.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Info Section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <div class="flex flex-col-reverse md:flex-row gap-4">
                <div class="w-full lg:w-8/12">
                    <h1 class="text-2xl font-semibold mb-4">Description</h1>
                    <p class="text-gray-600 leading-10 text-justify">{{ $course->desc }}</p>
                    <h1 class="text-2xl font-semibold mt-12 mb-4">Teacher</h1>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full"
                                src="{{ $course->teacher->user->avatar ?? asset('assets/images/profile1.png') }}"
                                alt="" loading="lazy">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $course->teacher->user->name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $course->teacher->user->email }}
                            </div>
                        </div>
                    </div>
                    <div class="text-2xl font-semibold mt-16 mb-4">What you will learn?</div>
                    <div class="rounded border w-full px-4 flex flex-col mb-12">
                        <div class="flex justify-between py-4">
                            <h1>Introduction</h1>
                            <div class="relative overflow-hidden rounded-lg flex" x-data="{ open: false, videoSrc: '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}' }"
                                @click.away="open = false">
                                <button
                                    @click="open = !open; if (!open) { videoSrc = ''; } else { videoSrc = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}'; }"
                                    class="hover:underline text-blue-500">Preview
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 -translate-x-full"
                                    x-transition:enter-end="transform opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 translate-x-0"
                                    x-transition:leave-end="transform opacity-0 -translate-x-full"
                                    style="display: none;"
                                    class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 ease-in-out"
                                    @click.away="open = false; videoSrc = ''">

                                    <!-- Modal Content -->
                                    <div class="bg-white flex flex-col items-center rounded-lg shadow-lg p-6"
                                        @click.away="open = false; videoSrc = ''">
                                        <iframe class="w-full h-full md:w-[560px] md:h-[315px]" :src="videoSrc"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($course->course_videos && $course->course_videos->count() > 0)
                            @foreach ($course->course_videos as $index => $video)
                                <div class="flex justify-between items-center py-4 border-t border-gray-200">
                                    <h1>{{ $video->name }}</h1>

                                    <!-- Play button for each video -->
                                    <div class="relative overflow-hidden rounded-lg flex" x-data="{ open: false, videoSrc: '{{ $video->path_video ?? '' }}' }"
                                        @click.away="open = false">
                                        @if (Route::has('login'))
                                            @auth
                                                @if (Auth::user()->hasActiveSubscription())
                                                    <button
                                                        @click="open = !open; if (!open) { videoSrc = ''; } else { videoSrc = '{{ $video->path_video ?? '' }}'; }"
                                                        class="hover:underline text-blue-500">Play
                                                    </button>
                                                    <div x-show="open"
                                                        x-transition:enter="transition ease-out duration-200"
                                                        x-transition:enter-start="transform opacity-0 -translate-x-full"
                                                        x-transition:enter-end="transform opacity-100 translate-x-0"
                                                        x-transition:leave="transition ease-in duration-75"
                                                        x-transition:leave-start="transform opacity-100 translate-x-0"
                                                        x-transition:leave-end="transform opacity-0 -translate-x-full"
                                                        style="display: none;"
                                                        class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300 ease-in-out"
                                                        @click.away="open = false; videoSrc = ''">

                                                        <!-- Modal Content -->
                                                        <div class="bg-white flex flex-col items-center rounded-lg shadow-lg p-6"
                                                            @click.away="open = false; videoSrc = ''">
                                                            <iframe class="w-full h-full md:w-[560px] md:h-[315px]"
                                                                :src="videoSrc" title="Video player"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endauth
                                            @guest
                                                <div class=""></div>
                                            @endguest
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-gray-500 italic py-4 border-t border-gray-200">
                                No lessons available for this course yet.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="w-full lg:w-4/12 relative">
                    <div class="pb-8 md:p-4 sticky top-24">
                        <div class="rounded-lg border p-4 space-y-4">
                            <div class="overflow-hidden rounded w-full h-[200px] shadow-md">
                                <img src="{{ $course->thumbnail ? Storage::url($course->thumbnail) : asset('assets/images/thumbnail.jpg') }}"
                                    alt="{{ $course->name }}" class="w-full h-full object-cover object-center"
                                    loading="lazy">
                            </div>

                            @if (Route::has('login'))
                                @auth
                                    @if (!Auth::user()->hasActiveSubscription())
                                        <div class="py-2">
                                            <hr>
                                        </div>
                                        <a href="{{ url('/pricing') }}"
                                            class="flex w-full justify-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                            Learn Now
                                        </a>
                                    @endif
                                @endauth
                                @guest
                                    <div class="py-2">
                                        <hr>
                                    </div>
                                    <a href="{{ url('/pricing') }}"
                                        class="flex w-full justify-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                                        Learn Now
                                    </a>
                                @endguest
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
</body>

</html>
