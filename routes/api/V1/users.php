<?php

//Route::apiResource('users',UserController::class);

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::group([
//    'middleware' => [
//        'auth',
//    ],
//    'prefix' => 'heyaa',
//    'as' => 'users.',
////    'namespace' => '\App\Http\Controllers'
//], function () {
//    Route::get('/users', [UserController::class, 'index'])->name('index');
//    Route::get('/users/{user}', [UserController::class, 'show'])->name('show');
//    Route::post('/users', [UserController::class, 'store'])->name('store');
//    Route::patch('/users/{user}', [UserController::class, 'update'])->name('update');
//    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('destroy');
//});

Route::middleware([
//    'auth:api',
//    \App\Http\Middleware\RedirectIfAuthenticated::class
])
//    ->prefix('heyaa')// 這邊代表會從路徑 api/users => api/heyaa/users
    ->name('users.') // 可以設定共同的 name 叫做 users.XXX  或者可以用  ->as() 這個方法和 ->name 差不多
//    ->namespace('\App\Http\Controllers')
//    如果要這樣寫的話，下面就必須使用 Route::get('/users', 'UserController@index)->name('index'); 的方式
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth');// 唯一這個去掉 middleware auth 的查看
        Route::get('/users/{user}', [UserController::class, 'show'])
            ->name('show')
//            ->where('user','[0-9]+');// 這邊可以限制參數 {user} 是數字
            ->whereNumber('user');// 這邊可以限制參數 {user} 是數字
        Route::post('/users', [UserController::class, 'store'])->name('store');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

// =>  Route::middleware('auth')->get('/users', [UserController::class, 'index']);
// 但是這樣會導致每一個 class 都需要放 ::middleware('auth')，因此可以建立一個 group()

