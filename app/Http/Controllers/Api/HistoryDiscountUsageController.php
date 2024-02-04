<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryDiscountUsageResource;
use App\Models\HistoryDiscountUsage;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HistoryDiscountUsageController extends Controller
{

    use ApiResponser;

    public function index(Request $request)
    {
        $histories = HistoryDiscountUsage::all();

        return $this->successResponser( HistoryDiscountUsageResource::collection($histories) ,200);
    }

    public function show(HistoryDiscountUsage $history)
    {
        return $this->successResponser(new HistoryDiscountUsageResource($history) ,200);
    }

}
