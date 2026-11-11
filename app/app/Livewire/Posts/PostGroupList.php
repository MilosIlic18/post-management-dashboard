<?php

namespace App\Livewire\Posts;

use App\Services\PostService;
use Livewire\Attributes\On;
use Livewire\Component;

class PostGroupList extends Component
{
    private PostService $postService;
    public $posts = [];

    public function boot(PostService $postService): void {

        $this->postService = $postService;
    }

    public function mount(): void {
    
        $this->loadData();
    }

    public function createPost(): void {
        
        $this->dispatch('create-post');
    }

    #[On('refresh-post-groups')]
    public function refreshGroups(): void{

        $this->loadData();
    }

    public function loadData(): void {

        $this->posts = $this->postService->getPostCountByTitle();
    }

    public function render()
    {
        return view('livewire.posts.post-group-list')->layout('layouts.layout')->layoutData([
            'title'=>'Grouping Posts'
        ]);
    }
}
