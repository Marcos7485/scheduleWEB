<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Main extends Controller
{
    public function registro(){
        
        $bool = false;

        $data = [
            'menu' => $bool
        ];

        return view('session.register', $data);
    }

    public function login(){

        $bool = false;

        $data = [
            'menu' => $bool
        ];

        return view('session.login', $data);
    }

    public function welcome(){

        $bool = true;

        $data = [
            'menu' => $bool
        ];

        return view('welcome', $data);
    }

    public function dashboard(){

        
        $bool = false;

        $data = [
            'menu' => $bool
        ];


        return view('dashboard.main', $data);

    }
}
