<?php

use App\Http\Controllers\TaskController; //importacion
use App\Http\Controllers\TaskController\CreateTask;
// use App\Http\Controllers\TaskController\GetTaskByUser;
use App\Http\Controllers\TaskController\getTasksByDescription;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController\GetAllTasks;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('/user/{id}', function($id){

// estos dos devuelven arrays:
    // $user = DB::table('users')->where('id', $id)->get(); //este llama a la tabla de la bd
    // $user = User::where('id', $id)->get(); //llama al modelo
// si en el modelo he hecho alguna exclusion, con la segunda opcion, la primera me lo trae TODO a lo bruto desde la BD 

// estos dos devuelven objetos json:
    $user = User::find($id);
    // $userFirst = User::where('id', $id)->first(); // devuelve el primero que encuentra

    return $user;
});

// CONTROLADORES DE TASKS

Route::get('/tasks', GetAllTasks::class);
Route::get('/tasks/{id}', GetTaskByUser::class);
Route::get('/tasks/description/{description}', getTasksByDescription::class);
Route::post('/tasks', CreateTask::class);
Route::put('/tasks', [TaskController::class, 'updateTask']);
Route::delete('/tasks', [TaskController::class, 'deleteTask'])->middleware('auth:sanctum'); 
// middleware('auth:sanctum'); para todos los endpoints que usan el token 

// get (findAll), find (findOne(pk))

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// CONTROLADORES DE AUTENTICACIÓN

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

// CONTROLADORES DE USUARIO

Route::delete('/user/delete', [UserController::class, 'deleteMyAccount'])->middleware('auth:sanctum');
Route::post('/user/{id}', [UserController::class, 'restoreAccount']);