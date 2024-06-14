<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Main\NewsAndEvents;

class NewsAboutController extends Controller
{
    public function aboutNews(){
        $newsEventsAbout=NewsAndEvents::take(3)->orderBy('id', 'DESC')->get();
        return view('Main.frontend.screens.about_school',compact('newsEventsAbout'));
    }
}
