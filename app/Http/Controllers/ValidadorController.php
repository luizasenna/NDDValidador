<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\FrontendRequest;


class ValidadorController extends Controller
{
    public function faltantesNfe(){

        $di = Request::input('datainicial');
        $loja = Request::input('loja');
        return view('faltantesNfe',[
            'di' => $di,
            'loja' => $loja
        ]);
    }

    public function inutil(){

        return view('inutilSaci');
    }
}
