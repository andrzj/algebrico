<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Transaction;
use App\Models\Account;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Type;
use App\Models\Vendor;
use App\Models\Bookmark;

use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('transactions.date', 'desc')->paginate(10);		
		return view('transactions.index', compact('transactions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$accounts = Account::where('user_id', Auth::user()->id)->lists('account', 'id');
		$categories = Category::where('user_id', Auth::user()->id)->lists('category', 'id');
		$subcategories = Subcategory::where('user_id', Auth::user()->id)->lists('subcategory', 'id');
		$types = Type::where('user_id', Auth::user()->id)->lists('type', 'id');
		$vendors = Vendor::where('user_id', Auth::user()->id)->select('id as value', 'vendor as text')->orderBy('text')->get();
		$bookmarks = Bookmark::where('user_id', Auth::user()->id)->get();

		return view('transactions.create', compact('accounts', 'categories', 'subcategories', 'types', 'vendors', 'bookmarks'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$transaction = Transaction::findOrFail($id);
		return view('transactions.show', compact('transaction'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$transaction = Transaction::findOrFail($id);
		$accounts = Account::lists('account', 'id');
		$categories = Category::lists('category', 'id');
		$subcategories = Subcategory::lists('subcategory', 'id');
		$types = Type::lists('type', 'id');
		$vendors = Vendor::select('id as value', 'vendor as text')->orderBy('text')->get();
		
		return view('transactions.edit', compact('transaction', 'accounts', 'categories', 'subcategories', 'types', 'vendors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$due_month = $request->input("due_month");
		$due_year = $request->input("due_year");
		$calc_amount = str_replace(',', '.', str_replace('.', '', $request->input("amount"))) / $request->input('allotment');

		// Verify and process the allotments
		if($request->input('allotment') > 1){
			for ($i=0; $i < $request->input('allotment'); $i++) {
				$transaction = new Transaction();

				$arr = array('amount'=> $calc_amount
							,'due_month'=>$due_month
							,'due_year'=>$due_year
							);
				Transaction::keep($request, $transaction, $arr);

				if(($due_month + 1) > 12){
					$due_month = 1;
					$due_year++;
				}
				else{
					$due_month++;
				}
			}
		} else{
			$transaction = new Transaction();
			Transaction::keep($request, $transaction);
		}

		return redirect()->route('transactions.index')->with('message', 'Item created successfully.');
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
		if($request->input('transactionButton')) {
			$transaction = Transaction::findOrFail($id);
			Transaction::keep($request, $transaction);
			return redirect()->route('transactions.index')->with('message', 'Item updated successfully.');

		} elseif($request->input('bookmarkButton')) {
			return redirect()->action('BookmarkController@storeFromTransaction', $id)->withInput();
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
		$transaction = Transaction::findOrFail($id);
		
		// Updates the balance
		if($transaction->type_id == 3) $transaction->amount *= -1;
		Account::updateBalance($transaction->account_id, $transaction->amount * -1);
		if($transaction->accountto_id) Account::updateBalance($transaction->accountto_id, $transaction->amount);

		// Finnaly deletes the transaction
		$transaction->delete();

		return redirect()->route('transactions.index')->with('message', 'Item deleted successfully.');
	}

	public function missingMethod($params = array()){
		return 'Pagina nao encontrada';
	}

	public function postReport(Request $request)
	{
		$request->flash();

		$user = Auth::user();

		$accounts = Account::where('user_id', $user->id)->lists('account', 'id');
		$due_month = $request->input("due_month");
		$due_year = $request->input("due_year");
		$account_id = $request->input("account_id");
		
		$transactions = Transaction::orderBy('date', 'asc')
									->where('account_id', $account_id)
			                        ->where('due_month', $due_month)
			                        ->where('due_year', $due_year)
			                        ->where('user_id', $user->id)
			                        ->get();
			                        
		return view('transactions.report', compact('transactions', 'accounts'));
	}

	public function getReport()
	{
		$user = Auth::user();
		$accounts = Account::where('user_id', $user->id)->lists('account', 'id');
		$transactions = array();
		return view('transactions.report', compact('transactions', 'accounts'));
	}

	/**
	 * Display the specified resource in JSON.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		return response()->json(Transaction::findOrFail($id));
	}
}
