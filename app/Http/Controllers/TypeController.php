<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Type;
use Illuminate\Http\Request;
use Auth;

class TypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$types = Type::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('types.index', compact('types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$type = new Type();

		$type->type = $request->input("type");
		$type->user_id = Auth::user()->id;

		$type->save();

		return redirect()->route('types.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$type = Type::findOrFail($id);

		return view('types.show', compact('type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$type = Type::findOrFail($id);

		return view('types.edit', compact('type'));
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
		$type = Type::findOrFail($id);

		$type->type = $request->input("type");

		$type->save();

		return redirect()->route('types.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$type = Type::findOrFail($id);
		$type->delete();

		return redirect()->route('types.index')->with('message', 'Item deleted successfully.');
	}

}
