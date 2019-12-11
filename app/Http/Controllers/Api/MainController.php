<?php

namespace App\Http\Controllers\Api;

use App\General\City;
use App\General\Contact;
use App\Http\Controllers\Controller;
use App\General\Setting;
use App\Resturant\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cities(){
        $record = City::all();
        return ResponseJson(1, 'cities', ['record' => $record]);
    }

    public function categories(){
        $record = Category::all();
        return ResponseJson(1, 'categories', ['record' => $record]);
    }

    public function setting(){
        $record = Setting::all();
        return ResponseJson(1, 'setting', ['record' => $record]);
    }

    public function set_contact(Request $request){
        $validator = validator()->make($request->all(), [
            'phone' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|unique:contacts',
        ]);
        if ($validator->fails()){
            return ResponseJson(0, $validator->errors()->first());
        }
        $record = Contact::create($request->all());
        return ResponseJson(1, 'Your Message sent successfully', ['record' => $record]);
    }

}
