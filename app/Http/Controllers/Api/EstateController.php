<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Middleware\CheckRole;
use App\Http\Requests\EstateRequest;
use App\Models\Estate;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Validator;



class EstateController extends BaseController
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
     {
         $this->middleware(['auth','checkRole']);
     }




    public function createEstate(Request $request)
    {


      //validation
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
        $user_id= $request->user()->id;
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
      $Estate->user_id = $user_id ;

      $Estate->save();

      // send response
      return $this->sendResponse2($Estate,'the Estate created succeflly');

    }

    public function updateEstate(Request $request ,$id){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'description'=>'required',
            'state'=>'required',
            'price'=>'required',
          ]);
       if($validator->fails())
        {
            return $this->sendError('Please validate error',$validator->errors);
        }
        $estate =Estate::where('id',$id)->first();

         $estate->update([
          'name'=>$request->name,
          'description'=>$request->description,
          'state'=>$request->state,
          'price'=>$request->price,
           ]);


           return $this->sendResponse2($estate,'the Estate created succeflly');

      }
      public function deletEstate($id)
    {
        $estate =Estate::find($id);
        if(!$estate){
            return $this->senderrors('the Estate not found');
        }
        $estate->delete();
        return $this->sendResponse2($estate , 'the Estate deleted succeflly');
    }

    }

