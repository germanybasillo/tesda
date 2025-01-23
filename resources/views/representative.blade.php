<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <i class="fas fa-users mr-2"></i>
        {{ __('TRIP REPRESENTATIVE') }}
    </h2>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">REPRESENTATIVE</h3>

                    <div style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; border-radius: 8px;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #007bff; color: white; text-align: left;">
                                    <th class="p-2 border-b">Email</th>
                                    <th class="p-2 border-b">Date</th>
                                    <th class="p-2 border-b">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Load the assessments directly in the Blade file
                                    $assessments = \App\Models\Assessment::with('user')->get();
                                    
                                    // Filter and select random representatives
                                    $approvedAssessments = $assessments->filter(fn($assessment) => $assessment->status === 'approved');
                                    $randomRepresentatives = $approvedAssessments->random(min(5, $approvedAssessments->count()));
                                @endphp

                                @forelse ($randomRepresentatives as $representative)
                                    <tr>
                                        <td class="p-2 border-b">{{ $representative->user->email }}</td>
                                        <td class="p-2 border-b">{{ $representative->created_at->format('Y-m-d') }}</td>
                                        <td class="p-2 border-b">{{ $representative->created_at->format('H:i:s') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="p-2 text-center text-gray-500">No representative yet.</td>
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
