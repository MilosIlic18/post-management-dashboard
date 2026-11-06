<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create(Post::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('status', 40)->default('pending');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists(Post::TABLE);
    }
};
