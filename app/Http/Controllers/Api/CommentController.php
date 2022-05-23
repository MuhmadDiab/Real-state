<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Estate;
use App\Models\Comment;
use App\Models\View;


use Illuminate\Http\Request;

class Commentcontroller extends BaseController
{
    public function createcomment(Request $request,$estate_id)
    {

        $validator=Validator::make($request->all(),
        [
        'comment'=>'required',
        ]);
        if($validator->fails())
        {
        return $this->sendError('Please validate error',$validator->errors);
        }
        $estate=Estate::where('id',$estate_id)->first();

        if(!$estate)
        {
            return $this->senderrors('the estate is not found');
        }

        $comment=Comment::create([
        'comment'=>$request->comment,
        'user_id'=>$request->user()->id,
        'estate_id'=>$estate_id]);

        return $this->sendResponse2($comment,'comment sccessfully created');
    }

    public function getcomments(Request $request,$estate_id)
   {
       $estate=Estate::where('id',$estate_id)->first();

       if(!$estate)
      {
        return $this->senderrors('the estate is not found');
      }
      $comment= Comment::where('estate_id',$estate_id)->get();

      return $this->sendResponse2($comment,'this is all estate');
   }

   public function view(Request $request,$estate_id)
    {

      $estate =Estate::find($estate_id);

      if(!$estate)
      {
        return $this->senderrors('the estate is not found');
      }
     $view=View::where('estate_id',$estate_id)->where('user_id',$request->user()->id)->first();
     if(!$view)
     {
       View::create([
         'estate_id'=>$estate_id,
         'user_id'=>$request->user()->id
      ]);
     }
     $estate =Estate::where('id',$estate_id)->withCount('comment','view','like')->with('comment')->first();

      return $this->sendResponse2($estate,'successfully');
    }
}
