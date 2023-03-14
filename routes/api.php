<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController as Empleados;
use App\Http\Controllers\RolesController as Roles;
use App\Http\Controllers\EntregasController as Entregas;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('empleados', Empleados::class);
Route::apiResource('roles', Roles::class);
Route::apiResource('entregas', Entregas::class);