<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustumarController;
use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\UserestateController;

Route::post("/register", [CustumarController::class, "register"]);
Route::post("/login", [CustumarController::class, "login"]);

Route::group(["middleware" => ["auth:sanctum"]], function(){
Route::get("/profile", [CustumarController::class, "profile"]);
Route::post("/creatEstate", [EstateController::class, "createEstate"]);
Route::delete("/deletEstate/{id}", [EstateController::class, "deleteEstate"]);
Route::get("/showEstate", [UserestateController::class, "listallEstate"]);
Route::post("/updatEstate/{id}", [EstateController::class, "updateEstate"]);
Route::get("/logout", [CustumarController::class, "logout"]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});
