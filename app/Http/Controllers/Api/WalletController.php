<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use Illuminate\Http\Request;

use App\Models\Wallet;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class WalletController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $wallets = Wallet::all();
        return $this->successResponser(WalletResource::collection($wallets), 200);
    }

    public function show(Wallet $wallet)
    {
        return $this->successResponser(new WalletResource($wallet) ,200);
    }

    public function update(Request $request, Wallet $wallet)
    {

        $validation = Validator::make($request->all(),[
            'active' => 'required|boolean'
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        if($wallet->active == $request->active)
        {
            return $this->successResponser(new WalletResource($wallet), 200, 'Activation status not changed.');
        }

        $wallet->active = $request->active;
        $wallet->active_updated_at = Carbon::now();
        $wallet->save();

        return $this->successResponser(new WalletResource($wallet), 200);
    }

}
