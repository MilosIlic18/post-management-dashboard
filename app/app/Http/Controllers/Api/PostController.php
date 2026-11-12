<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\FilterPostRequest;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Services\PostService;
use App\Services\StatisticsService;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected StatisticsService $statisticsService
    ) {}

    public function index(FilterPostRequest $filterPostRequest){

        $filter = $filterPostRequest->validated();

        return $this->postService->getFilteredPosts(status:$filter['status'],
        sort:  $filter['sort'],
        limit: $filter['limit']
        );
    }

    public function  edit(UpdatePostRequest $updatePostRequest){

        $id = $updatePostRequest->validated()['id'];
        
        return $this->postService->updateStatus(postId: $id);
    }

    public function store(StorePostRequest $storePostRequest){

        return collect($storePostRequest->validated())
            ->map(fn($post) => $this->postService->createPost(post:$post));
    }

    public function statusCounts(){

        return $this->postService->getStatusCounts();
    }

    public function statistics(){

        return $this->statisticsService->getStatisticsSnapshots();
    }
}
