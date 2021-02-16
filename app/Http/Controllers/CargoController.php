<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cargo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \QrCode::size(100)->format('svg')->generate($request['name'],'../public/img/'. $request['name'] .'.svg');
        Cargo::create([
            'name' => $request['name'],
            'cargo_code' => $request['cargo_code'],
            'cargo_status' => $request['cargo_status'],
            'official_address' => $request['official_address'],
            'cargo_description' => $request['cargo_description'],
            'contact_person' => $request['contact_person'],
            ]);
            return redirect('home');
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Cargo  $cargo
         * @return \Illuminate\Http\Response
         */
    public function show(Request $request)
    {
        $cargo_code = $request->cargo_code;
        $cargo = Cargo::where('cargo_code', $cargo_code)->pluck('cargo_status');

        return view('cargo_status', compact('cargo', 'cargo_code'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        \QrCode::size(100)->format('svg')->generate($request['name'],'../public/img/'. $request['name'] .'.svg');

        return view('cargo_status', compact('cargo', 'cargo_code'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        //
    }
    public function view(Request $request){
        $cargo = $request->cargo;
        $details = DB::table('cargos')
                ->where('cargo_code',$request->cargo_code)->get();

        return view('cargo_status', compact('details','cargo'));
    }
    public function search(Request $request){

        if($request->ajax()) {

            $data = Cargo::where('name', 'LIKE', $request->name.'%')
                ->get();

            $output = '';

            if (count($data)>0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row){

                    $output .= '<li class="list-group-item">'.$row->name.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }

            return $output;
        }
    }
}
