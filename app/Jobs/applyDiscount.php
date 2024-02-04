<?php

namespace App\Jobs;

use App\Models\HistoryDiscountUsage;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Helpers\DiscountFunctions;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Log;

class applyDiscount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $discount;

    public function __construct($user, $discount)
    {
        $this->user = $user;
        $this->discount = $discount;
    }

    public function handle(): void
    {
        try
        {
            DB::beginTransaction();

            $action_at = Carbon::now();
            $wallet = $this->user->wallet;

            $max_usage = $this->discount->max_usage;
            $count_usage = count(HistoryDiscountUsage::where('wallet', "=" ,$wallet->id)->where('discount',"=", $this->discount->id)->where('status',"=", true)->get());

            $max_capacity = $this->discount->max_capacity;
            $count_capacity = count(HistoryDiscountUsage::where('discount', $this->discount->id)->where('status', true)->get());

            if(!DiscountFunctions::timeLimitationChecker($this->discount->start_at, $this->discount->expire_at, $action_at))
            {
                HistoryDiscountUsage::create([
                    'wallet' => $wallet->id,
                    'discount' => $this->discount->id,
                    'status' => false,
                    'created_at' => $action_at
                ]);
                DB::commit();
                return;
            }
            else if($max_usage != null && $max_usage <= $count_usage)
            {
                HistoryDiscountUsage::create([
                    'wallet' => $wallet->id,
                    'discount' => $this->discount->id,
                    'status' => false,
                    'created_at' => $action_at
                ]);
                DB::commit();
                return;
            }
            else if($max_capacity != null && $max_capacity <= $count_capacity)
            {
                HistoryDiscountUsage::create([
                    'wallet' => $wallet->id,
                    'discount' => $this->discount->id,
                    'status' => false,
                    'created_at' => $action_at
                ]);
                DB::commit();
                return;
            }

            if($this->discount->type == 1)
            {
                $wallet->balance = $wallet->balance + $this->discount->amount;
                $wallet->save();

                HistoryDiscountUsage::create([
                    'wallet' => $wallet->id,
                    'discount' => $this->discount->id,
                    'status' => true,
                    'created_at' => $action_at
                ]);

                Transaction::create([
                    'wallet' => $wallet->id,
                    'type' => 1,
                    'amount' => $this->discount->amount,
                    'balance' => $wallet->balance,
                    'from' => 'system',
                    'to' => $wallet->id,
                    'created_at' => $action_at
                ]);

            }
            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollback();
        }
    }
}
