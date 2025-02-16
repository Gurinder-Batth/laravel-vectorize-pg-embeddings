<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'age', 'gender', 'interests', 'bio', 'photo'];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'interests' => 'array',
        ];
    }

    public function generateEmbedding() {
        $text = 'bio => ' . $this->bio . ' interest => ' . implode(' ', $this->interests) . ' gender => ' . $this->gender .  ' age =>' . $this->age;
        $url = "http://vl_embedding:5001/generate_embedding/";

        $response = Http::post($url, ['text' => $text]);

        if ($response->successful()) {
            $this->embedding = $response->json()['embedding'];
            $this->save();
        } else {
            throw new \Exception("Embedding service error: " . $response->body());
        }
    }

}
