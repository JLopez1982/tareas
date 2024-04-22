<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los elementos
     * store para guardar la información
     * update para modificar la información
     * destroy para eliminar la información
     * edit para mostar el formulario de edición
     * 
     */

     public function store(Request $request){//store
      //se valida el campo title para que sea requerido y mínimo sea de 3 caracteres
      $request->validate([
        'title' => 'required|min:3'
      ]);

      //después declaramos una varialbe que será del modelo que queramos manipular 
      $todo = new Todo;
      //y sobre esa variable llenamos los campos para que se almacenen en la base de datos.
      //la variable request obtendrá la información del formulario html que se creó para insertar los valores
      $todo->title = $request->title;
      $todo->save();///método que tienen todos los modelos para guardar la información en la base de datos

      //método para indicar a qué ruta retornará, y se configura un mensaje 
      return redirect()->route('todos')->with('success','Tarea creada correctamente');

    }//store

    public function index(){
      $todos = Todo::all(); //método estático que tiene el modelo para obtener toda la información
      return view('todos.index',['todos'=> $todos]);
    }
}