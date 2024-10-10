<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full min-h-screen lg:w-5/6">
                <div class="bg-white overflow-hidden p-4 sm:p-8 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        {{ __('Course Detail') }}
                    </h2>

                    <!-- Course Detail Section -->
                    <div class="flex flex-col gap-4">
                        <div class="">
                            <p class="text-sm font-medium text-gray-700">Course Name</p>
                            <h1 class="text-xl font-bold text-gray-800">{{ $course->name }}</h1>
                        </div>
                        <div class="">
                            <p class="text-sm font-medium text-gray-700">Category</p>
                            <p class="text-slate-500 text-sm">{{ $course->category->name }}</p>
                        </div>
                        <div class="">
                            <p class="text-sm font-medium text-gray-700">Thumbnail</p>
                            <img src="{{ Storage::url($course->thumbnail) }}" alt=""
                                class="rounded border object-cover w-[200px] h-[150px]">
                        </div>
                        <div class="">
                            <h1 class="text-sm font-medium text-gray-700">Teacher</h1>
                            <p class="text-slate-500 text-sm">{{ $course->teacher->user->name }}</p>
                        </div>
                        <div class="">
                            <h1 class="text-sm font-medium text-gray-700">Student</h1>
                            <p class="text-slate-500 text-sm">{{ $course->students->count() }}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <!-- Course Videos Section -->
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-col">
                            <h3 class="text-gray-800 text-xl font-semibold">Course Videos</h3>
                            <p class="text-slate-500 text-sm">{{ $course->course_videos->count() }} Total Videos</p>
                        </div>
                        <a href="{{ route('admin.course.add_video', $course->id) }}"
                            class="font-semibold px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300 ease-in-out">
                            Add New Video
                        </a>
                    </div>

                    <!-- List of Course Videos -->
                    @forelse($course->course_videos as $video)
                        <div class="flex flex-row gap-y-10 justify-between items-center mt-8">
                            <div class="flex flex-row items-center gap-x-3">
                                <iframe width="560" class="rounded object-cover w-[120px] h-[90px]" height="315"
                                    src="https://www.youtube.com/embed/{{ $video->path_video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                <div class="flex flex-col">
                                    <h3 class="text-gray-800 text-xl font-bold">{{ $video->name }}</h3>
                                    <p class="text-slate-500 text-sm">{{ $video->course->name }}</p>
                                </div>
                            </div>

                            <div class="flex flex-row items-center gap-x-3">
                                <a href="{{ route('admin.course_videos.edit', $video) }}"
                                    class="font-semibold px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.course_videos.destroy', $video) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="font-semibold px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                    @empty
                        <p class="text-slate-500 text-sm">No videos available for this course.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
