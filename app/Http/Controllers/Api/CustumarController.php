<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;

class CustumarController extends BaseController
{
    // REGISTER API
    public function register(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'photo'=>'required|image',
          ]);
          if($validator->fails()){
            return $this->sendError('Please validate error',$validator->errors);
        }
        $photo=$request->photo;
      $newphoto=time().$photo->getClientOriginalName();
      $photo->move(public_path('upload'),$newphoto);
      $path = "public/upload/$newphoto";

        // create data
        $costumar = new User();

        $costumar->name = $request->name;
        $costumar->email = $request->email;
        $costumar->password = Hash::make($request->password);
        $costumar->phone_no = isset($request->phone_no) ? $request->phone_no : "";
        $costumar->photo=$path;
        $costumar->save();

        // send response
        return $this->sendResponse($costumar,'User registered successfully');

    }

    // LOGIN API
    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // check student
        $costumar = User::where("email", "=", $request->email)->first();

        if(isset($costumar->id)){

            if(Hash::check($request->password, $costumar->password)){

                // create a token
                $token = $costumar->createToken("auth_token")->plainTextToken;

                /// send a response
                return $this->sendResponse($token,'User login successfully ');
            }
        }else{
            return $this->sendError('please  check your Auth',['error'=>'Unauthorised']);
        }
    }
    // PROFILE API
    public function profile()
    {
        return $this->sendResponse(auth()->user(),'this is user profile');
    }
  ///////////////auth()->user()
    // LOGOUT API
    public function logout()
 {
    auth()->user()->tokens()->delete();
    return $this->sendError('the user logged out');
 }
}
