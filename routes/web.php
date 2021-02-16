<?php

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Validator;

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

Route::get('/search', [App\Http\Controllers\CargoController::class, 'search'])->name('search');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add_cargo', [App\Http\Controllers\CargoController::class, 'index'])->name('add_cargo');
Route::post('/view-search', [App\Http\Controllers\CargoController::class, 'show'])->name('view-search');
Route::post('/save_cargo', [App\Http\Controllers\CargoController::class, 'store'])->name('save_cargo');
Route::post('/saveItem', [App\Http\Controllers\CargoController::class, 'update'])->name('saveItem');
Route::post('/new-cargo', function(Request $request){
    if($request->ajax())
    {
        $rules = array (
            'name' => 'required',
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                    'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        else {
            \QrCode::size(100)->format('svg')->generate($request['name'],'../public/img/'. $request['name'] .'.svg');
            $data = new Cargo;
            $data->name = $request->name;
            $data->cargo_code = $request->cargo_code;
            $data->cargo_status = $request->cargo_status;
            $data->cargo_description = $request->cargo_description;
            $data->official_address = $request->official_address;
            $data->contact_person = $request->contact_person;
            $data->save();

            return response()->json ( $request );
        }
    }
});
Route::post('/updateItem', function(Request $request){
    if($request->ajax())
    {
        $data =  Cargo::find($request->id);
        $data->name = $request->name;
        $data->cargo_code = $request->cargo_code;
        $data->cargo_status = $request->cargo_status;
        $data->cargo_description = $request->cargo_description;
        $data->official_address = $request->official_address;
        $data->contact_person = $request->contact_person;
        $data->save();

        return response()->json ( $request );
    }
    return redirect('home');
});
Route::post('/deleteItem', function (Request $request) {
    if($request->ajax())
    {
        Cargo::find ( $request->id )->delete ();
        return response ()->json ();
    }
} );

Route::get('qrcode', function () {
    QrCode::size(100)->format('svg')->generate('A basic example of QR code!','../public/img/qrcode.svg');
    return QrCode::size(100)->generate('A basic example of QR code!');
});

