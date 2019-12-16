<?php

namespace App\Http\Controllers\Api\restaurants;

use App\Restaurants\Restaurant;
use App\Mail\RsetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required|exists:restaurants',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $restaurant = Restaurant::where('email', $request->email)->first();
        if ($restaurant) {
            if (Hash::check($request->password, $restaurant->password)) {
                return ResponseJson(
                    1,
                    'Welcome To Sofra Application',
                    [
                        'api_token' => $restaurant->api_token,
                        'restaurant' => $restaurant
                    ]
                );
            } else {
                return ResponseJson(0, 'Please enter your correct password');
            }
        }
    }

    public function register(Request $request)
    {

        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:restaurants',
            'phone' => 'required|min:11|unique:restaurants',
            'date_of_birth' => 'required|date',
            'district_id' => 'required',
            'minimum_charge' => 'required',
            'delivery_charge' => 'required',
            'delivery_time' => 'required',
            'whats_app_number' => 'required',
            'category_ids' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }
        $request->merge(['password' => Hash::make($request->password)]);
        $restaurant = Restaurant::create($request->except('api_token'));
        $restaurant->api_token = Str::random(60);
        $restaurant->save();

        $restaurant->categories()->sync($request->category_ids);
        return ResponseJson(1, 'Welcome to Sofra App', [
            'api_token' => $restaurant->api_token,
            'restaurant' => $restaurant
        ]);
    }

    public function profile(Request $request)
    {
        $record = Restaurant::find(auth()->user()->id);
        if ($request->except('api_token')) {
            if ($request->has('password')) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $update = $record->where('id', $record->id)->update($request->all());
            return ResponseJson(1,
                'Your Profile Updated Successfully',
                ['data' => $record->fresh()]
            );
        }
        return ResponseJson(1,
            'Your Profile Data',
            ['data' => $record->fresh()]
        );
    }

    public function reset_password(Request $request)
    {
        if ($request->has('phone'))
            $restaurant = Restaurant::where('phone', $request->phone)->first();
        elseif ($request->has('email'))
            $restaurant = Restaurant::where('email', $request->email)->first();
        if($restaurant){

        $restaurant->update(['pin_code' => rand(1111, 9999)]);

        Mail::to($restaurant->email)
            //            ->cc($moreUsers)
                        ->bcc('mahmoudnagy270@gmail.com')
            ->send(new RsetPassword($restaurant));
        return ResponseJson(1, 'please, check your mail', $restaurant->pin_code);
        }
        return ResponseJson(0, 'This Restaurant not exist on our app');
    }

    public function new_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'new_password' => 'required|min:8',
            'confirmed_password' => 'required|same:new_password',
            'pin_code' => 'required|exists:restaurants'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $restaurant = Restaurant::where('pin_code', $request->pin_code)->first();

        if (Hash::check($request->input('new_password'), $restaurant->password)) {
            return ResponseJson(0, 'this password took before, please change your password');
        }

        $restaurant->update(['pin_code' => null, 'password' => Hash::make($request->new_password)]);

        return ResponseJson(1, 'your password changed successfully');
    }

    public function change_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'new_password' => 'required|min:8',
            'confirmed_password' => 'required|same:new_password',
            'old_password' => 'required'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        if (Hash::check($request->old_password, auth()->user()->password)) {
            if (Hash::check($request->input('new_password'), auth()->user()->password)) {
                return ResponseJson(0, 'Your new Password same old Password!');
            } else {
                $request->user()->update(['password' => Hash::make($request->new_password)]);
            }
        } else {
            return ResponseJson(0, 'Your old password is wrong!');
        }

        return ResponseJson(1, 'Your Password Changed Successfully');
    }
}
