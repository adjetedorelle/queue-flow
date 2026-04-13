<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
    {
        $nom="Dodo";
        $age=19;
        $message="Tu progesses bien en laravel !";
        return view('acceuil', compact('nom', 'age','message'));
    } 
}
  