<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', ['title' => 'Sign Up']);
    }
    
    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:255|alpha',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|max:20'
            // bisa 2 cara, 1 pake array 1 lg pake cara laravel
        ]);

        // Hash manual
        // $validateData['password'] = Hash::make($validateData['password']);
        User::create($validateData);
        return redirect('/login')->with('success', 'Registration successfull! Please login!');
    }
}
