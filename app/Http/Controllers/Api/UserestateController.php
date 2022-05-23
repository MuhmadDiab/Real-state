<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\Estate ;

class UserestateController extends BaseController
{
    public function listallEstate(){
        $estate = Estate::get()->all();
        if(!$estate)
        {
            return $this->senderrors('the Estates are not found');
        }
        return $this->sendResponse2($estate,'the Estate created succeflly');
     } //
}
