<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"><i class="fas fa-calendar-alt mr-2"></i>
            {{ __('Apply Assessment Schedule') }}
        </h2>
    </x-slot>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-12 flex items-center justify-center min-h-screen">
                <div class="w-1/2 sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8 text-gray-900 dark:text-gray-100">
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                            <style>
                                .holiday {
                                    background-color: red !important;
                                    color: white !important;
                                    border-radius: 50%;
                                    font-weight: bold;
                                }
                            </style>

                <form action="{{ route('assessments.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
			    @csrf



				<div id="step1">

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <i class="fas fa-calendar-alt mr-2"></i>
        {{ __('Apply Assessment Schedule') }}
    </h2>

   <div>
    <label for="assessment_date" class="block text-sm font-medium mb-2">
        Desired Date of Assessment:    </label>
    <input 
        type="date" 
        id="assessment_date" 
        name="assessment_date" 
        required 
        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
    >
</div>
                                                                 <div>
                                    <label for="qualification" class="block text-sm font-medium mb-2">
                                        Qualification:
                                    </label>
                                    <select id="qualification" name="qualification" required 
					    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled selected>Select your qualification</option>
                                        <option value="FBS NC II">FBS NC II</option>
                                        <option value="CSS NC II">CSS NC II</option>
					<option value="Cook NC II">Cook NC II</option>
                                        <option value="Driving NC II">Driving NC II</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="no_of_pax" class="block text-sm font-medium mb-2">
                                        Number of Pax:
                                    </label>
                                    <select id="no_of_pax" name="no_of_pax" required 
					    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled selected>Select your number of tax</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <label for="training_status" class="block text-sm font-medium mb-2">
                                        Training Status:
                                    </label>
                                    <select id="training_status" name="training_status" required 
					    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled selected>Select your training status</option>
                                        <option value="scholar">Scholar</option>
                                        <option value="non-scholar">Non-Scholar</option>
                                    </select>
                                </div>

                                <div id="scholarship_div" style="display: none;">
                                    <label for="scholarship" class="block text-sm font-medium mb-2">
                                        Scholarship Type:
                                    </label>
				    <select id="scholarship" name="type_of_scholar" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled selected>Select your scholarship type</option>
                                        <option value="ttsp">TTSP</option>
                                        <option value="cfsp">CFSP</option>
					<option value="uaqtea">UAQTEA</option>
                                        <option value="uaqtea">TWSP</option>

                                    </select>
				</div>

<div>
    <label for="agreement" class="flex items-center space-x-2">
        <input type="checkbox" id="agreement" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
        <span>I agree to the terms and conditions.</span>
    </label>
</div>

    
<button type="button" id="next_button" 
        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50" 
        disabled>
    Apply Schedule
</button>

   <!-- Cancel Button to go back -->
   <button type="button" id="cancel_button" 
            class="mt-4 px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400"
            onclick="window.history.back();">
            Cancel
        </button>

            </div>
 <!-- Step 2: Document Upload -->
    <div id="step2" style="display: none;">
        
    <!-- Document Title -->
    <div id="qualificationTitle" class="mt-4">
            <h2>Please upload your document here (PDF)</h2>
        </div>

<!-- Endorsement Letter To TESDA -->
<div class="mt-4">
    <x-input-label for="elttDocument" :value="__('Endorsement Letter To TESDA')" />
    <x-text-input id="elttDocument" class="block mt-1 w-full" type="file" name="eltt" placeholder="Please upload your document here (PDF)" value="{{ old('eltt') }}" autocomplete="eltt" onchange="previewDocument(event, 'elttPreviewContainer', 'elttPreview')" required/>
    <x-input-error :messages="$errors->get('eltt')" class="mt-2" />

    <!-- Document Preview -->
    <div id="elttPreviewContainer" style="display:none; margin-top: 10px; text-align: center;">
        <iframe id="elttPreview" src="#" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
    </div>
</div>

<!-- Request Form For Test Package -->
<div class="mt-4">
    <x-input-label for="rfftpDocument" :value="__('Request Form For Test Package')" />
    <x-text-input id="rfftpDocument" class="block mt-1 w-full" type="file" name="rfftp" placeholder="Please upload your document here (PDF)" value="{{ old('rfftp') }}" autocomplete="rfftp" onchange="previewDocument(event, 'rfftpPreviewContainer', 'rfftpPreview')" required/>
    <x-input-error :messages="$errors->get('rfftp')" class="mt-2" />

    <!-- Document Preview -->
    <div id="rfftpPreviewContainer" style="display:none; margin-top: 10px; text-align: center;">
        <iframe id="rfftpPreview" src="#" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
    </div>
</div>

