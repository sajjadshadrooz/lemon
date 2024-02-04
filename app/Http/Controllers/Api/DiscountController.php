<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Jobs\applyDiscount;
use App\Models\Discount;
use App\Models\HistoryDiscountUsage;
use App\Models\Metadatas;
use App\Models\SubMetadatas;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Helpers\DiscountFunctions;

class DiscountController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $discounts = Discount::all();
        return $this->successResponser( DiscountResource::collection($discounts) ,200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required|unique:discounts,code|string|max:50',
            'amount' => 'required|integer',
            'start_at' => 'date_format:Y-m-d H:i:s',
            'expire_at' => 'date_format:Y-m-d H:i:s',
            'max_usage' => 'integer|min:1',
            'max_capacity' => 'integer|min:1',
            'type' => 'required|integer'
        ]);

        if($validation->fails())
        {
            return $this->errorResponser(400, $validation->messages());
        }

        $discount = Discount::create([
            'code' => $request->code,
            'amount' => $request->amount,
            'start_at' => $request->start_at == true?
                    Carbon::parse($request->start_at)
                    :null,
            'expire_at' => $request->expire_at == true?
                    Carbon::parse($request->expire_at)
                    :null,
            'max_usage' => $request->max_usage?$request->max_usage:1,
            'max_capacity' => $request->max_capacity,
            'type' => $request->type
        ]);

        $discount->save();
        
        return $this->successResponser( new DiscountResource($discount) ,201);
    }

    public function show(Discount $discount)
    {
        return $this->successResponser( new DiscountResource($discount) ,200);
    }

    public function update(Request $request, Discount $discount)
    {
        $validation = Validator::make($request->all(), [
            'code' => 'required|exists:discounts,code|string|max:50',
            'amount' => 'required|integer',
            'start_at' => 'date_format:Y-m-d H:i:s',
            'expire_at' => 'date_format:Y-m-d H:i:s',
            'max_usage' => 'integer|min:1',
            'max_capacity' => 'integer|min:1',
            'type' => [
                'required|integer',
                Rule::in(Metadatas::where('code','discount_type')->subMetadatas()),
            ],
        ]);

        if($validation->fails())
        {
            return $this->errorResponser(400, $validation->messages());
        }

        $discount->code = $request->code;
        $discount->amount = $request->amount;
        $discount->start_at = $request->start_at;
        $discount->expire_at = $request->expire_at;
        $discount->max_usage = $request->max_usage;
        $discount->max_capacity = $request->max_capacity;
        $discount->type = $request->type;

        $discount->save();

        return $this->successResponser( new DiscountResource($discount) ,200);
    }

    public function destroy(Discount $discount)
    {
        if($discount->historyDiscountUsage()->exists())
        {
            return $this->errorResponser(400, 'Discount with usage history can not deleted.');
        }

        $discount->delete();

        return $this->successWithoutDataResponser(200);
    }

    public function apply(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'mobile' => 'required|string|exists:users,mobile',
            'code' => 'required|string|exists:discounts,code'
        ]);

        if($validation->fails())
        {
            return $this->errorResponser(400, $validation->messages());
        }

        $user = User::where('mobile', $request->mobile)->first();
        $discount = Discount::where('code', $request->code)->first();

        dispatch(new applyDiscount($user, $discount));
        
        return $this->successWithoutDataResponser(202, 'The request is accepted, the result can be seen through profile.');
    }
}
