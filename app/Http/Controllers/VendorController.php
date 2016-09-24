<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Auth;

class VendorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vendors = Vendor::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('vendors.index', compact('vendors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('vendors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$vendor = new Vendor();

		$vendor->vendor = $request->input("vendor");
		$vendor->user_id = Auth::user()->id;

		$vendor->save();

		return redirect()->route('vendors.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vendor = Vendor::findOrFail($id);

		return view('vendors.show', compact('vendor'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vendor = Vendor::findOrFail($id);

		return view('vendors.edit', compact('vendor'));
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
		$vendor = Vendor::findOrFail($id);

		$vendor->vendor = $request->input("vendor");

		$vendor->save();

		return redirect()->route('vendors.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$vendor = Vendor::findOrFail($id);
		$vendor->delete();

		return redirect()->route('vendors.index')->with('message', 'Item deleted successfully.');
	}

}
