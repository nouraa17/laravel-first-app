<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function delete()
    {
        if(request()->filled('model_name') && request()->filled('id')){
//            $item =('App\Models\\' . request('model_name'))::query()->find(request('id'));
//            if($item != null){
//                $item->delete();
//                return redirect()->back();
//            }
          DB::select('DELETE FROM '.request('model_name').' WHERE id='.request('id'));
            return redirect()->back();

        }
    }
}
