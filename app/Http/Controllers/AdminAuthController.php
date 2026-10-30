<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Afficher la page de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traiter le login et valider email & password
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) { // Wla guard('admin') ila darna guard khas
            $request->session()->regenerate();
            return redirect()->intended('/admin/boules-de-neige')->with('success', 'Bienvenue dans le panneau d’administration !');
        }

        return back()->withErrors([
            'email' => 'Les informations d’identification fournies ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}