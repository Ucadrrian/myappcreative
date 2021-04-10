<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin()
    {
        return view('connect.login');
    }

    public function postLogin(Request $request){
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:8|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/'
        ];

        $messages=[
            'email.required' =>'Su correo electrónico es requerido.',
            'email.email' => 'El formato de su correo electrónico es invalido',
            'password.regex' => 'no se permiten expresiones regulares en la contraseña',
            'password.required' =>'Por favor escriba su contraseña.',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'se ha producido un error')->with(
                'typealert','danger');
        else:

            if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')],true)):
                 return redirect('/');
            else:
                return back()->with('message', 'Corrreo electrónico o contraseña erronia')->with('typealert','danger');
            endif;
        endif;

    }

    public function getRegister()
    {
        return view('connect.register');
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[ a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',
            'lastname' => 'required|regex:/^[ a-zA-ZáéíóúÁÉÍÓÚ ]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/',
            'cpassword' => 'required|min:8|same:password|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/'
            
        ];

        $messages = [
            
            'name.required' => 'Su nombre es requerido.',
            'name.regex' => 'no se permiten expresiones regulares para el nombre',
            'lastname.required'=>'Su apellido es requerido.',
            'lastname.regex' => 'no se permiten expresiones regulares para los apellidos',
            'email.required' =>'Su correo electrónico es requerido.',
            'email.email'=>'El formato de su correo electrónico es invalido',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' =>'Por favor escriba una contraseña.',
            'password.regex' => 'no se permiten expresiones regulares en la contraseña',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.regex' => 'no se permiten expresiones regulares en la contraseña',
            'cpassword. min' =>'La confirmación de la contraseña debe de tener al menos 8 caracteres.',
            'cpassword.same' => 'Las contraseñas no coinciden.'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)->with('message', 'se ha producido un error')->with(
                'typealert','danger');
        
        else:
            $user=new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));
            
            if($user->save()):
                return redirect('/login')->with('message', 'Su usuario se creo con éxito, ahora puede iniciar sesión')->with(
                    'typealert','success');
            endif;
        endif;
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }


}
