<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
                        

Route::get('/', function () {
    return view('welcome');
});
    
Route::get('/saludos', function () {
    return view('app');
});
    
Route::get('/tareas', [TodosController::class,'index'])->name('todos');

 //método post para cuando se envían datos de un formulario , ahí se especifica el método que en este caso es store 
 //es importante que en el controlador se ponga en forma de arreglo para especificar el método
 //también se especifica el nombre de la ruta con la propiedad name, esto es funcional cuando se las rutas, y en el 
 //name no se movería
Route::post('/tareas',[TodosController::class,'store'])->name('todos');
