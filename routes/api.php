<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustumarController;
use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\Operationusercontroller;
use App\Http\Controllers\Api\Commentcontroller;


Route::post("/register", [CustumarController::class, "register"]);
Route::post("/login", [CustumarController::class, "login"]);

Route::group(["middleware" => ["auth:sanctum"]], function(){
Route::get("/profile", [CustumarController::class, "profile"]);
Route::post("/creatEstate", [EstateController::class, "createEstate"]);
Route::post("/updateEstate/{id}", [EstateController::class, "updateEstate"]);
Route::delete("/deleteEstate/{id}", [EstateController::class, "deletEstate"]);
Route::get("/listEstates",[Operationusercontroller::class,"listallEstate"]);
Route::post("/likeEstates/{id}",[Operationusercontroller::class,"like"]);
Route::post("/createcomment/{id}",[Commentcontroller::class,"createcomment"]);
Route::get("/getcomment/{id}",[Commentcontroller::class,"getcomments"]);
Route::get("/viewestate/{id}",[Commentcontroller::class,"view"]);
Route::get("searchestatename/{name}", [Commentcontroller::class, "searchname"]);
Route::get("searchestatetype/{type}", [Commentcontroller::class, "searchtype"]);
Route::get("searchestatestate/{state}", [Commentcontroller::class, "searchstate"]);

Route::get("/logout", [CustumarController::class, "logout"]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});
