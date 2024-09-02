<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function users()
    {
        $data = User::query()
            ->with('image')
            ->orderBy('id','DESC')
            ->paginate(1);
//            ->get();
        $users=UserResource::collection($data);
        return view('admin.users',compact('users'));
    }
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));

    }
    public function update_user(Request $request, $id){
        $data = $request->all();
        $user = User::updateOrCreate(['id' => $id], $data);
        return redirect()->route('dashboard.edit.user', $user->id)->with('success', 'Updated successfully!');
    }

    public function contacts()
    {
        $data = Contact::all();

        $contacts=ContactResource::collection($data);
//        return $contacts;
        return view('admin.contacts',compact('contacts'));
    }
}
