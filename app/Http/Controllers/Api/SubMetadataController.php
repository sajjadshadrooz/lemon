<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubMetadatasResource;
use App\Models\Metadatas;
use Illuminate\Support\Facades\Validator;
use App\Models\SubMetadatas;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SubMetadataController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $submetadatas = SubMetadatas::all();
        return $this->successResponser(SubMetadatasResource::collection($submetadatas),200);
    }

    public function store(Request $request)
    {
        
        $validation = Validator::make($request->all(), [
            'code' => 'required|string|max:50',
            'title' => 'required|string|max:50',
            'metadata' => 'required|integer',
            'comment' => 'string|max:100',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }
        
        $metadata = Metadatas::find($request->metadata);
        if(!$metadata){
            return $this->errorResponser(400, 'The metadata of this submetadata not found.');
        }

        $subMetadata = $metadata->subMetadatas()->create([
            'code' => $request->code,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        return $this->successResponser(new SubMetadatasResource($subMetadata) ,201);
    }

    public function show(SubMetadatas $subMetadata)
    {
        return $this->successResponser(new SubMetadatasResource($subMetadata) ,200);
    }

    public function update(Request $request, SubMetadatas $subMetadata)
    {
        $validation = Validator::make($request->all(),[
            'code' => 'required|string|max:50',
            'title' => 'required|string|max:50',
            'comment' => 'string|max:100',
        ]);

        if($validation->fails()){
            return $this->errorResponser(400, $validation->messages());
        }

        $subMetadata->code = $request->code;
        $subMetadata->title = $request->title;
        $subMetadata->commet = $request->commet;

        $subMetadata->save();

        return $this->successResponser(new SubMetadatasResource($subMetadata) ,200);
    }

}
