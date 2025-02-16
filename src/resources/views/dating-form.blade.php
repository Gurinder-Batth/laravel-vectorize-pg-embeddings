@extends('layouts.app')

@section('content')
<div class="container bg-gray-100">
    <form action="{{ route('dating.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Name -->
        <label class="block mb-2 text-sm font-semibold">Full Name</label>
        <input type="text" name="name" class="w-full p-2 border rounded" placeholder="Enter your name" required>
    
        <!-- Email -->
        <label class="block mt-4 mb-2 text-sm font-semibold">Email</label>
        <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Enter your email" required>
    
        <!-- Gender -->
        <label class="block mt-4 mb-2 text-sm font-semibold">Gender</label>
        <select name="gender" class="w-full p-2 border rounded" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    
        <!-- Age -->
        <label class="block mt-4 mb-2 text-sm font-semibold">Age</label>
        <input type="number" name="age" class="w-full p-2 border rounded" placeholder="Enter your age" required>

        <!-- About Me -->
        <label class="block mt-4 mb-2 text-sm font-semibold">About Me</label>
        <textarea name="bio" class="w-full p-2 border rounded" rows="4" placeholder="Write something about yourself..."></textarea>

        <!-- Interests (Checkboxes) -->
        <label class="block mt-4 mb-2 text-sm font-semibold">Interests</label>
        <div class="grid grid-cols-2 gap-2">
            @foreach(['Music', 'Traveling', 'Cooking', 'Reading', 'Gaming', 'Sports', 'Movies', 'Art'] as $interest)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="interests[]" value="{{ $interest }}" class="form-checkbox">
                    <span>{{ $interest }}</span>
                </label>
            @endforeach
        </div>

        <!-- Profile Picture -->
        <label class="block mt-4 mb-2 text-sm font-semibold">Profile Picture</label>
        <input type="file" name="photo" class="w-full p-2 border rounded" accept="image/*" onchange="previewImage(event)">
    
        <!-- Image Preview -->
        <img id="imagePreview" class="mt-3 w-32 h-32 object-cover rounded hidden">
    
        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 mt-6 rounded hover:bg-blue-600">Submit</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('imagePreview');
            img.src = reader.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
