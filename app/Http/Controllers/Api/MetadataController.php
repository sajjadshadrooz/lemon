<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetadatasResource;
use App\Models\Metadatas;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetadataController extends Controller
{
    use ApiResponser;
    public function index()
    {
        $metadatas = Metadatas::all();
        return $this->successResponser(MetadatasResource::collection($metadatas), 200);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'code' => 'required|string|max:50',
            'title' => 'required|string|max:50',
            'comment' => 'string|max:100',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        $metadata = Metadatas::create([
            'code' => $request->code,
            'title' => $request->title,
            'commet' => $request->commet,
        ]);

        $metadata->save();

        return $this->successResponser(new MetadatasResource($metadata) ,201);
    }

    public function show(Metadatas $metadata)
    {
        return $this->successResponser(new MetadatasResource($metadata) ,200);
    }

    public function update(Request $request, Metadatas $metadata)
    {
        $validation = Validator::make($request->all(),[
            'code' => 'required|string|max:50',
            'title' => 'required|string|max:50',
            'comment' => 'string|max:100',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        $metadata->code = $request->code;
        $metadata->title = $request->title;
        $metadata->commet = $request->commet;

        $metadata->save();

        return $this->successResponser(new MetadatasResource($metadata) ,200);
    }

}