<!-- Official Receipt of Payment for Assessment for Non-Scholar -->
<div class="mt-4">
    <x-input-label for="oropfafnsDocument" :value="__('Official Receipt of Payment for Assessment for Non-Scholar')" />
    <x-text-input id="oropfafnsDocument" class="block mt-1 w-full" type="file" name="oropfafns" placeholder="Please upload your document here (PDF)" value="{{ old('oropfafns') }}" autocomplete="oropfafns" onchange="previewDocument(event, 'oropfafnsPreviewContainer', 'oropfafnsPreview')" required/>
    <x-input-error :messages="$errors->get('oropfafns')" class="mt-2" />

    <!-- Document Preview -->
    <div id="oropfafnsPreviewContainer" style="display:none; margin-top: 10px; text-align: center;">
        <iframe id="oropfafnsPreview" src="#" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
    </div>
</div>


<!-- Submission of Previous CCTV Recordings -->
<div class="mt-4">
    <x-input-label for="sopcctvrDocument" :value="__('Submission of Previous CCTV Recordings')" />
    <x-text-input id="sopcctvrDocument" class="block mt-1 w-full" type="file" name="sopcctvr" placeholder="Please upload your document here (PDF)" value="{{ old('sopcctvr') }}" autocomplete="sopcctvr" onchange="previewDocument(event, 'sopcctvrPreviewContainer', 'sopcctvrPreview')" required/>
    <x-input-error :messages="$errors->get('oropfafns')" class="mt-2" />

    <!-- Document Preview -->
    <div id="sopcctvrPreviewContainer" style="display:none; margin-top: 10px; text-align: center;">
        <iframe id="sopcctvrPreview" src="#" style="width: 100%; height: 500px; border: 1px solid #ccc;"></iframe>
    </div>
</div>
 

	<div class="mt-4">
                                    <button id="submit_button" type="submit" 
                                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300" 
                                     >Submit</button>

                                      <!-- Cancel Button to go back -->
                                      <button type="button" id="cancel_button_step2" 
    class="mt-4 px-4 py-2 bg-gray-300 text-black rounded-lg hover:bg-gray-400"
    onclick="goBackToStep1();">
    Cancel
</button>

				</div>
</div>
</form>

<script>
    // Handle qualification selection and dynamically update Step 2 title
    document.getElementById('qualification').addEventListener('change', function() {
        const qualification = this.value;
        const titleElement = document.getElementById('qualificationTitle');

        // Update title based on selected qualification
        if (qualification) {
            titleElement.innerHTML = `<h3>Please add PDF for ${qualification}</h3>`;
        }
    });
</script>

<script>
    function goBackToStep1() {
        // Hide Step 2 and show Step 1
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    }       
</script>

<script>
    document.getElementById('agreement').addEventListener('change', function () {
        const nextButton = document.getElementById('next_button');
        nextButton.disabled = !this.checked; // Enable if checked, disable otherwise
    });
</script>

<script>
function previewDocument(event, containerId, iframeId) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById(containerId);
    const previewIframe = document.getElementById(iframeId);

    if (file) {
        if (file.type === 'application/pdf') {
            const fileURL = URL.createObjectURL(file);
            previewIframe.src = fileURL;
            previewContainer.style.display = 'block';
        } else {
            alert('Please upload a valid PDF document.');
            previewContainer.style.display = 'none';
        }
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>



                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.getElementById('next_button').addEventListener('click', function () {
    const assessmentDate = document.getElementById('assessment_date').value;
    const qualification = document.getElementById('qualification').value;
    const noOfPax = document.getElementById('no_of_pax').value;
    const trainingStatus = document.getElementById('training_status').value;

    // Basic Validation
    if (!assessmentDate || !qualification || !noOfPax || !trainingStatus) {
        alert('Please fill all the required fields in Step 1.');
        return;
    }

    // Scholar-specific validation
    if (trainingStatus === 'scholar') {
        const scholarshipType = document.getElementById('scholarship').value;
        if (!scholarshipType) {
            alert('Please select a scholarship type.');
            return;
        }
    }

    // Hide Step 1 and Show Step 2
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
});




                                // Toggle visibility of the scholarship dropdown based on the training status
                                document.getElementById('training_status').addEventListener('change', function () {
                                    var scholarshipDiv = document.getElementById('scholarship_div');
                                    if (this.value === 'scholar') {
                                        scholarshipDiv.style.display = 'block';  // Show the scholarship dropdown
                                    } else {
                                        scholarshipDiv.style.display = 'none';  // Hide the scholarship dropdown
                                    }
                                });

                                // Flatpickr setup
                                const holidays = [
                                    "2025-01-01",  // New Year's Day
                                    "2025-02-14",  // Valentine's Day
                                    "2025-04-01",  // April Fools' Day
                                    "2025-12-25"   // Christmas
                                ];

                                flatpickr("#assessment_date", {
                                    altInput: true,
                                    altFormat: "F j, Y",
                                    dateFormat: "Y-m-d",
                                    minDate: "today",
                                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                                        const dateStr = dayElem.dateObj.toISOString().slice(0, 10);
                                        if (holidays.includes(dateStr)) {
                                            dayElem.classList.add("holiday");
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
