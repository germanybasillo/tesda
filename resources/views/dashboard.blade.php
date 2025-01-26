
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-home mr-2"></i>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


@php
    $now = \Carbon\Carbon::now('Asia/Manila');
    $start = $now->copy()->startOfWeek()->addDays(0)->setTime(0, 0); // Thursday 12:00 AM
    $end = $now->copy()->startOfWeek()->addDays(0)->setTime(23, 59); // Thursday 11:59 PM

    $isAvailable = $now->between($start, $end);
@endphp

<div class="py-12">
    @if ($isAvailable)
        <a href="{{ route('applyassessmentschedule') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center">
            <i class="fas fa-calendar-check mr-2"></i> Apply Assessment Scheduling
        </a>
    @else
        <button onclick="alert('Assessment scheduling is only available on Thursday. Thank you.');" 
                class="bg-gray-400 text-white px-4 py-2 rounded shadow cursor-not-allowed flex items-center">
            <i class="fas fa-calendar-check mr-2"></i> Apply Assessment Scheduling
        </button>
    @endif
</div>

@if (session('error'))
    <div class="alert alert-danger mt-2">
        {{ session('error') }}
    </div>
@endif

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
                                    <th class="p-2 border-b">Assessment Date</th>
                                    <th class="p-2 border-b">Qualification</th>
                                    <th class="p-2 border-b">No of Pax</th>
                                    <th class="p-2 border-b">Training Status</th>
                                    <th class="p-2 border-b">Type of Scholar</th>
                                    <th class="p-2 border-b">Status</th>
				    <th class="p-2 border-b">Actions</th>
		                    <th class="p-2 border-b">View PDF Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assessments as $assessment)
                                    <tr>
                                        <td class="p-2 border-b">{{ $assessment->id }}</td>
					<td class="p-2 border-b">{{ $assessment->user->name }}</td>
                                        <td class="p-2 border-b">{{ $assessment->assessment_date }}</td>
                                        <td class="p-2 border-b">{{ $assessment->qualification }}</td>
                                        <td class="p-2 border-b">{{ $assessment->no_of_pax }}</td>
                                        <td class="p-2 border-b">{{ $assessment->training_status }}</td>
                                        <td class="p-2 border-b">
                    {{ $assessment->training_status == 'scholar' ? $assessment->type_of_scholar : 'N/A' }}
		</td>                   
		     <td class="p-2 border-b">
                                            <span 
                                                class="px-2 py-1 rounded 
                                                @if($assessment->status == 'pending') 
                                                    text-white bg-red-500 
                                                @else 
                                                    text-white bg-green-500 
                                                @endif">
                                                {{ $assessment->status }}
                                            </span>
                                        </td>
                                       <td class="p-2 border-b">
    @if($assessment->status == 'pending')
        <a href="{{ route('assessments.edit', $assessment->id) }}" 
            class="text-white px-2 py-1 rounded"
            style="background-color: #10B981; hover:bg-green-500;">
            Edit
        </a>
    @else
        <span class="text-gray-500">Cannot Edit</span>
    @endif
</td> 



<td class="p-2 border-b">
  
      <a href="#" 
               class="view-documents" 
               data-id="{{ $assessment->id }}" 
               data-eltt="{{ $assessment->eltt }}" 
               data-rfftp="{{ $assessment->rfftp }}" 
               data-oropfafns="{{ $assessment->oropfafns }}"
               data-sopcctvr="{{ $assessment->sopcctvr }}">
               Click Here
            </a>
</td>

            </tr>
        @empty
            <tr>
                <td colspan="10" class="p-2 text-center text-gray-500">No assessments found.</td>
            </tr>
        @endforelse
    </tbody>
</table>                    
</div>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', () => {
    // Use event delegation to ensure the listener is attached to dynamically created elements
    document.body.addEventListener('click', (event) => {
        if (event.target.classList.contains('view-documents')) {
            event.preventDefault(); // Prevent the default link behavior

            // Extract data attributes from the clicked element
            const id = event.target.getAttribute('data-id');
            const eltt = event.target.getAttribute('data-eltt');
            const rfftp = event.target.getAttribute('data-rfftp');
            const oropfafns = event.target.getAttribute('data-oropfafns');
            const sopcctvr = event.target.getAttribute('data-sopcctvr');

            // Trigger SweetAlert2 modal
            Swal.fire({
                title: 'Priority ( NO: ' + id + ')',
                html: `
                    <ul style="text-align: left; list-style: none; padding: 0;">
                        <li><strong>ELTT:</strong> <a href="/${eltt}" target="_blank">${eltt}</a></li>
                        <li><strong>RFFTP:</strong> <a href="/${rfftp}" target="_blank">${rfftp}</a></li>
                        <li><strong>OROPFAFNS:</strong> <a href="/${oropfafns}" target="_blank">${oropfafns}</a></li>
                        <li><strong>SOPCCTVR:</strong> <a href="/${sopcctvr}" target="_blank">${sopcctvr}</a></li>
                    </ul>
                `,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        }
    });
});
</script>
</x-app-layout>

