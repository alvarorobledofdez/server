<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (!isset($_POST['name']) or !isset($_POST['email']) or !isset($_POST['password'])) 
        {
            return $this->error(1, 'No puede haber campos vacíos');
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!empty($name) && !empty($email) && !empty($password))
        {
            try
            {
                $users = new User();
                $users->name = $name;
                $users->password = $password;
                $users->email = $email;
                $users->save();
            }
            catch(Exception $e)
            {
                return $this->error(2, $e->getMessage());
            }
            
            return $this->error(0, 'Usuario registrado');
        }
        else
        {
            return $this->error(1, 'No puede haber campos vacíos');
        }
    }

    private function error($code, $message)
    {
        $json = ['code' => $code, 'message' => $message];
        $json = json_encode($json);
        return  response($json, 200)->header('Access-Control-Allow-Origin', '*');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
