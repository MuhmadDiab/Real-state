<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EstateController extends BaseController
{

    public function createEstate(Request $request)
    {
      // validation
      $validator = Validator::make($request->all(),[
        'name'=>'required',
        'description'=>'required',
        'roomnumber'=>'required',
        'state'=>'required',
        'price'=>'required',
        'local'=>'required',
        'lan'=>'required',
        'lat'=>'required',
        'photo'=>'required|image',
        'bathroomnumber'=>'required',
        'bedroomnumber'=>'required',
       'propartytype'=>'required',
      ]);
        if($validator->fails()){
        return $this->sendError('Please validate error',$validator->errors);
       }

      $photo=$request->photo;
      $newphoto=time().$photo->getClientOriginalName();
      $photo->move(public_path('upload'),$newphoto);
      $path = "public/upload/$newphoto";

      $Estate = new Estate();
      $Estate->name = $request->name;
      $Estate->description = $request->description;
      $Estate->roomnumber = $request->roomnumber;
      $Estate->state = $request->state;
      $Estate->price = $request->price;
      $Estate->local = $request->local;
      $Estate->lan = $request->lan;
      $Estate->lat = $request->lat;
      $Estate->photo=$path;
      $Estate->bathroomnumber = $request->bathroomnumber;
      $Estate->bedroomnumber = $request->bedroomnumber;
      $Estate->propartytype = $request->propartytype;
      $Estate->save();

      // send response
      return $this->sendResponse2($Estate,'the Estate created succeflly');
    }
}
