<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main\Tag;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:tags-list');
        $this->middleware('permission:tags-create', ['only' => ['create','store']]);
        $this->middleware('permission:tags-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tags-delete', ['only' => ['delete']]);
        $this->middleware('permission:tags-restore', ['only' => ['restore']]);
        $this->middleware('permission:tags-softdelete', ['only' => ['destroy']]);
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('Main.backend.Tags.create');
    }

    public function getTags(Request $request){

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

        $totalRecords = Tag::with('users')
        ->select('count(*) as allcount')
        ->withTrashed()
        ->leftJoin('users','users.id','=','tags.created_by')
        ->where('tags.name', 'like', '%' .$searchValue . '%')
        ->Where('tags.slug', 'like', '%' .$searchValue . '%')
        ->orWhere('users.name', 'like', '%' .$searchValue . '%')
        ->orderBy('id', 'DESC')
        ->count();


        $totalRecordswithFilter = Tag::with('users')
        ->select('count(*) as allcount')
        ->withTrashed()
        ->leftJoin('users','users.id','=','tags.created_by')
        ->where('tags.name', 'like', '%' .$searchValue . '%')
        ->Where('tags.slug', 'like', '%' .$searchValue . '%')
        ->orWhere('users.name', 'like', '%' .$searchValue . '%')
        ->orderBy('id', 'DESC')
        ->count();

        // Fetch records
        // DB::enableQueryLog(); // Enable query log
        $records = Tag::orderBy($columnName,$columnSortOrder)
        ->withTrashed()
        ->leftJoin('users','users.id','=','tags.created_by')
        ->where('tags.name', 'like', '%' .$searchValue . '%')
        ->Where('tags.slug', 'like', '%' .$searchValue . '%')
        ->orWhere('users.name', 'like', '%' .$searchValue . '%')
        ->select('tags.*')
        ->orderBy('id', 'DESC')
        ->skip($start)
        ->take($rowperpage)
        ->get();
        // dd($records);

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $slug = $record->slug;
            $createdBy = User::where('id', $record['created_by'])->pluck('name','name')->first();
            $updatedBy = User::where('id', $record['updated_by'])->pluck('name','name')->first();
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
                "created_by"=> $createdBy,
                "updated_by"=> $updatedBy,
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
        $data = Tag::orderBy('id', 'DESC')->withTrashed()->get();
        return view('Main.backend.Tags.create', compact('data'));
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
        $data['created_by']=Auth::User()->id;
        $this->validate($request, [
            'name' => 'required|unique:tags',
        ]);
        $slug = $this->createSlug($request->name);
        $data['slug']= $slug;

        $tagdata = Tag::create($data);
        if($tagdata){
            return redirect('admin/tags')->with('message','Congratulations,Record Added Successfully');
        }else{
            return redirect('admin/tags')->with('message','There is something wrong Please try again.');
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
        $tagsedit = Tag::findOrFail($id);
        return view('Main.backend.Tags.edit', compact('tagsedit'));
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
        $u = Tag::findOrFail($id);
        $data = $request->all();

        $data['updated_by']=Auth::user()->id;
        $data['slug'] = $this->createSlug($request->name);

        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$id,
        ]);

        $response = $u->update($data);

        if($response){
            return redirect('admin/tags')->with('message','Congratulations,Record Updated Successfully!');
        }else{
            return redirect('admin/tags')->with('message','There is something wrong Please try again.');
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
        $tagsedit = Tag::find($id);
        if ($tagsedit->delete()){
            return redirect('admin/tags')->with('message','Are you sure you want to Delete?');
        }else {
            return redirect('admin/tags')->with('message','There is something wrong please try again!');
        }
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function restore($id){
        $restoretags =Tag::onlyTrashed()->find($id);
        if ($restoretags->restore()) {
            return redirect()->back()->with('message','Record Restored successfully!');
        }else {
            return redirect()->back()->with('message','There is something wrong please try again!');
        }
    }

    public function delete($id)
    {
        $tagsedit = Tag::where('id', $id)->forceDelete();
        return redirect()->back()->with('message','Record Deleted Successfully!');
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
        return Tag::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
