<?php

use App\Services\TaskService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'statuses' =>  TaskService::STATUS_MAP,
    ]);
});
