<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function funListar()
    {
        //SQL
        //$usuarios = DB::select("SELECT * from users");
        //Query Buider
        //$usuarios = DB::table("users")->select("name")->get();
        //Eloquent ORM
        $usuarios = User::get(); //no debuelve la contraseña
        return $usuarios;
    }

    public function funGuardar(Request $request)
    {
        $nombre = $request->name;
        $correo = $request->email;
        $password = $request->password;

        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->email = $correo;
        $usuario->password = $password;
        $usuario->save();

        return ["mensaje" => "Usuario Registrado en la BD"];
    }

    public function funMostrar($id)
    {
        $usuario = User::findOrFail($id); //440 si no encuentra findOrFail
        return response()->json($usuario, 200);
    }

    public function funModificar(Request $request, $id)
    {
        $nombre = $request->name;
        $correo = $request->email;
        $password = $request->password;

        $usuario = User::findOrFail($id); //440 si no encuentra findOrFail
        $usuario->name = $nombre;
        $usuario->email = $correo;
        $usuario->password = $password;
        $usuario->update();

        return response()->json(["mensaje" => "Usuario Actualizado"], 201);
    }

    public function funEliminar($id)
    {
        $usuario = User::findOrFail($id); //440 si no encuentra findOrFail
        $usuario->delete();
        return response()->json(["mensaje" => "Usuario Eliminado"], 200);
    }
}
