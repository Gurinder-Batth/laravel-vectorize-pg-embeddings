<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="p-6 rounded-xl shadow-lg  bg-white">

        <div class="flex items-center justify-between p-4 ">
            {{-- left --}}
            <div>
                @include('logo')
            </div>
        
            {{-- right --}}
            <h1 class="text-xl font-semibold text-gray-800">Discover Your Perfect Date Match ❤️</h1>
        </div>
        

        <!-- Display errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
