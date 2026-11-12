<?php

namespace App\Console\Commands;

use App\Models\StatisticsSnapshot;
use App\Services\StatisticsService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:save-statistics-snapshot')]
#[Description('Generates and stores a weekly snapshot of post statistics for the previous seven days.')]
class SaveStatisticsSnapshot extends Command
{
    

    public function handle(StatisticsService $statisticsService)
    {
        
        StatisticsSnapshot::create(['data'=>$statisticsService->getPostsCountForLastSevenDays()]);
        
        return self::SUCCESS;
    }
}
