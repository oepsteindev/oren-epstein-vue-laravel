<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
use Illuminate\Http\Request;
use App\Thumb;
use App\Description;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/thumb', function(){
	return Thumb::latest()->orderBy('thumb_order', 'asc')->get();
});

Route::get('/thumb/{bu}', function(Request $request, $bu){
//return Thumb::latest()->orderBy('thumb_order', 'asc')->get();
	return Thumb::latest()->where('unit', '=', $bu)->orderBy('thumb_order', 'asc')->get();
	//return Thumb::whereUnit($bu)->get();

});

Route::get('profile/{bu}', function(Request $request, $bu){

	return DB::table('thumbs')
            ->leftJoin('description', 'description.unit', '=', 'thumbs.unit')
            ->where ('description.unit', '=', $bu)
            ->get();
});

Route::get('/testimonials', function(){

	return DB::table('testimonials')->get()->toArray();

});

//for react api

Route::get('/thumblist', function(){
	return Thumb::latest()->orderBy('thumb_order', 'asc')->get();
});

Route::get('/full/{search}', function(Request $request, $search){
	//DB::statement('ALTER TABLE description ADD FULLTEXT fulltext_index (id, description, skills, title, unit)');
	//return Description::whereRaw('MATCH (skills) AGAINST (?)' , array($search))->get();

	return DB::table('descriptions')
            ->leftJoin('thumbs', 'thumbs.unit', '=', 'descriptions.unit')
            ->whereRaw('MATCH (skills) AGAINST (?)' , array($search))
            ->get();

	//return Thumb::latest()->orderBy('thumb_order', 'asc')->get();
});

Route::get('/all', function(Request $request){


	return DB::table('descriptions')->orderByRaw('thumb_order asc')
            ->leftJoin('thumbs', 'thumbs.unit', '=', 'descriptions.unit')
            ->get();

});


Route::get('/thumblist/{bu}', function(Request $request, $bu){
	return Thumb::latest()->where('unit', '=', $bu)->orderBy('thumb_order', 'asc')->get();
});


