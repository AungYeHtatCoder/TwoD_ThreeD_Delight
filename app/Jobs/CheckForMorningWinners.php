<?php

namespace App\Jobs;

use App\Models\Admin\Lottery;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\DB;
class CheckForMorningWinners implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
     //use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $twodWiner;

    public function __construct($twodWiner)
    {
        $this->twodWiner = $twodWiner;
    }

    public function handle()
    {
        // Find all winning entries
        $winningEntries = DB::table('lottery_two_digit_pivot')
            ->where('two_digit_id', $this->twodWiner->prize_no)
            ->where('prize_sent', 0)
            ->get();

        foreach ($winningEntries as $entry) {
            DB::transaction(function () use ($entry) {
                // Retrieve the lottery for this entry
                $lottery = Lottery::findOrFail($entry->lottery_id);

                // Update user's balance
                $user = $lottery->user;
                $user->balance += $entry->sub_amount * 85;  // Update based on your prize calculation
                $user->save();

                // Update prize_sent in pivot
                $lottery->twoDigitsMorning()->updateExistingPivot($entry->two_digit_id, ['prize_sent' => 1]);
            });
        }
        // $winningNumber = $this->twodWiner->prize_no;

        // // Get all lotteries with the winning number
        // $lotteries = Lottery::whereHas('twoDigitsMorning', function ($query) use ($winningNumber) {
        //     $query->where('two_digit', $winningNumber);
        // })->get();

        // foreach ($lotteries as $lottery) {
        //     DB::transaction(function () use ($lottery, $winningNumber) {
        //         // Update user's balance
        //         $user = $lottery->user;
        //         $prizeAmount = $lottery->twoDigitsMorning()->where('two_digit', $winningNumber)->first()->pivot->sub_amount * 85;
        //         $user->balance += $prizeAmount;
        //         $user->save();

        //         // Mark the prize as sent in the pivot table
        //         $lottery->twoDigitsMorning()->updateExistingPivot($winningNumber, ['prize_sent' => 1]);
        //     });
        // }
    }
}