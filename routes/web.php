<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return redirect()->route('projects.index');
});


Route::resource('projects', ProjectController::class);



Route::get('/issues/{issue}/comments', [CommentController::class, 'index'])
    ->name('comments.index');

Route::post('/issues/{issue}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');


Route::resource('issues', IssueController::class);

Route::post('/issues/{issue}/tags/{tag}', [IssueController::class, 'attachTag'])
    ->name('issues.tags.attach');

Route::delete('/issues/{issue}/tags/{tag}', [IssueController::class, 'detachTag'])
    ->name('issues.tags.detach');


Route::resource('tags', TagController::class)
    ->only(['index', 'store']);