<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\ImporterHelper;
use Auth;

class ImporterController extends Controller {
	
	public function getIndex(){
		$accounts = Account::where('user_id', Auth::user()->id)->lists('account', 'id');
		return view('importer.index', compact("accounts"));
	}

	public function postProcess(Request $request){
		$due_month = $request->input("due_month");
		$due_year = $request->input("due_year");
		$account_id = $request->input("account_id");
		$is_credit_card = $request->input("is_credit_card");

		// Upload the csv to a temp folder
		$this->validate($request, [
        	'file' => 'required|max:100',
    	]);
    	$file = $request->file('file');
    	$path = $file->getClientOriginalName();
		$file->move(base_path() . '/assets/upload/', $path);

		// Open the file
		$fp = base_path() . '/assets/upload/' . $path;
		$csv = $this->readCSV($fp);

		foreach ($csv as $val) {
			if (!empty($val[2])){

				// Check if exists a register in database that indicates the category, subcategoy 
				// and vendor to the current item
				$importer_helper = ImporterHelper::where('user_id', Auth::user()->id)
												 ->where('description', '=', $val[1])->first();

				// Save the data
				$data = array("date" => "$val[0]",
						      "amount" => "$val[2]",
						      "category_id" => (!empty($importer_helper) ? $importer_helper->category_id : "11"),
						      "subcategory_id" => (!empty($importer_helper) ? $importer_helper->subcategory_id : "72"),
						      "note" => "$val[1]");

				$transaction = new Transaction();
				$dt = explode("/", $data["date"]);
				$transaction->date = $dt[2].'-'.$dt[1].'-'.$dt[0];
				$transaction->amount = str_replace(',', '.', str_replace('.', '', $data['amount']));
				$transaction->type_id = $transaction->amount < 0 ? 1 : 2;
				$transaction->category_id = $data['category_id'];
				$transaction->subcategory_id = $data['subcategory_id'];
				$transaction->account_id = $account_id;
				$transaction->due_month = $is_credit_card == 'true' ? (empty($due_month) ? $dt[1] : $due_month) : $dt[1]; // If is credit card, uses the 'due_month' input value, otherwise, uses the month of the transaction date
				$transaction->due_year = $is_credit_card == 'true' ? (empty($due_year) ? $dt[2] : $due_year) : $dt[2]; // If is credit card, uses the 'due_year' input value, otherwise, uses the year of the transaction date
				$transaction->note = $data['note'];
				$transaction->user_id = Auth::user()->id;

				Account::updateBalance($transaction->account_id, $transaction->amount);

				$transaction->save();
			}
		}

		// delete the file
		unlink($fp);

		return redirect('/importer')->with('message', 'File imported successfully.');
	}

	function readCSV($csvFile){
		$file_handle = fopen($csvFile, 'r');
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024, ';');
		}
		fclose($file_handle);
		return $line_of_text;
	}

	function CallAPI($method, $url, $data = false)
	{
	    $curl = curl_init();

	    switch ($method)
	    {
	        case "POST":
	            curl_setopt($curl, CURLOPT_POST, 1);

	            if ($data)
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case "PUT":
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	    }

	    // Optional Authentication:
	    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	    $result = curl_exec($curl);

	    curl_close($curl);

	    return $result;
	}
}

?>