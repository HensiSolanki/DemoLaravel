<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1\Admin'], function ($api) {

    $api->post('auth/signUp', 'Auth\SignUpController@signUp');
     $api->post('auth/login', 'Auth\SignUpController@login');
     $api->get('open', 'Auth\DemoController@open');

     Route::group(['middleware' => 'jwt.verify','namespace' => 'App\Http\Controllers\Api\v1\Admin'], function() {
         Route::get('user', 'Auth\SignUpController@getAuthenticatedUser');
         Route::get('closed', 'Auth\DemoController@closed');
     });
     // Route::group(['middleware' => 'jwt.auth'], function () {
         //     Route::get('user', 'Auth\LoginController@getAuthUser');
         // });
        });
