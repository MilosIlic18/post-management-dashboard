<?php

namespace App\Livewire\Posts;

use App\Services\PostService;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Url;
use Livewire\Component;

class PostList extends Component
{
    private PostService $postService;
    public $posts = [];
    public array $statusesCount = [];

    #[Url(except:'')]
    public string $status = '';

    #[Url(except:'asc')]
    public string $sort = 'asc';

    #[Url(except:10)]
    public int $limit = 10;

    protected function rules(): array
    {
        return [
            'status' => ['nullable', 'in:complete,pending'],
            'sort'   => ['required', 'in:asc,desc'],
            'limit'  => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function boot(PostService $postService): void {

        $this->postService = $postService;
    }

    public function mount(): void {

        $this->loadData();
    }

    public function filter(string $status): void {
       
        $this->status = $status;

        $this->loadData();
    }

    private function loadData(): void {
        $statusCounts = $this->postService->getStatusCounts();
        
        $this->statusesCount = [
            'total'     => $statusCounts->sum('statusCount'),
            'pending'   => $statusCounts->firstWhere('status', 'pending')?->statusCount ?? 0,
            'completed' => $statusCounts->firstWhere('status', 'complete')?->statusCount ?? 0
        ];

        $this->sort   = $this->sort   ?: 'asc';
        $this->status = $this->status ?: '';
        $this->limit  = $this->limit  ?: 10;
        
        try{
            $validated = $this->validate();
        }catch(ValidationException $e){
          
            $this->reset(['status', 'sort', 'limit']);

            $this->status = '';
            $this->sort   = 'asc';
            $this->limit  = 10;

            $validated = [
                'status' => $this->status,
                'sort'   => $this->sort,
                'limit'  => $this->limit,
            ];

        }
        $this->posts = $this->postService->getFilteredPosts(
                status  : $validated['status'] ?? '',
                sort    : $validated['sort'],
                limit   : $validated['limit']
            );
    }

    public function update(int $postId): void {

        $this->postService->updateStatus(postId: $postId);
        
        $this->status = '';

        $this->loadData();
    }

    public function render()
    {
        return view('livewire.posts.post-list')->layout('layouts.layout')->layoutData(
            ['title'=>'Posts']
        );
    }
}
