<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/saludar/{nombre}', function ($nombre) {
return "¡Hola, $nombre!";
});

Route::get('operacion/{tipo}/{n1}/{n2}', function($tipo, $n1, $n2) {
    $resultado = 0;

    switch ($tipo) {
        case 'suma':
            $resultado = $n1 + $n2;
            break;
        case 'resta':
            $resultado = $n1 - $n2;
            break;
        case 'multiplicacion':
            $resultado = $n1 * $n2;
            break;
        case 'division':
            if ($n2 != 0) {
                $resultado = $n1 / $n2;
            } else {
                return "Error: No se puede dividir entre 0.";
            }
            break;
        default:
            return "Error: Operación no válida. Usa 'suma', 'resta', 'multiplicacion' o 'division'.";
    }

    return "Resultado: " . $resultado;
})

->where('tipo', 'suma|resta|multiplicacion|division') 
->where('n1', '[0-9]+') 
->where('n2', '[0-9]+'); 

require __DIR__.'/auth.php';
