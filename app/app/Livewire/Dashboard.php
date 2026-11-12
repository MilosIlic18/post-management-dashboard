<?php

namespace App\Livewire;

use App\Services\PostService;
use App\Services\StatisticsService;
use Livewire\Component;

class Dashboard extends Component
{
    private PostService $postService;
    private StatisticsService $statisticsService;
    public $data = [];
    public $dataForLastSevenDay = [];
    public $labelForLastSevenDay = [];

    public function boot(StatisticsService $statisticsService, PostService $postService,): void {

        $this->postService       = $postService;
        $this->statisticsService = $statisticsService;
    }

     public function mount(): void {

        $statusCounts = $this->postService->getStatusCounts();

        $this->data['labels'] = ['Završeno', 'Na čekanju'];
        
        $this->data['status_complete_count'] = $statusCounts->firstWhere('status', 'complete')?->statusCount ?? 0;
        $this->data['status_pending_count'] = $statusCounts->firstWhere('status', 'pending')?->statusCount ?? 0;
        
        $this->dataForLastSevenDay  = $this->statisticsService->getPostsCountForLastSevenDays()->map(fn ($item)=>$item->total);
        $this->labelForLastSevenDay = $this->statisticsService->getPostsCountForLastSevenDays()->map(fn ($item)=>\Carbon\Carbon::parse($item->date)->locale('sr')->translatedFormat('D, d.'));
        
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.layout')->layoutData([
            'title'=>'Dashboard'
        ]);
    }
}

      