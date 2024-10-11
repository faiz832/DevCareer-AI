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

                    <div x-data="{ showDeleteModal: false, courseVideosToDelete: null }">
                        <!-- Delete Confirmation Modal -->
                        <div x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                            <div
                                class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <!-- Background overlay -->
                                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                    aria-hidden="true">
                                </div>

                                <!-- Modal panel -->
                                <div x-show="showDeleteModal" x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                                    <div class="sm:flex sm:items-start">
                                        <div
                                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Remove Course
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Are you sure you want to remove this course? This action cannot be
                                                    undone.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <form :action="courseVideosToDelete" method="POST"
                                            class="inline-block w-full sm:w-max">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full inline-flex justify-center rounded border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-600 sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out">
                                                Remove
                                            </button>
                                        </form>
                                        <button type="button" @click="showDeleteModal = false"
                                            class="mt-3 w-full inline-flex justify-center rounded border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm transition duration-300 ease-in-out">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- List of Course Videos -->
                        @forelse($course->course_videos as $video)
                            <div class="flex flex-row gap-y-10 justify-between items-center mt-8">
                                <div class="flex flex-row items-center gap-x-3">
                                    <iframe width="560" class="rounded object-cover w-[120px] h-[90px]"
                                        height="315" src="{{ $video->path_video }}" title="YouTube video player"
                                        frameborder="0"
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
                                    <button
                                        @click="showDeleteModal = true; courseVideosToDelete = '{{ route('admin.course_videos.destroy', $video) }}'"
                                        class="font-semibold px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300 ease-in-out">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                        @empty
                            <p class="text-slate-500 text-sm">No videos available for this course.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
