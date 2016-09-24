<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ImporterHelper;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Vendor;

use Illuminate\Http\Request;
use Auth;

class ImporterHelperController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$importer_helpers = ImporterHelper::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('importer_helpers.index', compact('importer_helpers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::where('user_id', Auth::user()->id)->lists('category', 'id');
		$subcategories = Subcategory::where('user_id', Auth::user()->id)->lists('subcategory', 'id');
		$vendors = Vendor::where('user_id', Auth::user()->id)->select('id as value', 'vendor as text')->orderBy('text')->get();

		return view('importer_helpers.create', compact('categories', 'subcategories', 'vendors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $this->validate($request, [
	        'description' => 'required|max:255',
	        'vendor_id' => 'required',
	    ]);

		$importer_helper = new ImporterHelper();

		$importer_helper->description = $request->input("description");
        $importer_helper->category_id = $request->input("category_id");
        $importer_helper->subcategory_id = $request->input("subcategory_id");
        $importer_helper->vendor_id = $request->input("vendor_id");
        $importer_helper->user_id = Auth::user()->id;

		$importer_helper->save();

		return redirect()->route('importer_helpers.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$importer_helper = ImporterHelper::findOrFail($id);

		return view('importer_helpers.show', compact('importer_helper'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$importer_helper = ImporterHelper::findOrFail($id);

		return view('importer_helpers.edit', compact('importer_helper'));
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
		$importer_helper = ImporterHelper::findOrFail($id);

		$importer_helper->description = $request->input("description");
        $importer_helper->category_id = $request->input("category_id");
        $importer_helper->subcategory_id = $request->input("subcategory_id");
        $importer_helper->vendor_id = $request->input("vendor_id");

		$importer_helper->save();

		return redirect()->route('importer_helpers.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$importer_helper = ImporterHelper::findOrFail($id);
		$importer_helper->delete();

		return redirect()->route('importer_helpers.index')->with('message', 'Item deleted successfully.');
	}

}
