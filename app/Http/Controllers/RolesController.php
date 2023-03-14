<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se obtienen todos los datos de la tabla de roles y sepaginan
        return roles::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        //Creamos el nuevo rol
        $rol = roles::create([
            'nombre' => $request->nombre,
            'salario_hora' => $request->salario_hora,
            'bono' => $request->bono,
            'jornada' => $request->jornada,
            'dias' => $request->dias,
            'pago_entrega' => $request->pago_entrega
        ]);
        //Devolvemos la respuesta con el token del rol
        return response()->json([
            'message' => 'rol creado',
            'user' => $rol
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $roles)
    {
         //Buscamos el rol
         $rol = roles::findOrfail($roles);
         //Actualizamos el rol.
         $rol->update([
            'nombre' => $request->nombre,
            'salario_hora' => $request->salario_hora,
            'bono' => $request->bono,
            'jornada' => $request->jornada,
            'dias' => $request->dias,
            'pago_entrega' => $request->pago_entrega
         ]);
         //Devolvemos los datos actualizados.
         return response()->json([
             'message' => 'Se actualizo correctamente',
             'data' => $rol
         ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roles)
    {
        //Buscamos el roleso
        $roles = roles::findOrfail($roles);
        //Eliminamos el roleso
        $roles->delete();
        //Devolvemos la respuesta
        return response()->json([
            'message' => 'Se elimino correctamente'
        ], 200);
    }
}
