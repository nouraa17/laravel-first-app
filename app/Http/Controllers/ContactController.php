<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
//        return request()->path();
//        return request()->url();
//        return request()->fullUrl();
//        return request()->host();
//        return request()->ip();
//        if (request()->has('test')){
        if (request()->filled('test')){
            echo 'test';
        }
        return view('contact');
    }
    public function submit(ContactFormRequest $request)
    {
//        return request()->all();
//        return request()->only(['username','title']);
//        return request()->except('username');
//        return request()->input('username');
//        return request('username');
          ////////////////////////////////////////////////////////////

//        dd($request->validated()); //dd in laravel , die in php

//        validation implemented in Requests

//        request()->validate([
//            'username' => 'required|min:3|max:20', //required | nullable | email
//            'title' => 'required|min:3|max:150',
//            'message' => 'required|min:30',
//        ]);
          ////////////////////////////////////////////////////////////
//        Contact::create([
//            'username' => request('username'),
//            'title' => request('title'),
//            'message' => request('message'),
//        ]);

        Contact::query()->create($request->validated());

        return redirect()->back()->with('success', 'Your message has been sent');
    }

    public function get_data()
    {
//        $data = Contact::all(); == get()
        $data = Contact::query()->orderBy('id', 'desc')->get();
        return ContactResource::collection($data);
    }


















}
