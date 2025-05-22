<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StudentController::class, 'index']);

// GET /api/students — Get all students
// GET /api/students/{id} — Get single student
// POST /api/students — Add student
// PUT /api/students/{id} — Update student
// DELETE /api/students/{id} — Delete student


Route::get('/', [StudentController::class, 'index'])->name('students.index');

Route::prefix('api')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::post('/students', [StudentController::class, 'store'])->name('student.store');
    Route::delete('/students/{id}', [StudentController::class, 'delete'])->name('students.delete');

    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
});