<?php

namespace App\Http\Controllers;

use App\Client\Client;
use App\Restaurants\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Restaurant::all();
        return view('admin/pages/restaurants.all')->with(['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $c = Restaurant::find($id);
        if(!$request->has('active')){
            $c->active = 0;
            $c->save();
            return redirect(url(route('restaurant.index')))->with('danger', $c->name.' Baned');
        }else{
            $c->active = 1;
            $c->save();
            return redirect(url(route('restaurant.index')))->with('success', $c->name.' Active know');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Restaurant::find($id)->delete();
        return redirect(url(route('restaurant.index')))->with('warning', 'Restaurant Deleted');
    }

}

?>
