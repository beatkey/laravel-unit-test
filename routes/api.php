<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix' => 'users'], function (){
   Route::get("/", [UsersController::class, 'index'])->name("users");
   Route::get("/{user}", [UsersController::class, 'get'])->name("users.get");
   Route::post("/", [UsersController::class, 'create'])->name("users.create");
   Route::put("/{user}", [UsersController::class, 'update'])->name("users.update");
   Route::delete("/{user}", [UsersController::class, 'delete'])->name("users.delete");
});
