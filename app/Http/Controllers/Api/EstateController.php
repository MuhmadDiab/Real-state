<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Estate;
use Illuminate\Http\Request;
use App\Models\View;
use Illuminate\Support\Facades\Validator;
use App\Models\Costumar;
use App\Models\Like;

use App\Models\Category;
use Carbon\Carbon;
use date;
use Illuminate\Auth\Events\Validated;
use PhpParser\Node\Stmt\Catch_;

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
        'photo'=>'required|image',
        'bathroomnumber'=>'required',
        'bedroomnumber'=>'required',
        'propertytype'=>'required',
      ]);
        if($validator->fails()){
        return $this->sendError('Please validate error',$validator->errors);
       }

      $photo=$request->photo;
      $newphoto=time().$photo->getClientOriginalName();
      $photo->move(public_path('upload'),$newphoto);
      $path = "public/upload/$newphoto";
      //$costumar_id = auth()->user()->id;

      $Product = new Estate();
      //$Product->costumar_id = $costumar_id;
      $Product->name = $request->name;
      $Product->description = $request->description;
      $Product->roomnumber = $request->roomnumber;
      $Product->state = $request->state;
      $Product->price = $request->price;
      $Product->local = $request->local;
      $Product->photo=$path;
      $Product->bathroomnumber = $request->bathroomnumber;
      $Product->bedroomnumber = $request->bedroomnumber;
      $Product->propertytype = $request->propertytype;
      //$Product->category_id = $category_id;
      $Product->save();

      // send response
      return $this->sendResponse2($Product,'the product created succeflly');
    }
}
