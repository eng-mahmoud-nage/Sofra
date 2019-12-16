<?php

namespace App\Http\Controllers\Api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function set_token(Request $request){
        $validator = validator()->make($request->all(), [
            'type' => 'required|in:android,IOS',
            'token' => 'required',
        ]);
        if ($validator->fails()){
            return ResponseJson(0, $validator->errors()->first());
        }
        $request->user()->token()->create([
            'type' => $request->type,
            'token' => $request->token
        ]);

        return ResponseJson(1, 'Your token inserted successfully');
    }

    public function token(){
        $record = auth()->user()->token()->get()->toArray();
        return ResponseJson(1,
            $record == []?'You don`t have token':'Your token', ['record' => $record]);
    }

    public function remove_token(Request $request){
        $record = auth()->user()->token()->delete();
        return ResponseJson(1,
            'Your token removed successfully');
    }
}
