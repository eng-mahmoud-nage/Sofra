<?php 

namespace App\Http\Controllers;

use App\Resturant\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller 
{

 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $records = Category::all()->load('resturants');
        return view('admin/pages/categories.all')->with(['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $record = new Category();
        return view('admin.pages.categories.createOrUpdate', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        Category::create($request->all());
        return redirect(url(route('category.index')))->with('success', 'Category Created');
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
        $record = Category::find($id);
        return view('admin/pages/categories.createOrUpdate', compact('record'));
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
            'name' => 'required|unique:categories,name,'.$id
        ]);
        Category::find($id)->update($request->all());
        return redirect(url(route('category.index')))->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect(url(route('category.index')))->with('warning', 'Category Deleted');
    }
  
}

?>