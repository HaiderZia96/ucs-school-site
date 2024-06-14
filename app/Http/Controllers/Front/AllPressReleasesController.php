<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main\NewsCategories;
use App\Models\Main\NewsAndEvents;
use App\Models\Main\Tag;
use DB;

class AllPressReleasesController extends Controller
{
     public function index(Request $request)
     {
        //  return redirect('/news-and-events?slug=news-events');
     }
    // public function NewsDetail(Request $request , $slug)
    // {
    //     $allcategories=NewsCategories::orderBy('name', 'DESC')->get();
    //     $allNewsEvents=NewsAndEvents::with(['newsCategories'])->latest()->paginate(20);
    //     return view('Main.frontend.department_news_events', compact('allNewsEvents','allcategories'))->with('i', ($request->input('page', 1) -1) * 20);
    // }
    // public function tags(Request $request , $slug)
    // {
    //     $newseventtags=NewsAndEvents::Where('tag','like',"%{$slug}%")->paginate(4);
    //     $alltags = Tag::get();
    //     dd($alltags);
    //     $allNewsEvents=NewsAndEvents::with(['newsCategories'])->orderBy('tag', 'DESC')->latest()->paginate(04);
    //     $allcategories=NewsCategories::orderBy('name', 'DESC')->get();
    //     $allNewsEventDate= NewsAndEvents::select('event_date');
    //     $allNewsEventDate=NewsAndEvents::with(['newsCategories'])->orderBy('event_date', 'DESC')->groupBy(DB::raw('year(event_date) desc'),DB::raw('month(event_date) desc'))->take(12)->get();
    //     return view('Main.frontend.all_news_and_events_tag', compact('allNewsEvents','allcategories','alltags','newseventtags','allNewsEventDate'))->with('i', ($request->input('page', 1) -1) * 20);
    // }
}
