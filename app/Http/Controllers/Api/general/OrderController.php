<?php

namespace App\Http\Controllers\Api\general;

use App\Client\Client;
use App\General\Order;
use App\General\Product;
use App\General\Setting;
use App\Http\Controllers\Controller;
use App\Restaurants\Restaurant;
use Illuminate\Http\Request;
use Ramsey\Uuid\FeatureSet;

class OrderController extends Controller
{
    public function create_order(Request $request){
        $validator = validator()->make($request->all(), [
            'payment_method_id' => 'required|exists:payment_methods,id',
            'address' => 'required',
            'restaurant_id' => 'required|exists:restaurants,id',
            'product_ids.*.id' => 'required|exists:products,id',
            'product_ids.*.quantity' => 'required',

        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }
        $settings = Setting::find(1);
        $restaurant = Restaurant::find($request->restaurant_id);
        if($restaurant->available == 'close'){
            return ResponseJson(0, 'Sorry, this restaurant closed now');
        }

        $order = $request->user()->orders()->create([
            'payment_method_id' => $request->payment_method_id,
            'address' => $request->address,
            'restaurant_id' => $request->restaurant_id,
            'note' => isset($request->note)?$request->note:'',
            'delivery_charge' => $restaurant->delivery_charge,
        ]);
//        dd($order);
        $cost = 0;
        foreach ($request->product_ids as $id){
            $product = Product::find($id['id']);

            $item =[
              $id['id'] => [
                  'quantity' => $id['quantity'],
                  'price' => $product->price,
                  'note' => isset($product->note)?$product->note:'',
              ]
            ];
            $order->products()->attach($item);
            $cost += $product->price * $id['quantity'];
        }
        if ($cost < $restaurant->minimum_charge){
            return ResponseJson(0, 'Sorry, i can`t accept this order,
            because your order less than minimum charge');
        }
        $total = $cost + $restaurant->delivery_charge;

        $commission = ($settings->commission * $cost)/100;

        $net = $total - $commission;

        $order->update([
            'coast' => $cost,
            'net' => $net,
            'total' => $total,
            'commission' => $commission
        ]);

        $notification = $restaurant->notifications()->create([
            'title' => $restaurant->name.' have new Order',
            'content' => $request->user()->name.' Request New Order ',
            'order_id' => $order->id,
        ]);

        $tokens = $restaurant->token()->pluck('token');
        $body = $notification->body;
        $title = $notification->title;
        $data = [
            'order_id' => $order->id
        ];

        $n = notifyByFirebase($title,$body,$tokens,$data);

        return ResponseJson(1, 'Your Order inserted successfully', ['order' => $order->fresh(), 'notification' => $n]);
    }

    public function orders(Request $request){
        if($request->has('restaurant_id')){
            $record = $request->user()->orders()
                ->where('restaurant_id', $request->restaurant_id)->get()->toArray();
        }else{

            $record =  $request->user()->orders;
        }
        return ResponseJson(1,
            $record == []?'You don`t have orders':'Orders',
            ['record' => $record]);
    }

    public function order(Request $request){
        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }
            $record = $request->user()->orders()
                ->where('id', $request->order_id)->get()->toArray();

        return ResponseJson(1,
            $record == []?'You don`t have orders':'Order',
                    ['record' => $record]);
    }

    public function accepted(Request $request){

        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $order = $request->user()->orders()
            ->where('id', $request->order_id)->first();

        if ($order->status == 'pending') {
            $order->update(['status' => 'accepted']);
            $order->fresh();
            $tokens = $request->user()->token()->pluck('token');
            $receiver = Client::where('id', $order->client_id)->first();

            $this->send_notify($receiver, $request->user(), $order, $tokens);

            return ResponseJson(1,
                'You order '. $order->status);
        }
        return ResponseJson(0,
            'You don`t have authorize, Your order still '. $order->status);
    }

    public function rejected(Request $request){

        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $order = $request->user()->orders()
            ->where('id', $request->order_id)->first();

        if (($request->route()->middleware()[1] == 'auth:client-api' && $order->status == 'accepted') || $order->status == 'pending') {
            $order->update(['status' => 'rejected']);
            $order->fresh();
            $tokens = $request->user()->token()->pluck('token');
            $receiver = Client::where('id', $order->client_id)->first();

            $this->send_notify($receiver, $request->user(), $order, $tokens, $request->reason);

            return ResponseJson(1,
                'You order '. $order->status);
        }
        return ResponseJson(0,
            'You don`t have authorize, Your order still '. $order->status);
    }

    public function delivered(Request $request){

        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $order = $request->user()->orders()
            ->where('id', $request->order_id)->first();

        if ($order->status == 'accepted') {
            $order->update(['status' => 'delivered']);
            $order->fresh();
            $tokens = $request->user()->token()->pluck('token');

            $receiver = $request->route()->middleware()[1] == 'auth:client-api'?
                Restaurant::where('id', $order->restaurant_id)->first()
                :Client::where('id', $order->client_id)->first();

            $this->send_notify($receiver, $request->user(), $order, $tokens);

            return ResponseJson(1,
                'You order '. $order->status);
        }
        return ResponseJson(0,
            'You don`t have authorize, Your order still '. $order->status);
    }

    public function canceled(Request $request){

        $validator = validator()->make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'reason' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson(0, $validator->errors()->first());
        }

        $order = $request->user()->orders()
            ->where('id', $request->order_id)->first();

        if (($request->route()->middleware()[1] == 'auth:client-api' && $order->status == 'pending') || $order->status == 'accepted') {
            $order->update(['status' => 'canceled']);
            $order->fresh();
            $tokens = $request->user()->token()->pluck('token');

            $receiver = $request->route()->middleware()[1] == 'auth:client-api'?
                Restaurant::where('id', $order->restaurant_id)->first()
                :Client::where('id', $order->client_id)->first();

            $this->send_notify($receiver, $request->user(), $order, $tokens, $request->reason);

            return ResponseJson(1,
                'You order '. $order->status);
        }
        return ResponseJson(0,
            'You don`t have authorize, Your order still '. $order->status);
    }

    public function send_notify($receiver, $sender, $order, $tokens, $reason=''){

        $notification = $receiver->notifications()->create([
            'title' => $sender->name. '  ' . $order->status . ' your order ',
            'content' => $reason == ''?'your order ' . $order->status:$reason,
            'order_id' => $order->id,
        ]);

        $body = $notification->body;
        $title = $notification->title;
        $data = [
            'order_id' => $order->id
        ];
        $n = notifyByFirebase($title,$body,$tokens,$data);

        return ResponseJson(1, 'Your Order inserted successfully',
            ['order' => $order, 'notification' => $n]);

    }

}




