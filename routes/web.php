<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('projects.index');
});

Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class);