<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Course Details - DevCareer AI</title>

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

        <!-- Header -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
                <h1 class="text-6xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-400 mb-8 mt-12"
                    style="line-height: inherit">
                    {{ $course->name }}
                </h1>
                <p class="text-center text-gray-500 mb-4">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="max-w-lg mx-auto p-4 sm:px-6 lg:px-8 flex justify-between">
                <!-- Category -->
                <div class="flex gap-2 items-center">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="text-sm">{{ $course->category->name }}</span>
                </div>
                <!-- Students -->
                <div class="flex gap-2 items-center">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-sm">{{ $course->students->count() }} Students</span>
                </div>
                <!-- Teachers -->
                <div class="flex gap-2 items-center">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    <span class="text-sm">{{ $course->teacher->user->name }}</span>
                </div>
            </div>
        </div>

        <!-- Course Section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8">
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-8/12">
                    <div id="mainVideoContainer" class="aspect-video rounded-lg overflow-hidden w-full h-full relative">
                        <iframe id="mainVideoPlayer" class="w-full h-full"
                            src="{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="w-full lg:w-4/12 relative">
                    <div class="rounded-lg border w-full px-4 flex flex-col mb-12">
                        <div class="flex justify-between py-4">
                            <h1>Introduction</h1>
                            <button
                                onclick="document.getElementById('mainVideoPlayer').src = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}';"
                                class="hover:underline text-blue-500">Preview
                            </button>
                        </div>
                        <div>
                            @if ($course->course_videos && $course->course_videos->count() > 0)
                                @foreach ($course->course_videos as $index => $video)
                                    <div class="flex justify-between items-center py-4 border-t border-gray-200">
                                        <h1 class="max-w-[250px]">{{ $video->name }}</h1>

                                        <!-- Play button for each video -->
                                        <div class="relative overflow-hidden rounded-lg flex">
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (Auth::user()->hasActiveSubscription())
                                                        @if ($isEnrolled)
                                                            <button
                                                                onclick="playVideo('{{ $video->id }}', '{{ $video->path_video ?? '' }}');"
                                                                class="hover:underline text-blue-500">Play
                                                            </button>
                                                        @else
                                                            <form action="{{ route('enroll.course', $course) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="hover:underline text-blue-500">
                                                                    Play
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                @endauth
                                                @guest
                                                    <div class=""></div>
                                                @endguest
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth::user()->hasActiveSubscription() && $isEnrolled)
                                        <div class="py-4 border-t border-gray-200">
                                            {{-- @if ($isCompleted) --}}
                                                <a href="{{ route('course.download-certificate', $course) }}"
                                                class="w-full flex items-center justify-center gap-2 text-white rounded p-2 bg-gradient-to-br from-green-600 to-green-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#ffffff" viewBox="0 0 256 256">
                                                        <path d="M128,140a12,12,0,0,1-12,12H72a12,12,0,0,1,0-24h44A12,12,0,0,1,128,140ZM116,88H72a12,12,0,0,0,0,24h44a12,12,0,0,0,0-24Zm120,79.14V228a12,12,0,0,1-17.95,10.42L196,225.82,174,238.42A12,12,0,0,1,156,228V204H40a20,20,0,0,1-20-20V56A20,20,0,0,1,40,36H216a20,20,0,0,1,20,20V88.86a55.87,55.87,0,0,1,0,78.28ZM196,160a32,32,0,1,0-32-32A32,32,0,0,0,196,160Zm-40,20V167.14a56,56,0,0,1,56-92.8V60H44V180Zm56,27.32V181.66a55.87,55.87,0,0,1-32,0v25.66l10.05-5.74a12,12,0,0,1,11.9,0Z">
                                                        </path>
                                                    </svg>
                                                    <span>Download Certificate</span>
                                                </a>
                                            {{-- @else
                                                <button disabled style="cursor:not-allowed;"
                                                        class="w-full flex items-center justify-center gap-2 text-white rounded p-2 bg-gradient-to-br from-green-600 to-green-500 opacity-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="#ffffff" viewBox="0 0 256 256">
                                                        <path d="M128,140a12,12,0,0,1-12,12H72a12,12,0,0,1,0-24h44A12,12,0,0,1,128,140ZM116,88H72a12,12,0,0,0,0,24h44a12,12,0,0,0,0-24Zm120,79.14V228a12,12,0,0,1-17.95,10.42L196,225.82,174,238.42A12,12,0,0,1,156,228V204H40a20,20,0,0,1-20-20V56A20,20,0,0,1,40,36H216a20,20,0,0,1,20,20V88.86a55.87,55.87,0,0,1,0,78.28ZM196,160a32,32,0,1,0-32-32A32,32,0,0,0,196,160Zm-40,20V167.14a56,56,0,0,1,56-92.8V60H44V180Zm56,27.32V181.66a55.87,55.87,0,0,1-32,0v25.66l10.05-5.74a12,12,0,0,1,11.9,0Z">
                                                        </path>
                                                    </svg>
                                                    <span>Complete Course to Download Certificate</span>
                                                </button>
                                            @endif --}}
                                        </div>
                                        @endif
                                    @endauth
                                    @guest
                                        <div class=""></div>
                                    @endguest
                                @endif
                            @else
                                <div class="text-gray-500 italic py-4 border-t border-gray-200">
                                    No lessons available for this course yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
            <div class="flex flex-col-reverse lg:flex-row gap-8">
                <div class="w-full lg:w-8/12">
                    <h1 class="text-2xl font-semibold mb-4">Description</h1>
                    <p class="text-gray-600 leading-10 text-justify">{{ $course->desc }}</p>
                    <h1 class="text-2xl font-semibold mt-12 mb-4">Teacher</h1>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            @php
                                $avatarUrl = asset('assets/images/profile1.png'); // Default avatar URL

                                if ($course->teacher->user->avatar) {
                                    if (Str::startsWith($course->teacher->user->avatar, 'https://')) {
                                        $avatarUrl = $course->teacher->user->avatar;
                                    } elseif (Str::startsWith($course->teacher->user->avatar, 'avatars/')) {
                                        $avatarUrl = Storage::url($course->teacher->user->avatar);
                                    }
                                }
                            @endphp

                            <img id="avatar-preview" class="h-10 w-10 object-cover rounded-full"
                                src="{{ $avatarUrl }}" alt="User Avatar" loading="lazy" />
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
                    <div class="rounded-lg border w-full px-4 flex flex-col mb-12">
                        <div class="flex justify-between py-4">
                            <h1>Introduction</h1>
                            <button
                                onclick="document.getElementById('mainVideoPlayer').src = '{{ $course->path_trailer ?? 'https://www.youtube.com/embed/T1TR-RGf2Pw' }}';"
                                class="hover:underline text-blue-500">Preview
                            </button>
                        </div>
                        <div>
                            @if ($course->course_videos && $course->course_videos->count() > 0)
                                @foreach ($course->course_videos as $index => $video)
                                    <div class="flex justify-between items-center py-4 border-t border-gray-200">
                                        <h1 class="max-w-[250px]">{{ $video->name }}</h1>

                                        <!-- Play button for each video -->
                                        <div class="relative overflow-hidden rounded-lg flex">
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (Auth::user()->hasActiveSubscription())
                                                        @if ($isEnrolled)
                                                            <button
                                                                onclick="document.getElementById('mainVideoPlayer').src = '{{ $video->path_video ?? '' }}';"
                                                                class="hover:underline text-blue-500">Play
                                                            </button>
                                                        @else
                                                            <form action="{{ route('enroll.course', $course) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="hover:underline text-blue-500">
                                                                    Play
                                                                </button>
                                                            </form>
                                                        @endif
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
                </div>
                <div class="w-full lg:w-4/12 relative">
                    <div class="pb-8 sticky top-24">
                        <div class="rounded-lg border p-4 space-y-4">
                            <div id="fixedVideoPlayer" class="overflow-hidden rounded w-full h-[200px] shadow-md">
                            </div>
                            {{-- </div> --}}

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

    <script>
        // Elements
        const mainVideoContainer = document.getElementById('mainVideoContainer');
        const mainVideoPlayer = document.getElementById('mainVideoPlayer');
        const fixedVideoContainer = document.getElementById('fixedVideoPlayer');

        // Variable to track if the video has been moved
        let videoMoved = false;

        // Track scrolling
        window.addEventListener('scroll', () => {
            const mainVideoRect = mainVideoContainer.getBoundingClientRect();

            // Check if the main video has scrolled out of view (entirely out of the viewport)
            if (mainVideoRect.bottom <= 0 && !videoMoved) {
                // Move video to fixed container
                fixedVideoContainer.appendChild(mainVideoPlayer);
                fixedVideoContainer.classList.remove('hidden');
                videoMoved = true;
            } else if (mainVideoRect.bottom > 0 && videoMoved) {
                // Restore the video to the original container if it's scrolled back into view
                mainVideoContainer.appendChild(mainVideoPlayer);
                fixedVideoContainer.classList.add('hidden');
                videoMoved = false;
            }
        });

        function playVideo(videoId, videoPath) {
        // Set video player source
        document.getElementById('mainVideoPlayer').src = videoPath;

        // Send AJAX request to mark video as watched
        fetch(`{{ url('course/'.$course->id.'/video') }}/${videoId}/watch`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ course_id: '{{ $course->id }}', video_id: videoId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Video marked as watched');
                // Optionally update UI or provide user feedback
            }
        })
        .catch(error => {
            console.error('Error marking video as watched:', error);
        });
    }
    </script>

</body>

</html>
