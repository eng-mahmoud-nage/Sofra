<?php

namespace App\Http\Controllers\Api\restaurants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OfferController extends Controller
{
    public function set_offer(Request $request){
        $validator = validator()->make($request->all(), [
            'image' => 'required',
            'name' => 'required',
            'description' => 'required',
            'from' => 'required|date',
            'to' => 'required|date',
        ]);

        if ($validator->fails()){
            return ResponseJson(0, $validator->errors()->first());
        }

        $record = $request->user()->offers()->create($request->all());
        return ResponseJson(1, 'Offer inserted successfully',
            ['record' => $record]);
    }

    public function update_offer(Request $request){
        $record = $request->user()->offers()->where('id', $request->offer_id)
            ->update($request->except('offer_id', 'api_token'));
        return ResponseJson(1, 'Offer Updated successfully',
            ['record' => $record]);
    }

    public function offers(){
        $record = auth()->user()->offers()->
        where('from', '<=', now())->where('to', '>=', now())->get();
        return ResponseJson(1, 'Offers on date',
            ['record' => $record]);
    }

    public function offer(Request $request){
        $record = $request->user()->offers()->where('id', $request->offer_id)->get();
        return ResponseJson(1, 'Offer selected',
            ['record' => $record]);
    }
}
