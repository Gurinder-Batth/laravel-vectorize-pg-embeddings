<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS vector'); // ✅ Ensure pgvector is enabled

        Schema::table('users', function (Blueprint $table) {
            $table->integer('age');
            $table->string('gender');
            $table->json('interests');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->vector('embedding', 384)->nullable(); 
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
