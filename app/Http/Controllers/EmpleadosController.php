<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\empleadosResource;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se obtienen todos los datos de la tabla de empleados y sepaginan
        return empleadosResource::collection(empleados::paginate('10'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        //Creamos el nuevo empleado
        $empleado = empleados::create([
            'nombre' => $request->nombre,
            'vales' => $request->vales,
            'id_rol' => $request->id_rol
        ]);
        //Devolvemos la respuesta con el token del empleado
        return response()->json([
            'message' => 'Empleado creado',
            'user' => $empleado
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($empleados)
    {
        //Bucamos el empleados
        $empleado = empleados::find($empleados);
        //Si el empleados no existe devolvemos error no encontrado
        if (!$empleado) {
            return response()->json([
                'message' => 'el empleado no existe.'
            ], 404);
        }
        //Si esta el empleados lo devolvemos
        return $empleado;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $empleados)
    {
         //Buscamos el empleado
         $empleado = empleados::findOrfail($empleados);
         //Actualizamos el empleado.
         $empleado->update([
            'nombre' => $request->nombre,
            'vales' => $request->vales,
            'id_rol' => $request->id_rol
         ]);
         //Devolvemos los datos actualizados.
         return response()->json([
             'message' => 'Se actualizo correctamente',
             'data' => $empleado
         ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($empleados)
    {
        //Buscamos el empleadoso
        $empleados = empleados::findOrfail($empleados);
        //Eliminamos el empleadoso
        $empleados->delete();
        //Devolvemos la respuesta
        return response()->json([
            'message' => 'Se elimino correctamente'
        ], 200);
    }
}
