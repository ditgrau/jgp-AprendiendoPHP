<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function getAllTasks(){
        try {
            $tasks = Task::get(); //hace referencia al modelo

            return response()->json(
                [
                    'message'=> 'Tasks retrieved',
                    'data'=> $tasks
                ], Response::HTTP_OK //PARA RESPONSE (libreria symfony)
            );
        } catch (\Throwable $th) {
            Log::error('error getting tasks' . $th->getMessage());

            return response()->json([
                'message' => 'Error retrieving tasks'
            ], response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

