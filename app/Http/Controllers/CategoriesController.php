<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); //método estático que tiene el modelo para obtener toda la información
        return view('categories.index',['categories'=> $categories]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Se validan los campos de la categoría
        $request->validate([
            'name'=> 'required|unique:categories|max:255',
            'color'=> 'required|max:7'
        ]);
      //después declaramos una varialbe que será del modelo que queramos manipular 
      $category = new Category;
      //y sobre esa variable llenamos los campos para que se almacenen en la base de datos.
      //la variable request obtendrá la información del formulario html que se creó para insertar los valores
      $category->name = $request->name;
      $category->color = $request->color;
      $category->save();///método que tienen todos los modelos para guardar la información en la base de datos

      //método para indicar a qué ruta retornará, y se configura un mensaje 
      return redirect()->route('categories.index')->with('success','Categoría creada correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::find($id);//busca un elemento del modelo Category por ID
        return view('categories.show',['category'=> $category]);//retornamos el elemento a la vista show
  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
       
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);//busca un elemento del modelo Category por ID
        $category->name = $request->name;
        $category->color = $request->color;
        $category->save();///método que tienen todos los modelos para guardar la información en la base de datos

        //método para indicar a qué ruta retornará, y se configura un mensaje 
      return redirect()->route('categories.index')->with('success','Categoría actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::find($id);//busca un elemento del mododlo Todo por ID
        $category->todos()->each( function($todo){
            $todo->delete();
        });

        $category->delete();//método para eliminar el registro
  
        return redirect()->route('categories.index')->with('success','Categoría eliminada');
  
    }
}
