<?php

namespace App\Services;

use App\Models\Post;
use App\Models\StatisticsSnapshot;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsService {

    public function getPostsCountForLastSevenDays(){
        $posts = Post::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', Carbon::today()->subDays(6))
        ->where('created_at', '<', Carbon::tomorrow())
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get()
        ->keyBy('date');

        return collect(range(6, 0))->map(function ($daysAgo) use ($posts) {
            $date = Carbon::today()->subDays($daysAgo)->toDateString();

            return (object) [
                'date' => $date,
                'total' => (int) ($posts->get($date)?->total ?? 0),
            ];
        });
    }

    public function getStatisticsSnapshots(){

        return StatisticsSnapshot::all();
    }
}