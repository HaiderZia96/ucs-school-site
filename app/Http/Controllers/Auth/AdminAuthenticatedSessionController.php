<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthenticatedSessionController extends Controller
{
  
    public function index()
    {
        return redirect()->intended(route('dashboard'));
    }
   
}
