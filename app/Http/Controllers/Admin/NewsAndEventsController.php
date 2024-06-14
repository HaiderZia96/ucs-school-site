<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main\NewsCategories;
use App\Models\Main\NewsAndEvents;
use App\Models\Main\Tag;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\File;

class NewsAndEventsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:news-and-events-list');
        $this->middleware('permission:news-and-events-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-and-events-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-and-events-delete', ['only' => ['delete']]);
        $this->middleware('permission:news-and-events-restore', ['only' => ['restore']]);
        $this->middleware('permission:news-and-events-softdelete', ['only' => ['destroy']]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Main.backend.News&Events.index');
    }

    public function getNewsAndEvents(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records

        $totalRecords = NewsAndEvents::with('newsCategories','tags')
                ->select('count(*) as allcount')
                ->withTrashed()
                ->leftJoin('news_categories','news_categories.id','=','news_and_events.news_categories_id')
                ->where(function($q) use($searchValue){
                    $q->where('news_and_events.name', 'like', '%' .$searchValue . '%')
                    ->orWhere('news_and_events.event_date', 'like', '%' .$searchValue . '%')
                    ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%');
                })
                ->orderBy('id', 'DESC')
                ->count();


        $totalRecordswithFilter = NewsAndEvents::with('newsCategories','tags')
            ->select('count(*) as allcount')
            ->withTrashed()
            ->leftJoin('news_categories','news_categories.id','=','news_and_events.news_categories_id')
            ->where(function($q) use($searchValue){
                $q->where('news_and_events.name', 'like', '%' .$searchValue . '%')
                ->orWhere('news_and_events.event_date', 'like', '%' .$searchValue . '%')
                ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%');
            })
            ->orderBy('id', 'DESC')
            ->count();
        // Fetch records
        $records = NewsAndEvents::with('newsCategories','tags')
            ->orderBy($columnName,$columnSortOrder)
            ->withTrashed()
            ->leftJoin('news_categories','news_categories.id','=','news_and_events.news_categories_id')
            ->where(function($q) use($searchValue){
                $q->where('news_and_events.name', 'like', '%' .$searchValue . '%')
                ->orWhere('news_and_events.event_date', 'like', '%' .$searchValue . '%')
                ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%');
            })
            ->select('news_and_events.*')
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();
        // dd($records);
        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $tag = $record->tag;
            $thumbnail = $record->thumbnail;
            $date = $record->event_date;
            $categories = $record->newsCategories->name;
            $deleted_at = $record->deleted_at;
            if($record->deleted_at == Null){
                $deleted_at = '0';
            }
            if($record->deleted_at != Null){
                $deleted_at = '1';
            }

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "thumbnail" => $thumbnail,
                "tag" => $tag,
                "event_date" => $date,
                "news_categories_id" => $categories,
                "deleted_at" => $deleted_at,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsCategories = NewsCategories::get();
        $newstag = Tag::get();
        $createNewsEvents = NewsAndEvents::with(['newsCategories','tags'])->withTrashed()->get();
        return view('Main.backend.News&Events.create', compact('createNewsEvents','newsCategories','newstag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;

        $slug = $this->createSlug($request->name);
        $data['slug']= $slug;

        $gettags = $request->tag;
        if(isset($request->tag)){
        foreach($gettags as $gettag){
            $selectarray[] = $gettag;
        }

        $selecttag = implode(',', $selectarray);
        $data['tag'] = $selecttag;
        }

        $this->validate($request, [
            'name' => 'required|string',
            'news_categories_id' => 'required',
            'short_description' => 'required',
            'event_date' => 'required|date',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = date('Y').'/'.time().'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('Main/frontend/images/NewsAndEvents/').date('Y'), $data['thumbnail']);
            $data['thumbnail'] = $data['thumbnail'];
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = date('Y').'/'.time().'.'.$request->cover_image->getClientOriginalExtension();
            $request->cover_image->move(public_path('Main/frontend/images/NewsAndEvents/').date('Y'), $data['cover_image']);
            $data['cover_image'] = $data['cover_image'];
        }

        $saveNewsAndEvents = NewsAndEvents::create($data);

        if($saveNewsAndEvents){
          return redirect(route('news-and-events.index'))->with('message','Congratulations,Record Added Successfully');
        }else{
          return redirect(route('news-and-events.index'))->with('message','There is something wrong Please try again.');
        }
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
        $news_categories = NewsCategories::get();
        $newstag = Tag::get();
        $editNewsEvents = NewsAndEvents::findOrFail($id);
        $selectedtags = explode(',', $editNewsEvents->tag);
        return view('Main.backend.News&Events.edit', compact('editNewsEvents','news_categories','newstag','selectedtags'));
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
        $updateNewsEvents = NewsAndEvents::findOrFail($id);

        $data = $request->all();

        $data['updated_by']=Auth::user()->id;
        // $data['slug'] = $this->createSlug($request->name);

        $this->validate($request, [
            'name' => 'required|string',
            'news_categories_id' => 'required',
            'event_date' => 'required|date',
            // 'short_description' => 'required',
            'thumbnail' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $preNewsEvents = public_path('Main/frontend/images/NewsAndEvents/'.$updateNewsEvents->thumbnail);
            if (File::exists($preNewsEvents)) { // unlink or remove previous image from folder
                File::delete($preNewsEvents);
            }

            $data['thumbnail'] = date('Y').'/'.time().'.'.$request->thumbnail->getClientOriginalExtension();
            $request->thumbnail->move(public_path('Main/frontend/images/NewsAndEvents/').date('Y'), $data['thumbnail']);
            $thumbnail = $data['thumbnail'];
        }
        else
        {
            $data['thumbnail'] = $data['old_thumbnail'];
        }

        $gettags = $request->tag;
        foreach($gettags as $gettag){
            $selectarray[] = $gettag;
        }

        $selecttag = implode(',', $selectarray);
        $data['tag'] = $selecttag;
        $response = $updateNewsEvents->update($data);

        if($response){
          return redirect(route('news-and-events.index'))->with( 'message','Congratulations,Record Updated Successfully!');
        }else{
          return redirect(route('news-and-events.index'))->with('message','There is something wrong Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getEventId = NewsAndEvents::find($id);
        $destroyEvents=$getEventId->delete();
        if($destroyEvents){
                return redirect(route('news-and-events.index'))
                ->with('message','Congratulations,Record Deleted Successfully!');
        }
        else{
            return redirect(route('news-and-events.index'))
            ->with('message','There is something wrong Please try again.');
        }
    }

    public function restore(Request $request, $id){

        $restoreEvents =NewsAndEvents::onlyTrashed()->find($id);

        if ($restoreEvents->restore()) {
        return redirect(route('news-and-events.index'))
                ->with('message','Congratulations,Record restored Successfully!');
        }
        else {
            return redirect(route('news-and-events.index'))
            ->with('message','There is something wrong Please try again.');
        }
    }

    public function delete(NewsAndEvents $events, $id)
    {
        $events = NewsAndEvents::onlyTrashed()->find($id);

        if(isset($events)){
            $delPreEventImage = public_path('Main/frontend/images/NewsAndEvents/'.$events->thumbnail);
            File::delete($delPreEventImage);

            $delPreCoverImage = public_path('Main/frontend/images/NewsAndEvents/'.$events->cover_image);
            File::delete($delPreCoverImage);
            $events->forceDelete();
            return redirect()->back()->with('message','Congratulations,Record Deleted Permanently Successfully!');
        }
        else {
            return redirect(route('news-and-events.index'))
            ->with('message','There is something wrong Please try again.');
        }

    }

    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 100000000; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return NewsAndEvents::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
                'upload' => 'mimes:jpeg,png,pdf,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('upload')) {

        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
         $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName.'_'.time().'.'.$extension;

         $request->file('upload')->move(public_path('Main/frontend/images/NewsAndEvents/'), $fileName);

         $CKEditorFuncNum = $request->input('CKEditorFuncNum');
         $url = asset('Main/frontend/images/NewsAndEvents/'.$fileName);
         $msg = 'Image uploaded successfully';
         $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

         @header('Content-type: text/html; charset=utf-8');
         echo $response;
        }

    }
}
