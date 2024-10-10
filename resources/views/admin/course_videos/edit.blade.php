<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full min-h-screen lg:w-5/6">
                <div class="bg-white overflow-hidden p-4 sm:p-8 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        {{ __('Edit Course Video') }}
                    </h2>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 w-full rounded-lg bg-red-500 text-white">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('admin.course_videos.update', $courseVideo) }}"
                        enctype="multipart/form-data"`>
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Video Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $courseVideo->name)" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="path_video" :value="__('Video URL (YouTube)')" />
                            <x-text-input id="path_video" class="block mt-1 w-full" type="text" name="path_video"
                                :value="old('path_video', $courseVideo->path_video)" required />
                            <p class="text-sm text-gray-500 mt-1">Please enter the YouTube video ID (e.g., dQw4w9WgXcQ)
                            </p>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <button type="button" onclick="window.history.back()"
                                class="py-2 px-4 bg-gray-200 rounded hover:bg-gray-300 transition duration-300">
                                Cancel
                            </button>
                            <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
