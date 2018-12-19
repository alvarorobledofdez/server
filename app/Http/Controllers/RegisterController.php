<?php

namespace App\Http\Controllers;

use App\Register;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        if (!isset($_POST['name']) or !isset($_POST['email']) or !isset($_POST['password'])) 
        {
            return $this->error(400, 'Debes rellenar todos los campos');
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $trimmedName = trim($name);

        if (!empty($trimmedName) and !empty($email) and !empty($password))
        {
            if (strlen($password) >= 8 and !strpos($trimmedName, " "))
            {
                try
                {
                    $users = new User();
                    $users->name = $trimmedName;
                    $users->password = $password;
                    $users->email = $email;
                    $users->id_rols = '2';
                    $users->save();
                }
                catch(Exception $e)
                {
                    return $this->error(402, $e->getMessage());
                }
            
                return $this->error(200, 'Registro completo');
            }
            else
            {
                return $this->error(401, 'Parametros no correctos');
            }
        }
        else
        {
            return $this->error(401, 'Debes rellenar todos los campos');
        }
    }
}
