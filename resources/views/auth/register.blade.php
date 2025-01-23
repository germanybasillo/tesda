<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name of Institution')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
	</div>

 
    
<div class="mt-4">
    <x-input-label for="logo" :value="__('Logo')" />
    <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" placeholder="Please Upload your School Logo" value="{{ old('logo') }}" autocomplete="logo" onchange="previewImage(event)" />
    <x-input-error :messages="$errors->get('logo')" class="mt-2" />

    <!-- Image Preview -->
    <div id="imagePreviewContainer" style="display:none; margin-top: 10px; text-align: center; margin-left:120px;">
        
<img id="imagePreview" src="#" alt="Image Preview" style="width: 150px; height: 150px; border: 1px solid #ccc; border-radius: 50%; object-fit: cover;">
    </div>
</div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>


<script>
function previewImage(event) {
    const file = event.target.files[0]; // Get the selected file
    const previewContainer = document.getElementById('imagePreviewContainer');
    const imagePreview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result; // Set image preview source
            previewContainer.style.display = 'block'; // Show the preview container
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    } else {
        previewContainer.style.display = 'none'; // Hide the preview container if no file is selected
    }
}
</script>


</x-guest-layout>
    