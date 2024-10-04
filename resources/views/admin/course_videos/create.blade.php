<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6">
                <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Add New Video to Course') }}
                    </h2>

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 w-full rounded-lg bg-red-500 text-white">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{route('admin.course.add_video.save', $course->id)}}" enctype="multipart/form-data"">
                        @csrf

                        <input type="hidden" name="course_id" value="{{ $course->id }}">

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Video Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="path_video" :value="__('Video URL (YouTube)')" />
                            <x-text-input id="path_video" class="block mt-1 w-full" type="text" name="path_video" :value="old('path_video')" required />
                            <p class="text-sm text-gray-500 mt-1">Please enter the YouTube video ID (e.g., dQw4w9WgXcQ)</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add Video') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
