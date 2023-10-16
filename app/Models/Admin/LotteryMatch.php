<?php

namespace App\Models\Admin;

use App\Models\Admin\Lottery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LotteryMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_name',
        'is_active'
    ];
    public function lotteries()
{
    return $this->hasMany(Lottery::class);
}
}