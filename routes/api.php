<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('tt', function () {
//     $users = User::find(1);
//     if ($users) {
//         $users->temp_phone_otp++;
//     } else {
//         $users->temp_phone_otp = 1;
//     }
//     $users->save();
//     return $users->temp_phone_otp;
// });
