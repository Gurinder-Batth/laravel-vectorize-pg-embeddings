<?php

namespace Database\Seeders;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

return new class extends Migration
{
    public function up(): void
    {
        $faker = Faker::create();

        $interestsList = [
            'Reading', 'Traveling', 'Cooking', 'Gaming', 'Fitness', 'Photography',
            'Music', 'Dancing', 'Hiking', 'Cycling', 'Movies', 'Art', 'Technology',
            'Writing', 'Sports', 'Yoga', 'Fishing', 'Crafting', 'Meditation'
        ];

        $bios = [
            'I love exploring new places, meeting new people, and trying out different cuisines. Traveling has always been my passion.',
            'A passionate cook who enjoys experimenting with new recipes. I also love hosting friends and exploring new restaurants.',
            'Tech-savvy and always curious about innovations. When not coding, I enjoy gaming, sci-fi movies, and deep conversations.',
            'Fitness is my therapy! Whether it’s hitting the gym, running, or yoga, I believe in staying active for both body and mind.',
            'I have a deep love for literature and enjoy writing in my free time. Poetry, short stories, or just journaling keeps me inspired.',
            'Music is my escape. Whether it’s playing the guitar, attending concerts, or curating playlists, music brings me joy.',
            'Hiking, camping, and exploring nature is what I live for! The outdoors give me peace, and I enjoy weekend getaways in the wild.',
            'A movie enthusiast who loves classic films and thrillers. I enjoy analyzing cinematography and discovering new coffee shops.',
            'Photography is my passion. Capturing landscapes, portraits, and candid shots gives me joy. I love storytelling through my lens.',
            'I practice yoga and meditation to maintain balance in life. I believe in mindfulness and love deep conversations over coffee.',
            'I am a sports fanatic! Whether playing or watching, football and basketball are my favorite pastimes. Love the adrenaline rush!',
            'A bookworm at heart, I enjoy diving into fantasy and mystery novels. I also dabble in writing and love attending book clubs.',
            'Coding by day, gaming by night! I am a software developer who enjoys open-world games, indie music, and tech gadgets.',
            'Animals are my best friends! I volunteer at animal shelters and love spending time with my dog at the beach or on a hike.',
            'I am an adrenaline junkie! Skydiving, bungee jumping, and water sports are my kind of adventure. Always looking for the next thrill.',
            'Baking is my happy place! Experimenting with new dessert recipes and sharing them with friends and family brings me joy.',
            'Fashion and style are my creative outlets. I enjoy designing outfits, exploring trends, and expressing myself through fashion.',
            'I am a history buff who loves exploring museums, historical sites, and ancient cultures. Learning about the past fascinates me.',
            'I believe in sustainability and enjoy gardening, composting, and finding ways to live an eco-friendly lifestyle.',
            'Board games, trivia nights, and escape rooms are my kind of fun! I enjoy a good challenge and love strategic thinking.'
        ];
        

        foreach (range(1, count($bios)) as $index) {
            $gender = $faker->randomElement(['male', 'female']);
            DB::table('users')->insert([
                'name' => $faker->name($gender),
                'age' => $faker->numberBetween(18, 60),
                'gender' => $gender,
                'interests' => json_encode($faker->randomElements($interestsList, rand(3, 5))),
                'bio' => $bios[$index - 1],
                'photo' => 'https://avatar.iran.liara.run/public/' . ($gender == "male" ? rand(2, 40) : rand(60, 80)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
