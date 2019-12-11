<?php

namespace App\Http\Controllers\Api\resturants;

use App\Resturant\Resturant;
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
            'email' => 'required|exists:resturants',
            'password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $resturant = Resturant::where('email', $request->email)->first();
        if ($resturant) {
            if (Hash::check($request->password, $resturant->password)) {
                return ResponseJson(
                    1,
                    'Welcome To Sofra Application',
                    [
                        'api_token' => $resturant->api_token,
                        'resturant' => $resturant
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
            'email' => 'required|email|unique:resturants',
            'phone' => 'required|min:11|unique:resturants',
            'date_of_birth' => 'required|date',
            'district_id' => 'required',
            'category_id' => 'required',
            'minimum_charge' => 'required',
            'delivery_charge' => 'required',
            'whats_app_number' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $request->merge(['password' => Hash::make($request->password)]);
        $resturant = Resturant::create($request->except('api_token'));
        $resturant->api_token = Str::random(60);
        $resturant->save();
        return ResponseJson(1, 'Welcome to Sofra App', [
            'api_token' => $resturant->api_token,
            'resturant' => $resturant
        ]);
    }

    public function profile(Request $request)
    {
        $record = Resturant::find(auth()->user()->id);
        if ($request->except('api_token')) {
            if ($request->has('password')) {
                $request->merge(['password' => Hash::make($request->password)]);
            }
            $update = $record->where('id', $record->id)->update($request->all());
            return ResponseJson(
                1,
                'Your Profile Updated Successfully',
                ['record' => $record->fresh()]
            );
        }
        return ResponseJson(1,
            'Your Profile Data',
            ['record' => $record->fresh()]
        );
    }

    public function reset_password(Request $request)
    {
        if ($request->has('phone'))
            $resturant = Resturant::where('phone', $request->phone)->first();
        elseif ($request->has('email'))
            $resturant = Resturant::where('email', $request->email)->first();
        if($resturant){
            
        $resturant->update(['pin_code' => rand(1111, 9999)]);

        Mail::to($resturant->email)
            //            ->cc($moreUsers)
                        ->bcc('mahmoudnagy270@gmail.com')
            ->send(new RsetPassword($resturant));
        return ResponseJson(1, 'please, check your mail', $resturant->pin_code);
        }
        return ResponseJson(0, 'This Resturant not exist on our app');
    }

    public function new_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'new_password' => 'required|min:8',
            'confirmed_password' => 'required|same:new_password',
            'pin_code' => 'required|exists:resturants'
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $resturant = Resturant::where('pin_code', $request->pin_code)->first();

        if (Hash::check($request->input('new_password'), $resturant->password)) {
            return ResponseJson(0, 'this password took before, please change your password');
        }

        $resturant->update(['pin_code' => null, 'password' => Hash::make($request->new_password)]);

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
