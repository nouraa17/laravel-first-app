<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Services\Users\SaveUserInfoService;
use App\traits\upload_image;
use App\Actions\ImageModelSave;
class RegisterController extends Controller
{
    use upload_image;
    public function index()
    {
//        return auth()->check(); return 1 or nothing
//        auth()->user();
//        auth()->id();
        return view('auth.register');

    }
    public function save(RegisterFormRequest $request)
    {

        $userData=$request->validated();
        $userData['type'] = 'client';
        $file = request()->file('image');
        if ($file == null){
            $image_name = 'default.png';
        }else{
            $image_name= $this->uploadImage($file,'users');
        }

        $user = SaveUserInfoService::save($userData);
//        return $userData;
        ImageModelSave::make($user->id,'User',$image_name);
        return redirect()->back()->with('success', 'You registered successfully!');

    }
}
