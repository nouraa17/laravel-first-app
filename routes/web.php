<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductControllerResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
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


//Route::get('/products/{id?}',function ($id=null){ // id is optional
//    echo $id;
//})->where('id','[0-9]+');

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

Route::group(['prefix'=>'/auth'],function () {

    Route::get('/register',[RegisterController::class,'index'])->name('register');
    Route::post('/register-post',[RegisterController::class,'save'])->name('auth.register');

    Route::get('/login',[LoginController::class,'index'])->name('login');
    Route::post('/login-post',[LoginController::class,'save'])->name('auth.login');

});
Route::get('/logout',[LogoutController::class,'logout_system'])->middleware('auth');

Route::group(['prefix'=>'/dashboard', 'middleware' => 'admin'],function () {
    Route::get('/users',[DashboardController::class,'users'])->name('dashboard.users');
    Route::get('/contacts',[DashboardController::class,'contacts'])->name('dashboard.contacts');
    Route::get('/edit-user/{id}',[DashboardController::class,'edit_user'])->name('dashboard.edit.user');
    Route::put('/update-user/{id}',[DashboardController::class,'update_user'])->name('dashboard.update.user');
    // web.php
//    Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.edit.user');


});

Route::get('/delete', [DeleteController::class, 'delete'])->name('delete');

Route::resources([
    'products' => ProductControllerResource::class
]);
