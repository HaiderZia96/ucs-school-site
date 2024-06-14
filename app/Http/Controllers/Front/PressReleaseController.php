<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main\NewsAndEvents;

class PressReleaseController extends Controller
{
    public function index(){
        $newsEvents=NewsAndEvents::with(['newsCategories'])->orderBy('id','desc')->take(3)->get();
        return view('Main.frontend.screens.press_release_detail',compact('newsEvents'));
    }
}
