<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarroRequest;
use App\Models\Carro;
use Illuminate\Http\Request;

class CarroController extends BaseController
{
    protected $carro = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carros = $this->carro->with('Marca')->paginate(10);

        return $this->sendResponse($carros, 'Lista de Carros');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarroRequest $request)
    {

        $resp= $this->carro->create($request->all());

        return $this->sendResponse($resp, 'Carro inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function show(Carro $carro)
    {
        $carro =  $this->carro::findOrFail($carro);
        return $this->sendResponse($carro, 'Info do carro');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function update(CarroRequest $request, $carro)
    {
        $carro = $this->carro->findOrFail($carro);
        $resp= $carro->update($request->all());

        return $this->sendResponse($resp, 'Carro editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */
    public function destroy( $carro)
    {
        $carro = $this->carro->findOrFail($carro);
        $resp= $carro->delete();

        return $this->sendResponse($resp, 'carro deletado com sucesso!');
    }
}
