<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function create()
    {
        return view('dating-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'gender' => 'required|string',
            'interests' => 'required|array',
            'bio' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('profile_pictures', 'public');
        }

        User::create($validated);

        return redirect()->route('dating.form')->with('success', 'Profile created successfully!');
    }
    
    public function search(Request $request) {
        $queryText = $request->input('query');
    
        if (!$queryText) {
            return view('dating.search-results', ['results' => User::query()->take(0)->get()]);
        }
    
        // Generate embedding for search query
        $embeddingResponse = Http::post("http://vl_embedding:5001/generate_embedding/", ['text' => $queryText]);
    
        if (!$embeddingResponse->successful()) {
            return redirect()->back()->with('error', 'Failed to generate embedding.');
        }
    
        $queryEmbedding = $embeddingResponse->json()['embedding'];
    
        // Convert embedding to SQL format (PostgreSQL `vector` expects array syntax)
        $queryEmbeddingStr = '[' . implode(',', $queryEmbedding) . ']';
    
        // Perform cosine similarity search in DB
        $users = User::whereNotNull('embedding');

        if (!empty($request->gender)) {
            $users->whereGender($request->gender);
        }

        $users = $users->selectRaw("*, (embedding <=> '$queryEmbeddingStr') AS similarity")
            ->whereRaw("(embedding <=> '$queryEmbeddingStr') <= 0.7") // Adjust threshold (lower = more similar)
            ->orderBy('similarity', 'ASC') // Lower distance = more similar
            ->take(4)->get();
    
        return view('dating.search-results', ['results' => $users]);
    }
    

    // Function to compute cosine similarity
    private function cosineSimilarity(array $vectorA, array $vectorB) {
        $dotProduct = array_sum(array_map(fn($a, $b) => $a * $b, $vectorA, $vectorB));
        $magnitudeA = sqrt(array_sum(array_map(fn($a) => $a ** 2, $vectorA)));
        $magnitudeB = sqrt(array_sum(array_map(fn($b) => $b ** 2, $vectorB)));

        return $magnitudeA * $magnitudeB == 0 ? 0 : $dotProduct / ($magnitudeA * $magnitudeB);
    }


}
