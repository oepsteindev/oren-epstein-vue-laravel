<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
use Illuminate\Http\Request;
use App\Contact;
use App\Thumbs;

Route::group(['middleware' => 'api'], function(){


	
	//get contacts
	Route::get('contacts', function(){
		return Contact::latest()->orderBy('created_at', 'desc')->get();
	});

	//get single contact
 	Route::get('contact/{id}', function($id){
 		return Contact::findOrFail($id);
 	});

 	//add contact 
 	Route::post('contact/store', function(Request $request){
 		return Contact::create(['name' =>$request->input(['name']), 'email' =>$request->input(['email']), 'phone' =>$request->input(['phone'])]);
 	});

 	//update contact
 	Route::patch('contact/{id}', function(Request $request){
 		return Contact::findOrFail()->update(['name' =>$request->input(['name']), 'email' =>$request->input(['email']), 'phone' =>$request->input(['phone'])]);
 	});

 	//delete
 	Route::delete('contact/delete/{id}', function( Request $request, $id){
 		return Contact::destroy($id);
 	});
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
