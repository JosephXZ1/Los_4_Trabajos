<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

// 👇 El "Modelo" que representa a la tabla en la Base de Datos
use App\Models\Crud; 

class CrudsController extends Controller
{
    /**
     * 1. LEER (READ) - Endpoint: GET /api/cruds
     * Devuelve todos los registros guardados en la base de datos.
     */
    public function index()
    {
        // Trae absolutamente todo de la tabla 'cruds' y lo convierte en JSON
        return response(Crud::all()->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * 2. CREAR (CREATE) - Endpoint: GET /api/cruds/create
     * El tutorial usa este método raro para inventar un registro aleatorio cada vez que pulsas "Add".
     */
    public function create()
    {
        $crud = new Crud();
        
        // Inventamos un nombre aleatorio usando funciones nativas de PHP
        $crud->name = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 8);
        
        // Elegimos un color al azar entre 'red' o 'green'
        $crud->color = (rand(0, 1) === 1) ? 'red' : 'green';
        
        // Guardamos el nuevo "alien" en la base de datos SQLite
        $crud->save();

        // Le respondemos a tu Vue con el objeto que acabamos de crear en formato JSON
        return response($crud->jsonSerialize(), Response::HTTP_CREATED);
    }

    /**
     * 3. ACTUALIZAR (UPDATE) - Endpoint: PUT /api/cruds/{id}
     * Recibe el ID por la URL y el nuevo color dentro del cuerpo de la petición.
     */
    public function update(Request $request, $id)
    {
        // Busca el registro por su ID. Si no existe, frena todo y lanza un error 404.
        $crud = Crud::findOrFail($id);
        
        // Cambiamos el color viejo por el que mandaste desde tu Vue (ej: $request->color)
        $crud->color = $request->color;
        
        // Guardamos los cambios en la base de datos
        $crud->save();

        // Devolvemos un estado 200 (OK) sin texto, avisando que todo salió bien
        return response(null, Response::HTTP_OK);
    }

    /**
     * 4. ELIMINAR (DELETE) - Endpoint: DELETE /api/cruds/{id}
     * Borra el registro de la base de datos usando su ID.
     */
    public function destroy($id)
    {
        // Borra directamente el registro con ese ID de la tabla
        Crud::destroy($id);

        // Devolvemos un estado 200 (OK) para avisarle a Axios que ya fue eliminado
        return response(null, Response::HTTP_OK);
    }
}