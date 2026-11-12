<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['data'])]
class StatisticsSnapshot extends Model
{
    public const TABLE = "statistics_snapshots";
}
