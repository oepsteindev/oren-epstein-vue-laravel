<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
use Illuminate\Http\Request;
use App\Thumb;
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


