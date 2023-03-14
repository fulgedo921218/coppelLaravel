<?php

namespace App\Http\Controllers;

use App\Models\entregas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntregasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Se obtienen todos los datos de la tabla de entregas y sepaginan
        return entregas::join('empleados', 'empleados.id', '=', 'entregas.id_empleado')
        ->join('roles', 'roles.id', '=', 'empleados.id_rol')
        ->select('empleados.nombre as nombre_empleado','empleados.vales as porcentaje_vales'
        ,'roles.nombre as nombre_rol', 'roles.salario_hora as salarioPorHora',
        'roles.bono','roles.jornada','roles.dias','roles.jornada','roles.pago_entrega as pagoPorEntrega', 
        DB::raw('(roles.jornada * roles.salario_hora) as pagoPorDia'), DB::raw('(roles.jornada * roles.salario_hora) * roles.dias as pagoPorSemana'),
        DB::raw('(roles.jornada * roles.salario_hora) * (roles.dias * 4) as pagoPorMes'), 'entregas.*')
        ->paginate('10');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        //Creamos el nuevo entrega
        $entrega = entregas::create([
            'id_empleado' => $request->id_empleado,
            'entregas' => $request->entregas,
            'pago_total' => $request->pago_total,
            'fecha_entrega' => $request->fecha_entrega,
        ]);
        //Devolvemos la respuesta con el token del entrega
        return response()->json([
            'message' => 'entrega registrada',
            'user' => $entrega
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($entregas)
    {
        //Bucamos el entregas
        $entrega = entregas::where('id_empleado',$entregas)->paginate();
        //Si el entregas no existe devolvemos error no encontrado
        if (!$entrega) {
            return response()->json([
                'message' => 'la entrega no existe.'
            ], 404);
        }
        //Si esta el entregas lo devolvemos
        return $entrega;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $entregas)
    {
         //Buscamos el entrega
         $entrega = entregas::findOrfail($entregas);
         //Actualizamos el entrega.
         $entrega->update([
            'id_empleado' => $request->id_empleado,
            'entregas' => $request->entregas,
            'pago_total' => $request->pago_total,
            'fecha_entrega' => $request->fecha_entrega,
         ]);
         //Devolvemos los datos actualizados.
         return response()->json([
             'message' => 'Se actualizo correctamente',
             'data' => $entrega
         ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($entregas)
    {
        //Buscamos el entregaso
        $entregas = entregas::findOrfail($entregas);
        //Eliminamos el entregaso
        $entregas->delete();
        //Devolvemos la respuesta
        return response()->json([
            'message' => 'Se elimino correctamente'
        ], 200);
    }
}
