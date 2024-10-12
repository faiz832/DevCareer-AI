<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Course - CodeCareer</title>

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

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tab-btn.active {
            border-bottom: 2px solid;
            border-color: #2563eb;
            color: #2563eb
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-white">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Hero Section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8 mt-12 mb-20">
            <h1
                class="text-6xl text-center font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-blue-400 my-12">
                Courses</h1>
            <p class="w-full lg:w-2/4 mx-auto text-center text-lg">Build your career as a professional developer. Choose
                from a
                wide variety of professional development courses designed to enhance your skills and improve your
                career.</p>
        </section>

        <!-- Course selection section -->
        <section class="max-w-[1200px] mx-auto p-4 py-6 lg:py-8 mb-20">
            <!-- Tabs -->
            <div class="flex justify-center mb-8 space-x-4">
                @foreach ($categories as $index => $category)
                    <button
                        class="tab-btn {{ $index === 0 ? 'active' : '' }} px-4 py-2 text-sm sm:text-base text-gray-600 border-b-2 border-transparent hover:text-blue-600 hover:border-blue-600"
                        data-target="tab{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            </div>

            <!-- Tab Contents -->
            @foreach ($categories as $index => $category)
                <div id="tab{{ $category->id }}" class="tab-content {{ $index === 0 ? 'active' : '' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($coursesByCategory[$category->id] as $course)
                            <div
                                class="bg-white border rounded-lg p-3 hover:shadow-lg hover:-translate-y-2 transition duration-300 ease-in-out transform flex flex-col justify-between">
                                <img src="{{ Storage::url($course->thumbnail) ?? 'https://via.placeholder.com/400x200' }}"
                                    alt="{{ $course->name }}" class="w-full h-48 shadow-md object-cover rounded-lg mb-4"
                                    loading="lazy">

                                <div class="flex flex-col flex-grow">
                                    <h1 class="font-semibold text-xl mb-2">{{ $course->name }}</h1>

                                    <div class="flex flex-col justify-between h-full">
                                        <p class="text-md text-gray-600 min-h-16">{{ $course->about }}</p>
                                        <p class="text-sm text-gray-600 mb-2">By {{ $course->teacher->user->name }}</p>
                                    </div>

                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-800" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="text-xs text-gray-800">{{ $course->students->count() }}
                                                Students</span>
                                        </div>

                                        <a href="{{ route('front.details', $course->id) }}"
                                            class="text-center font-semibold bg-blue-500 text-sm hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out w-1/2">
                                            Learn Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Remove 'active' class from all tabs and buttons
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

                // Add 'active' class to the clicked button and target tab
                const targetTab = document.getElementById(button.getAttribute('data-target'));
                targetTab.classList.add('active');
                button.classList.add('active');
            });
        });
    </script>
</body>

</html>
