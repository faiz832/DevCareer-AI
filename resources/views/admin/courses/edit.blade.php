<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full min-h-screen lg:w-5/6">
                <div class="bg-white overflow-hidden p-4 sm:p-8 shadow-sm sm:rounded-lg">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        {{ __('Edit Course') }}
                    </h2>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-4 mb-4 w-full rounded-lg bg-red-500 text-white">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('admin.courses.update', $course) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name', $course->name)" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="path_trailer" :value="__('Trailer Path')" />
                            <x-text-input id="path_trailer" class="block mt-1 w-full" type="text" name="path_trailer"
                                :value="old('path_trailer', $course->path_trailer)" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="about" :value="__('About')" />
                            <textarea id="about" name="about"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4" required>{{ old('about', $course->about) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="desc" :value="__('Desc')" />
                            <textarea id="desc" name="desc"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="4" required>{{ old('about', $course->desc) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="Current Thumbnail"
                                class="w-32 h-32 object-cover mb-2">
                            <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @role('owner')
                            <div class="mb-4">
                                <x-input-label for="teacher_id" :value="__('Teacher')" />
                                <select id="teacher_id" name="teacher_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endrole

                        <div class="flex items-center justify-end mt-12 gap-4">
                            <a href="{{ route('admin.courses.index') }}"
                                class="py-2 px-4 bg-white text-gray-700 rounded border border-gray-300 hover:bg-gray-50 transition duration-300 ease-in-out">Cancel</a>
                            <button type="submit"
                                class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300 ease-in-out">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
