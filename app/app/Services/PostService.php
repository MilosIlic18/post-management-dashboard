<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService {

    public function getStatusCounts(){
        
        return Post::select('status', DB::raw('COUNT(status) AS statusCount'))->
            groupBy('status')->get();
    }

    public function getFilteredPosts(?string $status,string $sort,int $limit){

        return Post::when($status, fn ($query) =>
            $query->where('status', $status)
            )
            ->orderBy('id',$sort)
            ->orderBy('created_at',$sort)
            ->limit($limit)
            ->get();
    }

    public function getPostCountByTitle(){

        return Post::select('title',DB::raw('COUNT(*) AS duplicate_count'))
                    ->groupBy('title')
                    ->get();
    }

    public function updateStatus(int $postId){
        
        $post = Post::findOrFail($postId);
        $post->status="complete";
        $post->save();
        return $post;
    }

    public function createPost(array $post){
        
        return Post::create($post);
    }
}