<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Models\Category;
use App\Models\Vendor;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/bookmarks/storeFromTransaction/{id}', 'BookmarkController@storeFromTransaction');

	Route::post('/transactions/report', 'TransactionController@postReport');
	Route::get('/transactions/report', 'TransactionController@getReport');
	Route::get('/transactions/{id}/json', 'TransactionController@getShow');

	Route::resource("accounts","AccountController");
	Route::resource("categories","CategoryController");
	Route::resource("subcategories","SubcategoryController");
	Route::resource("types","TypeController");
	Route::resource("vendors","VendorController");
	Route::resource("bookmarks","BookmarkController");
	Route::resource("transactions","TransactionController");
	Route::resource("users","UserController");
	Route::resource("importer_helpers","ImporterHelperController");

	Route::get("/importer", "ImporterController@getIndex");
	Route::post("/importer/process", "ImporterController@postProcess");

	// Subcategories load
	Route::get('/api/subcategoryDropdown', function(){
	    $id = Input::get('option');    
	    $subcategories = Category::find($id)->subcategories;
	    return $subcategories->lists('subcategory', 'id');
	});

	// Load a Vendor Category and Subcategory
	Route::get('/api/vendorCatSub', function(){
	    $id = Input::get('id');    
	    $vendor = Vendor::find($id);
	    return '{"c":"' . $vendor->category_id . '", "s":"' . $vendor->subcategory_id . '"}';
	});
});