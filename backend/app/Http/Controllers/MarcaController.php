<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class MarcaController extends BaseController
{
    protected $marcas = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Marca $marcas)
    {
        $this->marcas = $marcas;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas =  $this->marcas::all();
        return $this->sendResponse($marcas, 'Lista de marcas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {

        $resp= $this->marcas->create($request->all());

        return $this->sendResponse($resp, 'Marca inserida com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($marca)
    {
        $marcas =  $this->marcas::findOrFail($marca);
        return $this->sendResponse($marcas, 'Info de marca');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request,$marca)
    {
        $marca = $this->marcas->findOrFail($marca);
        $resp= $marca->update($request->all());

        return $this->sendResponse($resp, 'Marca editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $marca)
    {
        $marca = $this->marcas->findOrFail($marca);
        $resp= $marca->delete();

        return $this->sendResponse($resp, 'Marca deletada com sucesso!');
    }

}
