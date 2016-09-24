<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$accounts = Account::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

		return view('accounts.index', compact('accounts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('accounts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$account = new Account();

		$account->account = $request->input("account");
        $account->balance = $request->input("balance");
        $account->user_id = Auth::user()->id;

		$account->save();

		return redirect()->route('accounts.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$account = Account::findOrFail($id);

		return view('accounts.show', compact('account'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$account = Account::findOrFail($id);

		return view('accounts.edit', compact('account'));
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
		if($request->input('saveButton')) {
			$account = Account::findOrFail($id);
			$account->account = $request->input("account");
	        $account->balance = $request->input("balance");
			$account->save();
			return redirect()->route('accounts.index')->with('message', 'Item updated successfully.');

		} elseif($request->input('recalculateButton')) {
			DB::statement('call spSetAccountAmount(:account_id)', array('account_id' => $id));
			$account = Account::findOrFail($id);
			return redirect()->route('accounts.edit', compact('account'))->with('message', 'Balance updated successfully');
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
		$account = Account::findOrFail($id);
		$account->delete();

		return redirect()->route('accounts.index')->with('message', 'Item deleted successfully.');
	}

	public function missingMethod($params = array()){
		return 'Pagina nao encontrada';
	}
}