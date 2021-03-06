<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presupuesto;
use App\Models\HistorialPresupuesto;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historiales = HistorialPresupuesto::paginate(10);
        return view('PRESUPUESTOS.historialPresupuestos', compact('historiales'));
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
        $presupuesto = new Presupuesto($request->all());
        $presupuesto->monto_disponible = $request->monto;
        $presupuesto->estado = true;
        $presupuesto->gestion = Date('Y');
        $presupuesto->save();
        return redirect()->route('unidades.lista')->with('confirm', 'Se asigno el presupuesto correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        Presupuesto::where('id', $id)->update(['estado' => false]);
        return redirect()->route('presupuestos.index');
    }
    
    public function disableAll()
    {
        $presupuestos = Presupuesto::where('gestion', Date('Y'))->where('estado', true)->get();
        foreach ($presupuestos as $presupuesto) {
            $presupuesto->update(['estado' => false]);
        }
        return redirect()->route('presupuestos.index');
    }
}
