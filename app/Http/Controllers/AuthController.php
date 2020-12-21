<?php

namespace App\Http\Controllers;

use App\Repository\RegisterRepository;
use App\Http\request\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function showFormRegister()
    {
        return view('register');
    }

    public function register(RegisterRequest $request, RegisterRepository $registerRepository)
    {
        $input = $request->validated();
        $registerRepository->save($input);
        return redirect()->route('login');
    }

    public function showFormLogin()
    {
        return view('login');
    }

    public function login(RegisterRequest $request)
    {
        $input = $request->validated();

        if (Auth::attempt($input)) {
            return redirect()->route('home');
        } else {
            $errors = new MessageBag();
            $errors->add('login_error', 'Incorrect password');
            return redirect()->route('login')->withErrors($errors);
        }

    }

}
