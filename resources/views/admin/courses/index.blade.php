<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full lg:w-5/6 h-screen">
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="text-2xl font-semibold">Add Course</div>
                        <a href="{{ route('admin.courses.create') }}"
                            class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 duration-300 ease-in-out">
                            Add Course
                        </a>
                    </div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    <div class="rounded-lg px-6 pt-6 pb-2 shadow-lg border border-gray-200">
                        <table id="dataTable" class="display" style="width:100%">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Course</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teacher</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($courses as $index => $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">{{ $index + 1 }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">{{ $course->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">{{ $course->category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">{{ $course->teacher->user->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $course->created_at->format('Y-m-d') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('admin.courses.show', $course) }}"
                                            class="text-blue-500 hover:text-white font-semibold bg-white hover:bg-blue-500 border border-blue-500 rounded px-2 py-1 transition duration-300 ease-in-out">View</a>
                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                            class="text-yellow-500 hover:text-white font-semibold bg-white hover:bg-yellow-500 border border-yellow-500 rounded px-2 py-1 transition duration-300 ease-in-out">Edit</a>
                                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="text-red-500 hover:text-white font-semibold bg-white hover:bg-red-500 border border-red-500 rounded px-2 py-1 transition duration-300 ease-in-out">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
