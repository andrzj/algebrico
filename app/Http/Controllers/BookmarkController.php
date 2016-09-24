<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Auth;

class BookmarkController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookmarks = Bookmark::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('bookmarks.index', compact('bookmarks'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('bookmarks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$bookmark = new Bookmark();

		$type_id = $request->input("type_id");
		$bookmark->account_id = $request->input("account_id");
		$bookmark->accountto_id = ($type_id == 3) ? $request->input("accountto_id") : null;
        $bookmark->category_id = ($type_id == 3) ? null : $request->input("category_id");
        $bookmark->subcategory_id = ($type_id == 3) ? null : $request->input("subcategory_id");
        $bookmark->type_id = $type_id;
        $vendor_id = $request->input("vendor_id");
        $bookmark->vendor_id = ($type_id == 3 || empty($vendor_id) || $vendor_id == 'undefined') ? null : $vendor_id;
		$bookmark->user_id = Auth::user()->id;

		$bookmark->save();

		return redirect()->route('bookmarks.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Store a newly created resource from Transaction page in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function storeFromTransaction(Request $request, $id)
	{
		$bookmark = new Bookmark();

		$type_id = $request->old("type_id");
		$amount = str_replace(',', '.', str_replace('.', '', $request->old("amount")));
        $bookmark->amount = ($type_id == 1) ? $amount * -1 : $amount;
        $bookmark->account_id = $request->old("account_id");
		$bookmark->accountto_id = ($type_id == 3) ? $request->old("accountto_id") : null;
        $bookmark->category_id = ($type_id == 3) ? null : $request->old("category_id");
        $bookmark->subcategory_id = ($type_id == 3) ? null : $request->old("subcategory_id");
        $bookmark->type_id = $type_id;
        $vendor_id = $request->old("vendor_id");
        $bookmark->vendor_id = ($type_id == 3 || empty($vendor_id) || $vendor_id == 'undefined') ? null : $vendor_id;
        $bookmark->note = $request->old("note");
        $bookmark->user_id = Auth::user()->id;

		$bookmark->save();

		return redirect()->route('transactions.edit', $id)->with('message', 'Bookmark created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bookmark = Bookmark::findOrFail($id);

		return view('bookmarks.show', compact('bookmark'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bookmark = Bookmark::findOrFail($id);

		return view('bookmarks.edit', compact('bookmark'));
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
		$bookmark = Bookmark::findOrFail($id);

		$bookmark->account_id = $request->input("account_id");
        $bookmark->accountto_id = $request->input("accountto_id");
        $bookmark->category_id = $request->input("category_id");
        $bookmark->subcategory_id = $request->input("subcategory_id");
        $bookmark->type_id = $request->input("type_id");
        $bookmark->vendor_id = $request->input("vendor_id");

		$bookmark->save();

		return redirect()->route('bookmarks.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$bookmark = Bookmark::findOrFail($id);
		$bookmark->delete();

		return redirect()->route('bookmarks.index')->with('message', 'Item deleted successfully.');
	}

}
