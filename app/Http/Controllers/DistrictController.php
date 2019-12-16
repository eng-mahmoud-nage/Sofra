<?php

namespace App\Http\Controllers;

use App\General\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = District::all()->load('city');
        return view('admin/pages/districts.all', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $record = new District();
        return view('admin.pages.districts.createOrUpdate',compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:districts'
        ]);
        $c = District::create($request->all());
        return redirect(url(route('district.index')))->with('success', 'District Created');
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
        $record = District::find($id);
        return view('admin.pages.districts.createOrUpdate',compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:districts,name,'.$id
        ]);
        District::find($id)->update($request->all());
        return redirect(url(route('district.index')))->with('success', 'District Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        District::find($id)->delete();
        return redirect(url(route('district.index')))->with('warning', 'District Deleted');
    }

}

?>
