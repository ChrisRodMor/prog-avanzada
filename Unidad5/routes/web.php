<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

Route::get('/users/show', [UserController::class, 'show'])->name('users.show');

Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');


Route::get('/sumar/{n1}/{n2}', function($n1, $n2) {
    return "suma: " . $n1 . " + " . $n2 . " = " . ($n1 + $n2);
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);

Route::get('/restar/{n1}/{n2}', function($n1, $n2) {
    return "resta: " . $n1 . " - " . $n2 . " = " . ($n1 - $n2);
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);

Route::get('/multiplicar/{n1}/{n2}', function($n1, $n2) {
    return "multiplicación: " . $n1 . " * " . $n2 . " = " . ($n1 * $n2);
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);

Route::get('/dividir/{n1}/{n2}', function($n1, $n2) {
    if ($n2 == 0) {
        return "Error: no se puede dividir por cero.";
    }
    return "división: " . $n1 . " / " . $n2 . " = " . ($n1 / $n2);
})->where(['n1' => '[0-9]+', 'n2' => '[0-9]+']);


Route::get('/saludar/{name}/{lastname?}', function($name, $lastname = "N/A") {
    return "Hola, " . $name . " " . $lastname;
})->where('name', '[a-z]+');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
