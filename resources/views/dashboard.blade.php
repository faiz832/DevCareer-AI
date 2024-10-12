<x-app-layout>
    <div class="flex">
        <div class="w-[1200px] relative flex items-start mx-auto p-4 py-6 lg:py-8 gap-8">
            @include('layouts.sidebar')
            <!-- Main Content -->
            <div class="w-full min-h-screen lg:w-5/6">
                @role('owner')
                    <div class="space-y-6">
                        <div class="">
                            <div class="text-2xl font-semibold">Hello {{ Auth::user()->name }}</div>
                            <h1 class="text-sm text-gray-500">Welcome Back!</h1>
                        </div>

                        <!-- Statistic -->
                        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-6 shadow-xl">
                            <div class="text-lg font-semibold text-white mb-4">Statistics</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                                <path
                                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Teachers</div>
                                            <div class="text-xs">{{ $teacherCount }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Students</div>
                                            <div class="text-xs">{{ $studentCount }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Courses</div>
                                            <div class="text-xs">{{ $courseCount }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">Transactions</div>
                                            <div class="text-xs">{{ $subscriptionCount }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activity -->
                        <div class="text-xl">Activity</div>
                        <div class="bg-white rounded-lg px-6 pt-6 pb-2 shadow border border-gray-200">
                            <table id="dataTable" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Account</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Details</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Example row, repeat as needed -->
                                    @foreach ($activities as $activity)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $activity->causer->name ?? 'System' }}</div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $activity->causer->email ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $activity->description }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    @if ($activity->subject)
                                                        {{ class_basename($activity->subject_type) }}
                                                        #{{ $activity->subject_id }}
                                                    @endif
                                                    @if ($activity->properties->has('attributes'))
                                                        @foreach ($activity->properties['attributes'] as $key => $value)
                                                            <div>{{ $key }}:
                                                                {{ is_array($value) ? json_encode($value) : $value }}</div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $activity->created_at->format('Y-m-d H:i') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endrole

                @role('teacher')
                    <div class="space-y-6">
                        <div class="">
                            <div class="text-2xl font-semibold">Hello {{ Auth::user()->name }}</div>
                            <h1 class="text-sm text-gray-500">Welcome Back!</h1>
                        </div>

                        <!-- Statistic -->
                        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-6 shadow-xl">
                            <div class="text-lg font-semibold text-white mb-4">Statistics</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">My Courses</div>
                                            <div class="text-xs">{{ $courseCount }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                    <div class="flex items-center gap-4">
                                        <div class="rounded p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="text-white text-start">
                                            <div class="text-xl font-semibold">My Students</div>
                                            <div class="text-xs">{{ $totalStudents }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-4 sm:p-8 shadow-xl">
                            <div class="text-lg font-semibold text-gray-800">Teaching Activities</div>
                            <div class="space-y-6 mt-6">
                                @if ($courses->isEmpty())
                                    <div class="flex border rounded justify-between items-center p-4">
                                        <div class="flex-col">
                                            <div class="text-sm font-semibold text-gray-800">You are not teaching any
                                                courses.</div>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('admin.courses.create') }}" class="text-blue-500">Create a
                                                new course</a>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($courses as $course)
                                        <div class="flex border rounded justify-between items-center p-4">
                                            <div class="flex-col">
                                                <div class="text-sm font-semibold text-gray-800">Teaching</div>
                                                <div class="mt-2">{{ $course->name }}</div>
                                            </div>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-semibold text-red-500">Stop
                                                    Teaching</button>
                                            </form>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endrole

                @role('student')
                    <div class="space-y-6">
                        <div class="">
                            <div class="text-2xl font-semibold">Hello {{ Auth::user()->name }}</div>
                            <h1 class="text-sm text-gray-500">Welcome Back!</h1>
                        </div>

                        <!-- Subscription -->
                        <div class="bg-gradient-to-br from-blue-700 to-blue-400 rounded-lg p-4 sm:p-8 shadow-xl">
                            <div class="text-lg font-semibold text-white mb-4">Subscription</div>
                            <div
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm rounded-lg p-3 md:p-5 text-center">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="p-2">
                                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div class="text-start text-sm w-3/4 text-white">
                                            @if ($subscription)
                                                @php
                                                    // Hitung tanggal akhir langganan
                                                    $endDate = \Carbon\Carbon::parse(
                                                        $subscription->subscription_start_date,
                                                    )->addMonth();
                                                @endphp
                                                Your subscription is active until {{ $endDate->format('d M Y') }}.
                                            @else
                                                You haven't subscribed to codecareer yet. Choose a subscription and start
                                                your journey to becoming a professional developer.
                                            @endif
                                        </div>
                                    </div>
                                    @if ($subscription)
                                        <span
                                            class="bg-white rounded px-4 py-2 font-semibold text-sm text-blue-500">Active</span>
                                    @else
                                        <a href="{{ url('/pricing') }}"
                                            class="bg-white rounded px-4 py-2 font-semibold text-sm text-blue-500">Subscribe</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- My Courses -->
                        <div class="w-full rounded-lg bg-white shadow p-4 sm:p-8">
                            <div class="text-lg font-semibold text-gray-800">My Courses</div>
                            <div class="space-y-6 mt-6">
                                @if ($courses->isEmpty())
                                    <div class="flex border rounded justify-between items-center p-4">
                                        <div class="flex-col">
                                            <div class="text-sm font-semibold text-gray-800">You are not subscribed to any
                                                courses.</div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($courses as $course)
                                        <div class="flex border rounded justify-between items-center p-4">
                                            <div class="flex-col">
                                                <div class="text-sm font-semibold text-gray-800">Learning</div>
                                                <div class="mt-2">{{ $course->name }}</div>
                                            </div>
                                            <a href="{{ route('front.details', $course->id) }}"
                                                class="text-sm font-semibold text-blue-500 px-4 py-2">Continue</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
