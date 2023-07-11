<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
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
                ], Response::HTTP_OK
            );
        } catch (\Throwable $th) {

        }
    }
}

//PARA RESPONSE (dependencias symfony)