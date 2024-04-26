<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

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
      $todo->category_id =$request->category_id;//se pasa el id de la categoría
      $todo->save();///método que tienen todos los modelos para guardar la información en la base de datos

      //método para indicar a qué ruta retornará, y se configura un mensaje 
      return redirect()->route('todos')->with('success','Tarea creada correctamente');

    }//store

    public function index(){
      $todos = Todo::all(); //método estático que tiene el modelo para obtener toda la información
      $categories = Category::all();
      return view('todos.index',['todos'=> $todos,'categories'=>$categories]);
    }

    public function show($id){
      $todo = Todo::find($id);//busca un elemento del mododlo Todo por ID
      return view('todos.show',['todo'=> $todo]);//retornamos el elemento a la vista show
    }

    public function update(Request $request,$id){
      $todo = Todo::find($id);//busca un elemento del mododlo Todo por ID
      $todo->title = $request->title;//se le asigna al campo title del modelo todo el valor del campo title que viene del 
                                     ///formulario que se utilizó para actualizar la información
      //dd($request);//sirve para hacer un pequeño debur en las aplicaciones, y ver los elementos del request, o de los objetos 
                   //esto se ve en la página
      $todo->save();///método que tienen todos los modelos para guardar la información en la base de datos                                     
      //return view('todos.index',['success'=> 'Tarea actualizada']);
      return redirect()->route('todos')->with('success','Tarea actualizada');
    }

    public function destroy($id){
      $todo = Todo::find($id);//busca un elemento del mododlo Todo por ID
      $todo->delete();//método para eliminar el registro

      return redirect()->route('todos')->with('success','Tarea eliminada');

    }


  }