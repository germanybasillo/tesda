<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"><i class="fas fa-calendar-alt mr-2"></i>
            {{ __('Update Assessment Schedule') }}
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
                            <h1 class="text-2xl font-bold mb-6 text-center">Update Assessment Date</h1>

                            <!-- Form for updating assessment -->
                            <form action="{{ route('assessments.update', $assessment->id) }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')  <!-- This will allow the form to use the PUT method for updates -->

                                <div>
                                    <label for="assessment_date" class="block text-sm font-medium mb-2">
                                        Desired Date of Assessment:
                                    </label>
                                    <input type="text" id="assessment_date" name="assessment_date" required 
                                    value="{{ old('assessment_date', $assessment->assessment_date) }}"
                                    placeholder="MM/DD/YYYY"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                </div>

                                <div>
                                    <label for="qualification" class="block text-sm font-medium mb-2">
                                        Qualification:
                                    </label>
                                    <select id="qualification" name="qualification" required 
                                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled>Select your qualification</option>
                                        <option value="FBS NC II" {{ $assessment->qualification == 'FBS NC II' ? 'selected' : '' }}>FBS NC II</option>
                                        <option value="CSS NC II" {{ $assessment->qualification == 'CSS NC II' ? 'selected' : '' }}>CSS NC II</option>
                                        <option value="Cook NC II" {{ $assessment->qualification == 'Cook NC II' ? 'selected' : '' }}>Cook NC II</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="no_of_pax" class="block text-sm font-medium mb-2">
                                        Number of Pax:
                                    </label>
                                    <select id="no_of_pax" name="no_of_pax" required 
                                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled>Select your number of pax</option>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $assessment->no_of_pax == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div>
                                    <label for="training_status" class="block text-sm font-medium mb-2">
                                        Training Status:
                                    </label>
                                    <select id="training_status" name="training_status" required 
                                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled>Select your training status</option>
                                        <option value="scholar" {{ $assessment->training_status == 'scholar' ? 'selected' : '' }}>Scholar</option>
                                        <option value="non-scholar" {{ $assessment->training_status == 'non-scholar' ? 'selected' : '' }}>Non-Scholar</option>
                                    </select>
                                </div>

                                <div id="scholarship_div" style="{{ $assessment->training_status == 'scholar' ? 'display:block;' : 'display:none;' }}">
                                    <label for="scholarship" class="block text-sm font-medium mb-2">
                                        Scholarship Type:
                                    </label>
                                    <select id="scholarship" name="type_of_scholar" 
                                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                                        <option value="" disabled>Select your scholarship type</option>
                                        <option value="ttsp" {{ $assessment->type_of_scholar == 'ttsp' ? 'selected' : '' }}>TTSP</option>
                                        <option value="cfsp" {{ $assessment->type_of_scholar == 'cfsp' ? 'selected' : '' }}>CFSP</option>
                                        <option value="uaqtea" {{ $assessment->type_of_scholar == 'uaqtea' ? 'selected' : '' }}>UAQTEA</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <label for="agree" class="inline-flex items-center">
                                        <input type="checkbox" id="agree" name="agree" class="mr-2" 
                                               {{ old('agree', $assessment->agree) ? 'checked' : '' }} />
                                        I agree to the terms and conditions
                                    </label>
                                </div>

                                <div class="mt-4">
                                    <button id="submit_button" type="submit" 
                                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300" 
                                            disabled>Update Schedule</button>
                                </div>
                            </form>

                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                            <script>
                                // Toggle visibility of the scholarship dropdown based on the training status
                                document.getElementById('training_status').addEventListener('change', function () {
                                    var scholarshipDiv = document.getElementById('scholarship_div');
                                    if (this.value === 'scholar') {
                                        scholarshipDiv.style.display = 'block';  // Show the scholarship dropdown
                                    } else {
                                        scholarshipDiv.style.display = 'none';  // Hide the scholarship dropdown
                                    }
                                });

                                // Enable or disable the submit button based on the checkbox
                                document.getElementById('agree').addEventListener('change', function () {
                                    var submitButton = document.getElementById('submit_button');
                                    submitButton.disabled = !this.checked;  // Disable if checkbox is not checked
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
