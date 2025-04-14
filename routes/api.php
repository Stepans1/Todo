<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/get-tasks', [TaskController::class, 'getTasks']);

Route::get('/save-task', [TaskController::class, 'saveTask']);

Route::get('/delete', [TaskController::class, 'delete']);

Route::get('/change-status', [TaskController::class, 'changeStatus']);