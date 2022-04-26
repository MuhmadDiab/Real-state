<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustumarController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post("register", [CustumarController::class, "register"]);
Route::post("login", [CustumarController::class, "login"]);
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("profile", [CustumarController::class, "profile"]);
    Route::get("logout", [CustumarController::class, "logout"]);
});
