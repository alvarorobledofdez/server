<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = getallheaders();
        $token = $headers['Authorization'];
        $key = $this->key;
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));

        if ($this->checkLogin($tokenDecoded->email , $tokenDecoded->password))
        {
            $categories = $this->usersCategories($tokenDecoded->id);
            return $this->success('Categorias creadas por este usuario: ', $categories);
        }
        else
        {
            return $this->error(403, 'No tienes permisos');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $headers = getallheaders();
        $token = $headers['Authorization'];
        $key = $this->key;
        $tokenDecoded = JWT::decode($token, $key, array('HS256'));

        if ( !isset($_POST['name']))
        {
            return $this->error(400, 'Debes rellenar todos los campos');
        }

        $name = $_POST['name'];
        $trimmedName = trim($name);
        
        if ($this->checkLogin($tokenDecoded->email , $tokenDecoded->password)) 
        { 
            if (!strpos($trimmedName, " "))
            {
                try
                {
                    $category = new Category();
                    $category->name = $request->name;
                    $category->id_users = $tokenDecoded->id;
                    $category->save();
                }
                catch(Exception $e)
                {
                    return $this->error(402, $e->getMessage());
                }
                return $this->error(200, 'Categoria creada');
            }
            else
            {
                return $this->error(401, 'Parametros no correctos');
            }
            
        }
        else
        {
            return $this->error(403, 'No tienes permisos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    private function usersCategories($id)
    {
        return Category::where('id_users', $id)->get();
    }
}
