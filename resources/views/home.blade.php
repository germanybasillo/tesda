

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-home mr-2"></i>
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Assessment Records</h3>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 8px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #007bff; color: white; text-align: left;">
                                    <th class="p-2 border-b">No</th>
                                    <th class="p-2 border-b">Name of Institution</th>
                                    <th class="p-2 border-b">Email</th>
                                    <th class="p-2 border-b">Assessment Date</th>
                                    <th class="p-2 border-b">Qualification</th>
                                    <th class="p-2 border-b">No of Pax</th>
                                    <th class="p-2 border-b">Training Status</th>
                                    <th class="p-2 border-b">Type of Scholar</th>
                                    <th class="p-2 border-b">Status</th>
                                                                    </tr>
                            </thead>
                            <tbody>
                                @php
                                    $approvedAssessments = $assessments->filter(fn($assessment) => $assessment->status === 'approved');
                                @endphp

                                @forelse ($approvedAssessments as $assessment)
                                    <tr>
                                        <td class="p-2 border-b">{{ $assessment->id }}</td>
                                        <td class="p-2 border-b">{{ $assessment->user->name }}</td>
                                        <td class="p-2 border-b">{{ $assessment->user->email }}</td>
                                        <td class="p-2 border-b">{{ $assessment->assessment_date }}</td>
                                        <td class="p-2 border-b">{{ $assessment->qualification }}</td>
                                        <td class="p-2 border-b">{{ $assessment->no_of_pax }}</td>
                                        <td class="p-2 border-b">{{ $assessment->training_status }}</td>
                                        <td class="p-2 border-b">
                                            {{ $assessment->training_status == 'scholar' ? $assessment->type_of_scholar : 'N/A' }}
                                        </td>
                                        <td class="p-2 border-b">
                                            <span class="px-2 py-1 rounded text-white bg-green-500">
                                                {{ $assessment->status }}
                                            </span>
                                        </td>
                                                                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="p-2 text-center text-gray-500">No approved assessments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

