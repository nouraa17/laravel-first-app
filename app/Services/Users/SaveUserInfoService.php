<?php
namespace App\Services\Users;
use App\Models\User;

class SaveUserInfoService
{
    public static function save($data,$id=null)
    {
//        if($id == null){
//            User::query()->create($data);
//        }else{
//            User::query()->find($id)->update($data);
//        }
        $user=User::query()->updateOrCreate(['id'=>$id],$data);
        return $user;
    }

}
