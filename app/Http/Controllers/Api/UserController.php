<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $users = User::all();
        return $this->successResponser(UserResource::collection($users) ,200);
    }

    public function profile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'mobile' => 'required|exists:users,mobile',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        $users = User::where('mobile', $request->mobile)->first();
        return $this->successResponser(new UserResource($users) ,200);
    }
    
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(),[
            'mobile' => 'required|string|max:15',
            'password' => 'required|max:50',
            'email' => 'email|max:50',
            'firstname' => 'string|max:50',
            'lastname' => 'string|max:50',
            'username' => 'string|max:50',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }
        else if(User::where('mobile', $request->mobile)->exists()){
            return $this->errorResponser(400, 'This mobile number is registed before.');
        }

        DB::beginTransaction();

        $user = User::create([
            'mobile' => $request->mobile,
            'password' => $request->password,
            'email' => $request->email,
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'username' => $request->userName
        ]);
        
        $user->wallet()->create([
            'blance' => 0,
            'active' => true,
        ]);

        DB::commit();

        return $this->successResponser(new UserResource($user) ,201);
    }
    
    public function show(User $user)
    {
        return $this->successResponser(new UserResource($user) ,200);
    }
}
