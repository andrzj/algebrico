<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class SubcategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$subcategories = Subcategory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('subcategories.index', compact('subcategories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::where('user_id', Auth::user()->id)->lists('category', 'id');
		return view('subcategories.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$subcategory = new Subcategory();

		$subcategory->category_id = $request->input("category_id");
        $subcategory->subcategory = $request->input("subcategory");
        $subcategory->user_id = Auth::user()->id;

		$subcategory->save();

		return redirect()->route('subcategories.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subcategory = Subcategory::findOrFail($id);

		return view('subcategories.show', compact('subcategory'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$subcategory = Subcategory::findOrFail($id);
		$categories = Category::lists('category', 'id');

		return view('subcategories.edit', compact('subcategory', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$subcategory = Subcategory::findOrFail($id);

		$subcategory->category_id = $request->input("category_id");
        $subcategory->subcategory = $request->input("subcategory");

		$subcategory->save();

		return redirect()->route('subcategories.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$subcategory = Subcategory::findOrFail($id);
		$subcategory->delete();

		return redirect()->route('subcategories.index')->with('message', 'Item deleted successfully.');
	}

}
