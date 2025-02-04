<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main\NewsCategories;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class NewsCategoriesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:news-categories-list');
        $this->middleware('permission:news-categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:news-categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:news-categories-delete', ['only' => ['delete']]);
        $this->middleware('permission:news-categories-restore', ['only' => ['restore']]);
        $this->middleware('permission:news-categories-softdelete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Main.backend.NewsCategories.create');
    }


    public function getNewsCategories(Request $request){
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

        $totalRecords = NewsCategories::withTrashed()->select('count(*) as allcount')
            ->withTrashed()
            ->leftJoin('users','users.id','=','news_categories.created_by')
            ->Where('news_categories.slug', 'like', '%' .$searchValue . '%')
            ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%')
            ->orWhere('users.name', 'like', '%' .$searchValue . '%')
            ->orderBy('id', 'DESC')
            ->count();


        $totalRecordswithFilter = NewsCategories::withTrashed()
            ->select('count(*) as allcount')
            ->withTrashed()
            ->leftJoin('users','users.id','=','news_categories.created_by')
            ->Where('news_categories.slug', 'like', '%' .$searchValue . '%')
            ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%')
            ->orWhere('users.name', 'like', '%' .$searchValue . '%')
            ->orderBy('id', 'DESC')
            ->count();
        // Fetch records
        $records = NewsCategories::orderBy($columnName,$columnSortOrder)
            ->withTrashed()
            ->leftJoin('users','users.id','=','news_categories.created_by')
            ->Where('news_categories.slug', 'like', '%' .$searchValue . '%')
            ->orWhere('news_categories.name', 'like', '%' .$searchValue . '%')
            ->orWhere('users.name', 'like', '%' .$searchValue . '%')
            ->select('news_categories.*')
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($rowperpage)
            ->get();




        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $slug = $record->slug;
            $created_by = User::where('id', $record->created_by)->pluck('name','name')->first();
            $updated_by = User::where('id', $record->updated_by)->pluck('name','name')->first();
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
                "slug" => $slug,
                "created_by" => $created_by,
                "updated_by" => $updated_by,
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

        $this->validate($request, [
            'name' => 'required|unique:news_categories|string',
        ]);

        $slug = $this->createSlug($request->name);
        $data['slug']= $slug;

        $saveNewsCategories = NewsCategories::create($data);

        if($saveNewsCategories){
          return redirect('admin/news-categories/create')->with('message','Congratulations,Record Added Successfully');
        }else{
          return redirect('admin/news-categories/create')->with('message','There is something wrong Please try again.');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCategories = NewsCategories::findOrFail($id);
        return view('Main.backend.NewsCategories.edit', compact('editCategories'));
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

        $updateCategories = NewsCategories::findOrFail($id);

        $data = $request->all();

        $data['updated_by']=Auth::user()->id;
        $data['slug'] = $this->createSlug($request->name);

        $this->validate($request, [
            'name' => 'required|string|unique:news_categories,name,'.$id,
        ]);

        $response = $updateCategories->update($data);

        if($response){
          return redirect('admin/news-categories/create')->with( 'message','Congratulations,Record Updated Successfully!');
        }else{
          return redirect('admin/news-categories/create')->with('message','There is something wrong Please try again.');
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
        $getCategoriesId = NewsCategories::find($id);
        $destroyCategories=$getCategoriesId->delete();
        if($destroyCategories){
                  return redirect(route('news-categories.create'))
                  ->with('message','Congratulations,Record Destroyed Successfully!');
        }
        else{
            return redirect(route('news-categories.create'))
            ->with('message','There is something wrong Please try again.');
        }
    }
    public function restore(Request $request, $id){
        $restoreNewsCategories =NewsCategories::onlyTrashed()->find($id);
        if ($restoreNewsCategories->restore()) {
          return redirect(route('news-categories.create'))
                ->with('message','Congratulations,Record restored Successfully!');
        }
        else {
            return redirect(route('news-categories.create'))
            ->with('message','There is something wrong Please try again.');
        }
    }

    public function delete(NewsCategories $delCategories, $id)
    {
        $delCategories = NewsCategories::where('id', $id)->forceDelete();
        if(isset($delCategories)){
            return redirect()->back()->with('message','Congratulations,Record Deleted Permanently Successfully!');
        }
        else {
            return redirect(route('news-categories.create'))
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
        return NewsCategories::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
