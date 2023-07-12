<?php
// para crear un controller dentro de una carpeta 
// 'php artisan make:controller <'NombreCarpeta'>/<'NombreFuncion'>'
namespace App\Http\Controllers\TaskController;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CreateTask extends Controller
{
// si al crear el controller pongo en el comando --invocable, me crea la funcion __invoke
    public function __invoke(Request $request)
    // __invoke para llamar al controlador y que ejecute la funcion, no llamar a la funcion
    {
        try {

            $user = auth()->user(); // para sacar el id del token // !¡ añadir middle a la ruta 
// primero Validaciones 
            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
            ], [
                //para cada validacion, la llamamos como a la clave del objeto
                'description.required' => '¡Hace falta una descripción!',
                'description.string' => 'La descripción debe contener un texto',
            ]);
    //recojo los fallos
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
    //almaceno en la variable los datos validos
            $validData = $validator->validated();
    //a traves del modelo // con el metodo create 
            $task = Task::create([
                'description' => $validData['description'],
                'user_id' => $user->id //saco la id del token, del objeto $user
            ]);

            // DB::table('tasks')->insert(['description' => $request->input('description'), 'user_id'=>$request->input('user_id')]);
            // $task = new Task;
            // $task->description = $request->input('description');
            // $task->user_id = $request->input('user_id');
            // $task->save();

            return response()->json([
                'message' => 'Task created',
                'data' => $task
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error('Error creating task ' . $th->getMessage());

            return response()->json([
                'message' => 'Error creating task'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}