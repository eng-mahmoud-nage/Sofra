<?php

namespace App\Http\Controllers\Api;

use App\General\City;
use App\General\Contact;
use App\General\District;
use App\General\Transaction;
use App\Http\Controllers\Controller;
use App\General\Setting;
use App\Restaurants\Category;
use App\Restaurants\Offer;
use App\Restaurants\Restaurant;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function cities(){
        $record = City::all();
        return ResponseJson(1, 'cities', ['record' => $record]);
    }

    public function districts(Request $request){
        if ($request->has('id'))
        {
            $record = District::where('city_id', $request->id)->get()->load('city');
        }else{
            $record = District::all()->load('city');
        }
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

    public function calc_transaction(Request $request){
        $total_orders = array_sum($request->user()->orders()->pluck('total')->toArray());

        $restaurant = Transaction::where('restaurant_id', $request->user()->id)->first();

        if (!$restaurant){
            $request->user()->transactions()->create([
                'paid' => isset($request->paid)?$request->paid:0 ,
                'residual' => $total_orders - $request->paid
            ]);
            return ResponseJson(1, 'your transaction inserted already');
        }

        $validator = validator()->make($request->all(), [
            'paid' => 'required',
        ]);
        if ($validator->fails()){
            return ResponseJson(0, $validator->errors()->first());
        }

        $total_orders = $request->user()->orders()->sum('total');
        if ($restaurant->residual < $request->paid){
            return ResponseJson(0, 'Your residual less than paid',
                ['residual' => $restaurant->residual]);
        }
        $request->user()->transactions()->update([
            'paid' => $restaurant->paid + $request->paid,
            'residual' => $total_orders - ($restaurant->paid + $request->paid),
        ]);
        return ResponseJson(1, 'your transaction updated already',
        ['transaction' => $restaurant->fresh()]);
    }

    public function show_transaction(Request $request){
        $restaurant = Transaction::where('restaurant_id', $request->user()->id)->first();
        return ResponseJson(1, 'your transaction',
            ['transaction' => $restaurant]);
    }

}
