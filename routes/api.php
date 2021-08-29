<?php

use App\Http\Controllers\UserController;
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

Route::prefix('V1')->group(
    function (){
        \App\Helpers\Routes\RouteHelper::includeRouteFiles(__DIR__ . '/api/V1');

//        require __DIR__ . '/api/V1/users.php';
//        require __DIR__ . '/api/V1/posts.php';
//        require __DIR__ . '/api/V1/comments.php';
    }
);


