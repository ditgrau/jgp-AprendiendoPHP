<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{

    public function getAllTasks()
    {
        try {
            $tasks = Task::with('user')->get(); //hace referencia al modelo
            //With me saca la relacion con la tabla user (include)
            return response()->json([
                'message' => 'Tasks retrieved',
                'data' => $tasks
            ], Response::HTTP_OK); //PARA RESPONSE (libreria symfony)
        } catch (\Throwable $th) {
            Log::error('Error getting tasks ' . $th->getMessage());
            //log es una clase para que registra los errores, se almacenan en storage > log
            return response()->json([
                'message' => 'Error retrieving tasks'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTasksByUser($id)
    {
        try {
            $tasks = Task::where('user_id', $id)->get();

            return response()->json([
                'message' => 'Tasks retrieved',
                'data' => $tasks
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error getting tasks ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving tasks'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTasksByDescription($description)
    {
        try {
            $tasks = Task::where('description', 'like', '%' . $description . '%')->get();

            return response()->json([
                'message' => 'Tasks retrieved',
                'data' => $tasks
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error getting tasks ' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving tasks'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createTask(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'description' => 'required|string',
                'user_id' => 'required'
            ], [
                'description.required' => '¡Hace falta una descripción!',
                'description.string' => 'La descripción debe contener un texto',
                'user_id' => 'Hay un error con la clave de usuario'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $validData = $validator->validated();
            // esta es la mejor opcion para el create (post)
            // dd($request) para ver en postman si entra la request
            $task = Task::create([
                'description' => $validData['description'],
                'user_id' => $validData['user_id']
            ]);

    // esta opcion tenemos que conocerla porque la usaremos en el update 
            // $task = new Task; //modelo
            // $task-> description =$request -> input ('description');
            // $task-> description =$request -> input ('userId');
            // $task-> save();

    // DB::table('tasks')->insert(['description' => $request->input('description'), 'user_id'=>$request->input('user_id')]);

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
