<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PopupController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:popup-list');
        $this->middleware('permission:popup-create', ['only' => ['create','store']]);
        $this->middleware('permission:popup-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:popup-delete', ['only' => ['delete']]);
        $this->middleware('permission:popup-restore', ['only' => ['restore']]);
        $this->middleware('permission:popup-softdelete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Main.backend.Popup.index');
    }
    public function getPopUp(Request $request){
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        // $deleted_at =  $request->get('deleted_at');

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Popup::select('count(*) as allcount')->withTrashed()->count();
        $totalRecordswithFilter = Popup::select('count(*) as allcount')->withTrashed()
            ->where(function($q) use($searchValue){
                $q->where('title', 'like', '%' .$searchValue . '%')
                    ->orWhere('position', 'like', '%' .$searchValue . '%');
            })->count();
        // Fetch records
        $records = Popup::orderBy($columnName,$columnSortOrder)
            ->where(function($q) use($searchValue){
                $q->where('title', 'like', '%' .$searchValue . '%')
                    ->orWhere('position', 'like', '%' .$searchValue . '%');
            })
            ->withTrashed()
            ->select('popups.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach($records as $record){

            $id = $record->id;
            $title = $record->title;
            $image_path = (!empty($record->image) ?asset('front/assets/popups/'.$record->image) : '');
            if (!empty($image_path)){
                $image = '<a href="'.$image_path.'" class="btn btn-sm btn-primary mx-2" target="_blank"><i class="fa fa-eye"></i></a>';
            }
            else{
                $image='';
            }
            $status = $record->status;
            $is_active = '';
            if ($status == 1){
                $is_active = 'Active';
            }
            else {
                $is_active = 'In Active';
            }
            if($record->deleted_at == Null){
                $deleted_at = '0';
            }
            if($record->deleted_at != Null){
                $deleted_at = '1';
            }
            $position = $record->position;
            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "image" => $image,
                "status" => $is_active,
                "position" => $position,
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
        return view('Main.backend.Popup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'position' => 'required|integer',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->hasFile('image')) {
            $image = date('Y').'/'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('front/assets/popups/').date('Y'), $image);
            $popup_image = $image;
        }
        else{
            $popup_image='';
        }
        $user_id = Auth::user()->id;
        $popup = new Popup();
        $popup->title = $request->title;
        $popup->slug = $request->slug;
        $popup->image = $popup_image;
        $popup->description = $request->description;
        $popup->status = $request->status;
        $popup->position = $request->position;
        $popup->created_by  = $user_id;
        $popup->updated_by  = $user_id;
        $saved = $popup->save();
        if ($saved == true){
            return redirect(route('popup.index'))->with('message','Data Created Successfully');
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
        $popup = Popup::findOrFail($id);
        return view('Main.backend.Popup.edit', compact('popup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'position' => 'required|integer',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);
        $popup = Popup::find($id);
        if ($request->hasFile('image')) {
            if(isset($popup) && $popup->image){
                $prevFile = public_path('front/assets/popups/'.$popup->image);
                if (File::exists($prevFile)) { // unlink or remove previous image from folder
                    File::delete($prevFile);
                }
            }
            $image = date('Y').'/'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('front/assets/popups/').date('Y'), $image);
            $popup_image = $image;
        }
        else{
            $popup_image=$popup->image;
        }
        $user_id = Auth::user()->id;
        $popup->title = $request->title;
        $popup->slug = $request->slug;
        $popup->image = $popup_image;
        $popup->description = $request->description;
        $popup->status = $request->status;
        $popup->position = $request->position;
        $popup->updated_by  = $user_id;
        $saved = $popup->save();
        if ($saved == true){
            return redirect(route('popup.index'))->with('message','Data Updated Successfully');
        }
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'upload' => 'mimes:jpeg,png,pdf,jpg,gif,svg|max:2048',
        ]);
        /**
         * Upload the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $popup = Popup::find($id);
        if($popup->delete()){
            return redirect(route('popup.index'))->with('message','Data Deleted Successfully');
        }
    }

    public function restore( $id)
    {
        $popup = Popup::onlyTrashed()->find($id);
        if($popup->restore()){
            return redirect(route('popup.index'))->with('message','Data Restored Successfully');
        }
    }

    public function delete($id)
    {
        $popup = Popup::onlyTrashed()->find($id);
        if(isset($popup)){
            $delFile = public_path('front/assets/popups/'.$popup->image);
            File::delete($delFile);
            $popup->forceDelete();
            return redirect()->back()->with('message','Data Deleted Permanently!');
        }
    }
}
