<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main\NewsCategories;
use App\Models\Main\NewsAndEvents;
use App\Models\Main\Tag;
use DB;

class AllNewsAndEventsController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {  
        $allcategories=NewsCategories::orderBy('name', 'DESC')->get();
        $allNewsEventDate= NewsAndEvents::select('event_date');
        $alltags = Tag::get();
        $where = [];
        $categoryId=$tagId=$year=$month=$isTag=$catdetail=$monthYear=$date=null;    
        if (!empty($request->slug)){
            $category = $request->slug;
            $cat= NewsCategories::where('slug',$category)->first(); 
            $categoryId =[$cat->id];
            
        }
        else{
            $catdetail= 1;
            $categoryId= NewsCategories::orderBy('id','desc')->pluck('id');
        }
              
        $tagName=NULL;
        if (!empty($request->tag)){
            $tag = $request->tag;
            $pro= Tag::where('slug',$tag)->first();
            $tagName = $pro->slug;
        } 
        
        if (!empty($request->date)){
            $year =date('Y',strtotime($request->date));
            $month =date('m',strtotime($request->date));
        }
    
        // Date & Tag
        if(empty($request->slug) && !empty($request->date) && !empty($request->tag)){
            $allPressRelease = NewsAndEvents::where('tag' , 'LIKE' , '%'.$tagName.'%')->whereMonth('event_date',$month)->whereYear('event_date',$year)->latest()->paginate(03);
        }
        // Tag
        elseif(empty($request->slug) && empty($request->date) && !empty($request->tag)){
            $allPressRelease = NewsAndEvents::where('tag' , 'LIKE' , '%'.$tagName.'%')->latest()->paginate(03);
        }
        // Category & Tag
        elseif(!empty($request->slug) && empty($request->date) && !empty($request->tag)){
            $allPressRelease = NewsAndEvents::where('tag' , 'LIKE' , '%'.$tagName.'%')->whereIn('news_categories_id',$categoryId)->latest()->paginate(03);
        }
        // Category & Date & Tag
        elseif(!empty($request->slug) && !empty($request->date) && !empty($request->tag)){
            $allPressRelease = NewsAndEvents::where('tag' , 'LIKE' , '%'.$tagName.'%')->whereMonth('event_date',$month)->whereYear('event_date',$year)->whereIn('news_categories_id',$categoryId)->latest()->paginate(03);
        }
        else{
            $allPressRelease = NewsAndEvents::whereIn('news_categories_id',$categoryId)
            ->where(function($q) use($year,$month,$tagName)
            {
                if (!empty($year) && !empty($month)) {
                    $q->whereMonth('event_date',$month)->whereYear('event_date',$year);
                }
            })->latest()->paginate(03);
        } 

        // dd(\DB::getQueryLog()); // Show results of log
    $allNewsEvents=NewsAndEvents::with(['newsCategories','tags'])->where($where)->orderBy('event_date', 'DESC')->latest()->take(4)->get();
    // dd( $allNewsEvents);
    $allNewsEventDate = $allNewsEventDate->groupBy(DB::raw('year(event_date) desc'),DB::raw('month(event_date) desc'))->take(40)->get();
   
    return view('Main.frontend.screens.all_news_and_events', compact('allNewsEvents','allcategories','allNewsEventDate','alltags','allPressRelease'))->with('i', ($request->input('page', 1) -1) * 20);
}
                                    
public function pressLiveSearch(Request $request){
    if($request->ajax())
    {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
            $data = NewsAndEvents::with(['newsCategories'])
            ->where(function($query) use($request){
                $query->where('news_and_events.name', 'like', '%' .$request->search. '%')
                ->orWhere('news_and_events.event_date', 'like', '%' .$request->search . '%')
                ->orWhere('news_categories.name', 'like', '%' .$request->search. '%')
                ;
            })
            ->leftJoin('news_categories','news_categories.id','=','news_and_events.news_categories_id')
            ->orderBy('news_and_events.id', 'DESC')
            ->whereNull('news_and_events.deleted_at')
            ->get();
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $image=$row->thumbnail;
                    $department=$row['departments']['title'];
                    $output .= '<div class="card lower_card h-100" id="search-news-cards">
                    <div class="low_card_pic text-center">
                    <div class="month">
                    <label>'.$row->event_date.'</label>
                    <label class="date">'.$row->event_date.'</label>
                    </div>
                    </div>
                    <div class="card-top-most-image"><img class="card-img-top img-fluid" src="'.$image.'" alt="news and events"></div>
                    <div class="card-block mt-3 mb-2 mx-3">
                    <i class="fa fa-map-marker markers"><span class="fas-text">The University of Faisalabad</span></i>
                    <i class="fa fa-university markers"><span class="fas-text">'.$department.'</span> </i>
                    <a class="text-decoration-none" href="press-release/'.$row->slug.'"><p class="card-text mb-4 mt-2">'.$row->short_description.'</p></a>
                    <p class="low_card-text pt-4 mb-2"><small class="text-muted"><a href="press-release/'.$row->slug.'">Read More<i class="fa fa-chevron-right ms-1"></i></a></small></p>
                    </div>
                    </div>';
                }
            }
            else
            {
                $output = '
                <div>
                <div align="center">No Data Found</div>
                </div>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );
            echo json_encode($data);
        }
    }
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    //
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
    //
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    //
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    //
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    //
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    //
}
}
