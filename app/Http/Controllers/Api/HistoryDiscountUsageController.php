<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryDiscountUsageResource;
use App\Models\HistoryDiscountUsage;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HistoryDiscountUsageController extends Controller
{

    use ApiResponser;

    public function index(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'status' => 'in:true,false',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        if($request->status != null){
            $status = filter_var($request->status, FILTER_VALIDATE_BOOLEAN);
            $histories = HistoryDiscountUsage::where('status', $status)->get();
        }
        else{
            $histories = HistoryDiscountUsage::all();
        }

        return $this->successResponser( HistoryDiscountUsageResource::collection($histories) ,200);
    }

    public function show(HistoryDiscountUsage $historyDiscountUsage)
    {
        return $this->successResponser(new HistoryDiscountUsageResource($historyDiscountUsage) ,200);
    }

}
