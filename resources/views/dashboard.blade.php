<x-app-layout>
    <x-slot name="header">
        {{-- Style --}}
        <style>
            @keyframes gradientMove {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .animate-gradient {
                animation: gradientMove 5s ease infinite;
            }


        </style>
        {{-- Page Title --}}
        <div class="inline-block relative">
            <h2 class="text-3xl font-extrabold bg-clip-text text-transparent
                    bg-gradient-to-r from-blue-600 via-purple-500 to-red-500
                    animate-gradient">
                MUSA GROUP BD INSTITUTE
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-6 text-center">

                {{-- Institutes --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Institutes</p>
                    <p class="text-3xl font-bold">{{ $institutesCount }}</p>
                </div>

                {{-- Trades --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Trades</p>
                    <p class="text-3xl font-bold">{{ $tradesCount }}</p>
                </div>

                {{-- Courses --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500">Courses</p>
                    <p class="text-3xl font-bold">{{ $coursesCount }}</p>
                </div>

                {{-- Students --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-orange-500">
                    <p class="text-sm text-gray-500">Students</p>
                    <p class="text-3xl font-bold">{{ $studentsCount }}</p>
                </div>


                {{--  Total Enrollments --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-pink-500">
                    <p class="text-sm text-gray-500">Total Enrollments</p>
                    <p class="text-3xl font-bold">{{ $enrollmentsCount }}</p>
                </div>


                {{-- Active Enrollments --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-500">Active Enrollments</p>
                    <p class="text-3xl font-bold">{{ $activeEnrollments }}</p>
                </div>


                {{-- Completed Enrollments --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Completed Enrollments</p>
                    <p class="text-3xl font-bold">{{ $completedEnrollments }}</p>
                </div>


                {{-- Cancelled Enrollments --}}
                <div class="bg-white shadow rounded-lg p-5 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Cancelled Enrollments</p>
                    <p class="text-3xl font-bold">{{ $cancelledEnrollments }}</p>
                </div>


            </div>


            {{-- Quick Actions --}}
            <div class="mt-10">
                <h2 class="text-lg font-semibold mb-4">Quick Actions</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="{{ route('institutes.index') }}"
                       class="block p-4 bg-blue-50 hover:bg-blue-100 rounded shadow text-center">
                        + Add Institute
                    </a>

                    <a href="{{ route('trades.index') }}"
                       class="block p-4 bg-green-50 hover:bg-green-100 rounded shadow text-center">
                        + Add Trade
                    </a>

                    <a href="{{ route('courses.index') }}"
                       class="block p-4 bg-purple-50 hover:bg-purple-100 rounded shadow text-center">
                        + Add Course
                    </a>

                    <a href="{{ route('students.index') }}"
                       class="block p-4 bg-red-50 hover:bg-red-100 rounded shadow text-center">
                        + Add Student
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Bar Chart
    new Chart(document.getElementById('overviewChart'), {
        type: 'bar',
        data: {
            labels: ['Institutes', 'Trades', 'Courses', 'Students'],
            datasets: [{
                label: 'Total Count',
                data: [
                    {{ $institutesCount }},
                    {{ $tradesCount }},
                    {{ $coursesCount }},
                    {{ $studentsCount }}
                ],
                backgroundColor: [
                    '#3b82f6', // blue
                    '#22c55e', // green
                    '#a855f7', // purple
                    '#ef4444'  // red
                ],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Doughnut Chart
    new Chart(document.getElementById('studentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [
                    {{ $activeStudents }},
                    {{ $inactiveStudents }}
                ],
                backgroundColor: [
                    '#22c55e',
                    '#ef4444'
                ]
            }]
        },
        options: {
            responsive: true,
            cutout: '50%'
        }
    });
</script>
