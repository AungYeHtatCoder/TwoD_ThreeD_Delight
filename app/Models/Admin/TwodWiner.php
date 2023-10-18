<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Jobs\CheckForMorningWinners;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwodWiner extends Model
{
    use HasFactory;
    protected $fillable = [
        'prize_no',
        'session',
    ];
     public function users()
    {
        return $this->belongsToMany(User::class);
    }
    // Inside your TwodWiner model
protected static function booted()
{
    static::created(function ($twodWiner) {
        // Dispatch a job or directly call the logic to check for winners
        CheckForMorningWinners::dispatch($twodWiner);
    });
}

}