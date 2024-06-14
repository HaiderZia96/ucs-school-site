<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Main\AcademicCalendar;
use App\Models\Main\Popup;
use App\Models\Main\Prospectus;
use Illuminate\Http\Request;
use App\Models\Main\NewsAndEvents;
use App\Models\Main\NewsCategories;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $newsandevents = NewsAndEvents::orderBy('event_date', 'DESC')->latest()->paginate(4);
        $categories = NewsCategories::orderBy('id','desc')->get();
        $popups=Popup::where('status',1)->whereNull('deleted_at')->orderBy('position', 'asc')->get();
    //   dd($newsandevents);
        return view(('Main.frontend.index'),compact('newsandevents','categories','popups'));
    }
    //Prospectus
    public function prospectus(){
        $prospectuses = Prospectus::where('status',1)->orderBy('order','asc')->get();
        return view('Main.frontend.screens.prospectus',compact('prospectuses'));
    }
    public function getProspectusImage($slug)
    {
        $prospectus = Prospectus::where('slug',$slug)->first();
        $file = 'Prospectus/Image/' . $prospectus->image;
        if (Storage::disk('public')->exists($file)) {
            $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            $file = $storagePath . $file;
            return Response::file($file);
        }
    }
    public function downloadProspectus($slug)
    {
        $prospectus = Prospectus::where('slug',$slug)->first();
        $preProspectus = 'Prospectus/'.$prospectus->prospectus;
        if (Storage::disk('public')->exists($preProspectus)) {
            //View Only
            $storagePath   = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            $file = $storagePath.$preProspectus;
            return Response::file($file);

            //Download File
            //return Storage::disk('public')->download($preProspectus, $prospectus->slug.'.pdf');
        }
    }
    //Calendar
    public function calendar(){
        $calendars = AcademicCalendar::where('status',1)->where('archived',2)->orderBy('order','asc')->get();
        $archivedCalendars = AcademicCalendar::where('status',1)->where('archived',1)->orderBy('order','asc')->take(5)->get();
        return view('Main.frontend.screens.calendar',compact('calendars','archivedCalendars'));
    }
    public function getCalendarImage($slug)
    {
        $calendar = AcademicCalendar::where('slug',$slug)->first();
        $file = 'Calendar/Image/' . $calendar->image;
        if (Storage::disk('public')->exists($file)) {
            $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            $file = $storagePath . $file;
            return Response::file($file);
        }
    }
    public function downloadCalendar($slug)
    {
        $calendar = AcademicCalendar::where('slug',$slug)->first();
        $preCalendar = 'Calendar/'.$calendar->calendar;
        if (Storage::disk('public')->exists($preCalendar)) {
            //View Only
            $storagePath   = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            $file = $storagePath.$preCalendar;
            return Response::file($file);
        }
    }
}
