<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/about', function () {
//     return view('about');
// });

Route::get('/about',[AboutController::class,'index']);

Route::get('/user',[UsersController::class,'index']);

Route::get('/profile/{id}',[UsersController::class,'profile']);

Route::get('/users', [UsersController::class, 'all_users']);

///////////////////////////////////////////////////////////////////////////////////
//Route::get('/home',function (){
//    return view('welcome');
//});

//Route::match(['get','post'],'/home',function (){
//    return view('welcome');
//});

//Route::any('/home',function (){
//    return view('welcome');
//});

Route::view('/home','welcome');


Route::get('/products/{id?}',function ($id=null){ // id is optional
    echo $id;
})->where('id','[0-9]+');

Route::prefix('/dashboard')->group(function(){
    Route::get('/',function (){
        echo 'dashboard home';
    });
    Route::get('/orders',function (){
        echo 'dashboard orders';
    });
});

//Route::middleware(['checkuser'])->group(function(){
//    Route::prefix('/profile')->group(function(){
//        Route::get('/',function (){
//            echo 'profile';
//        });
//        Route::get('/settings',function (){
//            echo 'settings';
//        });
//    });
//});

Route::group(['middleware' => ['checkuser'], 'prefix' => 'dashboard'], function () {
    Route::get('/',function (){
        echo 'profile';
    });
    Route::get('/settings',function (){
        echo 'settings';
    });
});

Route::get('/layout',[HomeController::class,'index']);


Route::prefix('/contact')->group(function(){
    Route::get('/',[ContactController::class,'index']);
    Route::get('/data',[ContactController::class,'get_data']);
    Route::post('/submit',[ContactController::class,'submit']) -> name('contact.submit');
});

Route::prefix('/user')->group(function () {
    Route::get('/register',[UsersController::class,'register']);
    Route::post('/register-submit',[UsersController::class,'register_submit'])->name('register.submit');
});
