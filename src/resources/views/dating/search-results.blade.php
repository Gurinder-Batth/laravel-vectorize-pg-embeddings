@extends('layouts.app')

@section('content')
<div class=" mx-auto py-8">
    <div class="flex gap-6">
        
        {{-- Left Side - Static Search Form --}}
        <div class="w-1/3 bg-white p-6 rounded-lg shadow-md border border-pink-300 h-fit">
            @include('dating.search-form')
        </div>

        {{-- Right Side - Scrollable Results --}}
        <div class="w-2/3 h-[600px] overflow-y-auto bg-pink-50 p-6 rounded-lg shadow-md border border-pink-300">
            <h2 class="text-2xl font-semibold text-pink-600 mb-6 text-center">Search Results</h2>

            @if($results->isEmpty())
                <p class="text-center text-gray-500">No profiles found. Try adjusting your search criteria!</p>
            @else
                <div class="grid gap-6">
                    @foreach($results as $user)
                        <div class="bg-white p-6 rounded-lg shadow-md border border-pink-300">
                            <div class="flex items-center space-x-4 mb-4">
                                <img src="{{ $user->photo ?? 'https://via.placeholder.com/100?text=Profile' }}" 
                                     alt="Profile" 
                                     class="w-20 h-20 rounded-full border border-pink-400">
                                <div>
                                    <h3 class="text-xl font-bold text-pink-700">{{ $user->name }}</h3>
                                    <p class="text-gray-600">{{ ucfirst($user->gender) }} | Age: {{ $user->age }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700"><b>Distance Match:</b> {{ $user->similarity }}</p>
                            <p class="text-gray-700"><b>Bio:</b> {{ $user->bio }}</p>
                            <p class="text-gray-700"><b>Interests:</b> {{ implode(', ', $user->interests ?? []) }}</p>

                            <button class="mt-4 w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg shadow">
                                View Profile
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
