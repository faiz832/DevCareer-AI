<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
            <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg h-[400px]">
                <div class="flex items-center gap-12 w-full h-full p-12">
                    <div class="relative overflow-hidden rounded-lg flex" x-data="{ open: false, videoSrc: '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}' }"
                        @click.away="open = false">
                        <button
                            @click="open = !open; if (!open) { videoSrc = ''; } else { videoSrc = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}'; }"
                            class="relative overflow-hidden rounded-lg w-[400px] h-[250px] hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20">
                                <div
                                    class="w-24 h-16 bg-red-500 rounded-xl flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                                    <div
                                        class="w-0 h-0 border-t-[12px] border-t-transparent border-l-[24px] border-l-white border-b-[12px] border-b-transparent ml-1">
                                    </div>
                                </div>
                            </div>
                            <img src="{{ Storage::url($course->thumbnail) ?? asset('assets/images/thumbnail.jpg') }}"
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
                                <iframe width="560" height="315" :src="videoSrc"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 text-white">
                        <h1 class="text-3xl font-semibold">{{ $course->name }}</h1>
                        <p class="text-lg">{{ $course->about }}</p>
                        <div class="flex gap-2 items-center">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-sm">{{ $course->students->count() }} Students</span>
                        </div>
                        <p class="text-sm">By {{ $course->teacher->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earn Section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <h1 class="text-2xl font-semibold mb-8">What you will get?</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="border rounded-lg h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.66667 2.66797C5.19391 2.66797 4 3.86188 4 5.33464V26.668C4 28.1407 5.19391 29.3346 6.66667 29.3346H13.3333C14.0697 29.3346 14.6667 28.7377 14.6667 28.0013C14.6667 27.2649 14.0697 26.668 13.3333 26.668H6.66667V5.33464L22.6667 5.33464V6.66797C22.6667 7.40435 23.2636 8.0013 24 8.0013C24.7364 8.0013 25.3333 7.40435 25.3333 6.66797V5.33464C25.3333 3.86188 24.1394 2.66797 22.6667 2.66797H6.66667Z"
                                    fill="#3F3F46"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.6667 10.668C19.7211 10.668 17.3333 13.0558 17.3333 16.0013C17.3333 17.2891 17.7898 18.4703 18.5497 19.392L17.3467 27.8127C17.2814 28.2702 17.4576 28.7289 17.8123 29.025C18.1671 29.3211 18.6499 29.4123 19.0883 29.2662L22.6667 28.0734L26.245 29.2662C26.6834 29.4123 27.1662 29.3211 27.521 29.025C27.8758 28.7289 28.052 28.2702 27.9866 27.8127L26.7836 19.392C27.5436 18.4703 28 17.2891 28 16.0013C28 13.0558 25.6122 10.668 22.6667 10.668ZM20 16.0013C20 14.5285 21.1939 13.3346 22.6667 13.3346C24.1394 13.3346 25.3333 14.5285 25.3333 16.0013C25.3333 17.4741 24.1394 18.668 22.6667 18.668C21.1939 18.668 20 17.4741 20 16.0013ZM20.2917 26.0542L21.0037 21.0703C21.527 21.2418 22.086 21.3346 22.6667 21.3346C23.2473 21.3346 23.8063 21.2418 24.3296 21.0703L25.0416 26.0542L23.0883 25.4031C22.8146 25.3118 22.5187 25.3118 22.245 25.4031L20.2917 26.0542Z"
                                    fill="#3F3F46"></path>
                                <path d="M9.33333 21.3346H16V18.668H9.33333V21.3346Z" fill="#3F3F46"></path>
                                <path d="M14.6667 16.0013H9.33333V13.3346H14.6667V16.0013Z" fill="#3F3F46">
                                </path>
                                <path d="M9.33333 10.668H17.3333V8.0013H9.33333V10.668Z" fill="#3F3F46"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold mb-1">Certificate</p>
                            <span class="text-gray-400">Get your certificate after finishing the course.</span>
                        </div>
                    </div>
                </div>
                <div
                    class="border rounded-lg h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.66667 2.66797C5.19391 2.66797 4 3.86188 4 5.33464V26.668C4 28.1407 5.19391 29.3346 6.66667 29.3346H13.3333C14.0697 29.3346 14.6667 28.7377 14.6667 28.0013C14.6667 27.2649 14.0697 26.668 13.3333 26.668H6.66667V5.33464L22.6667 5.33464V6.66797C22.6667 7.40435 23.2636 8.0013 24 8.0013C24.7364 8.0013 25.3333 7.40435 25.3333 6.66797V5.33464C25.3333 3.86188 24.1394 2.66797 22.6667 2.66797H6.66667Z"
                                    fill="#3F3F46"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.6667 10.668C19.7211 10.668 17.3333 13.0558 17.3333 16.0013C17.3333 17.2891 17.7898 18.4703 18.5497 19.392L17.3467 27.8127C17.2814 28.2702 17.4576 28.7289 17.8123 29.025C18.1671 29.3211 18.6499 29.4123 19.0883 29.2662L22.6667 28.0734L26.245 29.2662C26.6834 29.4123 27.1662 29.3211 27.521 29.025C27.8758 28.7289 28.052 28.2702 27.9866 27.8127L26.7836 19.392C27.5436 18.4703 28 17.2891 28 16.0013C28 13.0558 25.6122 10.668 22.6667 10.668ZM20 16.0013C20 14.5285 21.1939 13.3346 22.6667 13.3346C24.1394 13.3346 25.3333 14.5285 25.3333 16.0013C25.3333 17.4741 24.1394 18.668 22.6667 18.668C21.1939 18.668 20 17.4741 20 16.0013ZM20.2917 26.0542L21.0037 21.0703C21.527 21.2418 22.086 21.3346 22.6667 21.3346C23.2473 21.3346 23.8063 21.2418 24.3296 21.0703L25.0416 26.0542L23.0883 25.4031C22.8146 25.3118 22.5187 25.3118 22.245 25.4031L20.2917 26.0542Z"
                                    fill="#3F3F46"></path>
                                <path d="M9.33333 21.3346H16V18.668H9.33333V21.3346Z" fill="#3F3F46"></path>
                                <path d="M14.6667 16.0013H9.33333V13.3346H14.6667V16.0013Z" fill="#3F3F46"></path>
                                <path d="M9.33333 10.668H17.3333V8.0013H9.33333V10.668Z" fill="#3F3F46"></path>
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
                    class="border
                                rounded-lg h-[120px] p-5 hover:shadow-lg hover:-translate-y-2 transition duration-300
                                ease-in-out">
                    <div class="flex flex-col lg:flex-row">
                        <div class="mr-3 mb-2 lg:mb-0">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.66667 2.66797C5.19391 2.66797 4 3.86188 4 5.33464V26.668C4 28.1407 5.19391 29.3346 6.66667 29.3346H13.3333C14.0697 29.3346 14.6667 28.7377 14.6667 28.0013C14.6667 27.2649 14.0697 26.668 13.3333 26.668H6.66667V5.33464L22.6667 5.33464V6.66797C22.6667 7.40435 23.2636 8.0013 24 8.0013C24.7364 8.0013 25.3333 7.40435 25.3333 6.66797V5.33464C25.3333 3.86188 24.1394 2.66797 22.6667 2.66797H6.66667Z"
                                    fill="#3F3F46"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.6667 10.668C19.7211 10.668 17.3333 13.0558 17.3333 16.0013C17.3333 17.2891 17.7898 18.4703 18.5497 19.392L17.3467 27.8127C17.2814 28.2702 17.4576 28.7289 17.8123 29.025C18.1671 29.3211 18.6499 29.4123 19.0883 29.2662L22.6667 28.0734L26.245 29.2662C26.6834 29.4123 27.1662 29.3211 27.521 29.025C27.8758 28.7289 28.052 28.2702 27.9866 27.8127L26.7836 19.392C27.5436 18.4703 28 17.2891 28 16.0013C28 13.0558 25.6122 10.668 22.6667 10.668ZM20 16.0013C20 14.5285 21.1939 13.3346 22.6667 13.3346C24.1394 13.3346 25.3333 14.5285 25.3333 16.0013C25.3333 17.4741 24.1394 18.668 22.6667 18.668C21.1939 18.668 20 17.4741 20 16.0013ZM20.2917 26.0542L21.0037 21.0703C21.527 21.2418 22.086 21.3346 22.6667 21.3346C23.2473 21.3346 23.8063 21.2418 24.3296 21.0703L25.0416 26.0542L23.0883 25.4031C22.8146 25.3118 22.5187 25.3118 22.245 25.4031L20.2917 26.0542Z"
                                    fill="#3F3F46"></path>
                                <path d="M9.33333 21.3346H16V18.668H9.33333V21.3346Z" fill="#3F3F46"></path>
                                <path d="M14.6667 16.0013H9.33333V13.3346H14.6667V16.0013Z" fill="#3F3F46">
                                </path>
                                <path d="M9.33333 10.668H17.3333V8.0013H9.33333V10.668Z" fill="#3F3F46">
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
                    <p class="text-gray-600 leading-10 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Cupiditate
                        veritatis eaque in maxime repudiandae incidunt non ex vero, veniam, obcaecati accusamus, sint
                        doloribus officiis! Ea ullam est distinctio sapiente reprehenderit dolor animi facere ipsum
                        debitis eos saepe itaque mollitia aperiam nesciunt magni inventore, fugit, eveniet velit nostrum
                        harum ratione. Laboriosam? Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit, amet
                        consectetur adipisicing elit. Maxime, itaque!
                    </p>
                    {{-- <h1 class="text-3xl mt-12 mb-4">Target and Goals</h1>
                    <p class="text-gray-600 leading-10 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Cupiditate
                        veritatis eaque in maxime repudiandae incidunt non ex vero, veniam, obcaecati accusamus, sint
                        doloribus officiis! Ea ullam est distinctio sapiente reprehenderit dolor animi facere ipsum
                        debitis eos saepe itaque mollitia aperiam nesciunt magni inventore, fugit, eveniet velit nostrum
                        harum ratione. Laboriosam? Lorem ipsum dolor sit amet consectetur. Lorem ipsum dolor sit, amet
                        consectetur adipisicing elit. Maxime, itaque!
                    </p> --}}
                    <h1 class="text-2xl font-semibold mt-12 mb-4">Teacher</h1>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/35x35"
                                alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $course->teacher->user->name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                Lecturer at Pasundan University
                            </div>
                        </div>
                    </div>
                    <div class="text-2xl font-semibold mt-16 mb-4">What you will learn</div>
                    <div class="rounded border w-full px-4 flex flex-col mb-12">
                        <div class="flex justify-between py-4">
                            <h1>Introduction</h1>
                            <div class="relative overflow-hidden rounded-lg flex" x-data="{ open: false, videoSrc: '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}' }"
                                @click.away="open = false">
                                <button
                                    @click="open = !open; if (!open) { videoSrc = ''; } else { videoSrc = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}'; }"
                                    class="hover:underline">Preview
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
                                        <iframe width="560" height="315" :src="videoSrc"
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
                                    <h1>Lesson {{ $index + 1 }}. {{ $video->name }}</h1>
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
                    <div class="p-4 sticky top-24">
                        <div class="rounded-lg border p-4 space-y-4">
                            <div class="overflow-hidden rounded w-full h-[200px]">
                                <img src="{{ Storage::url($course->thumbnail) ?? asset('assets/images/thumbnail.jpg') }}"
                                    alt="{{ $course->name }}" class="shadow-md">
                            </div>
                            <a href="{{ url('/pricing') }}"
                                class="flex w-full justify-center bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">Learn
                                Now</a>
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
