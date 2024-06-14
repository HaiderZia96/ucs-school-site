<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main\Prospectus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProspectusController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:prospectus-list', ['only' => ['index']]);
        $this->middleware('permission:prospectus-create', ['only' => ['create','store']]);
        $this->middleware('permission:prospectus-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:prospectus-softdelete', ['only' => ['destroy']]);
        $this->middleware('permission:prospectus-restore', ['only' => ['restore']]);
        $this->middleware('permission:prospectus-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Prospectus::withTrashed()->latest()->paginate(10);
        return view('Main.backend.Prospectus.index', compact('data'))->with('i', ($request->input('page', 1) -1) * 10);
    }

    public function getProspectuses(Request $request)
    {
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
        $totalRecords = Prospectus::withTrashed()->select('count(*) as allcount')
            ->Where('prospectuses.name', 'like', '%' .$searchValue . '%')
            ->orderBy('prospectuses.order', 'ASC')
            ->count();

        $totalRecordswithFilter = Prospectus::withTrashed()
            ->select('count(*) as allcount')
            ->Where('prospectuses.name', 'like', '%' .$searchValue . '%')
            ->orderBy('prospectuses.order', 'ASC')
            ->count();
        // Fetch records
        $records = Prospectus::orderBy('prospectuses.order')
            ->withTrashed()
            ->Where('prospectuses.name', 'like', '%' .$searchValue . '%')
            ->select('prospectuses.*')
            ->orderBy('prospectuses.order', 'ASC')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $status = $record->status;
            if ($status == 1)
            {
                $status = 'Active';
            }
            if ($status == 2){
                $status = 'In-Active';
            }
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
                "status" => $status,
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
        return view('Main.backend.Prospectus.create');
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
        $data['slug'] = Str::slug($request->slug, '-');
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;
        $data['order'] = Prospectus::max('order')+1;
        //Validation
        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:prospectuses,slug',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prospectus' => 'required|mimes:pdf|max:25000',
            'sub_details' => 'required',
            'status' => 'required',
        ]);
        // Upload Image
        if ($request->hasFile('image') ) {
            $image = $request->file('image');
            $getImage = $data['slug'].'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Prospectus/Image', $image, $getImage);
            $data['image'] = $getImage;
        }
        // Upload Prospectus
        if ($request->hasFile('prospectus') ) {
            $prospectus = $request->file('prospectus');
            $getProspectus = $data['slug'].'.'.$request->prospectus->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Prospectus', $prospectus, $getProspectus);
            $data['prospectus'] = $getProspectus;
        }

        $ProspectusStore = Prospectus::create($data);

        if($ProspectusStore->save()){
            return redirect(route('prospectus.index'))
                ->with('message','Prospectus Added Successfully');
        }
        else{
            return redirect(route('prospectus.create'))->with('message','There is something wrong please try again!');
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
        $editProspectus = Prospectus::findOrFail($id);
        return view('Main.backend.Prospectus.edit', compact('editProspectus'));
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
        $updateProspectus = Prospectus::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->slug, '-');
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;
        //Validation
        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:prospectuses,slug,'.$updateProspectus->id,
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prospectus' => 'mimes:pdf|max:25000',
            'sub_details' => 'required',
            'status' => 'required',
        ]);
        // Upload Image
        if ($request->hasFile('image') ) {
            if (isset($updateProspectus) && $updateProspectus->image) {
                $preImage = 'Prospectus/Image/'.$updateProspectus->image;
                if (Storage::disk('public')->exists($preImage)) {
                    Storage::disk('public')->delete($preImage);
                }
            }
            $image = $request->file('image');
            $getImage = $data['slug'].'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Prospectus/Image', $image, $getImage);
            $data['image'] = $getImage;
        }
        else{
            $data['image'] = $updateProspectus->image;
        }
        // Upload Prospectus
        if ($request->hasFile('prospectus') ) {
            if (isset($updateProspectus) && $updateProspectus->prospectus) {
                $preProspectus = 'Prospectus/'.$updateProspectus->prospectus;
                if (Storage::disk('public')->exists($preProspectus)) {
                    Storage::disk('public')->delete($preProspectus);
                }
            }
            $prospectus = $request->file('prospectus');
            $getProspectus = $data['slug'].'.'.$request->prospectus->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Prospectus', $prospectus, $getProspectus);
            $data['prospectus'] = $getProspectus;
        }
        else{
            $data['prospectus'] = $updateProspectus->prospectus;
        }

        $ProspectusUpdate = $updateProspectus->update($data);

        if($ProspectusUpdate){
            return redirect(route('prospectus.index'))
                ->with('message','Prospectus Updated Successfully');
        }
        else{
            return redirect(route('prospectus.create'))->with('message','There is something wrong please try again!');
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
        $getProspectusid = Prospectus::find($id);
        $destroyPage=$getProspectusid->delete();
        if($destroyPage){
            return redirect(route('prospectus.index'))
                ->with('message','Prospectus Deleted Successfully!');
        }
        else{
            return redirect(route('prospectus.index'))
                ->with('message','There is something wrong please try again!');
        }
    }
    // restore Prospectus page
    public function restore(Request $request, $id){
        $restoreProspectus = Prospectus::onlyTrashed()->find($id);
        if ($restoreProspectus->restore()) {
            return redirect(route('prospectus.index'))
                ->with('message','Prospectus Restored Successfully!');
        }else {
            return redirect(route('prospectus.index'))
                ->with('message','There is something wrong please try again!');
        }
    }
    // force delete
    public function delete(Prospectus $getProspectusId, $id)
    {
        $getProspectusId = Prospectus::onlyTrashed()->find($id);
        if(isset($getProspectusId)){
            //Image
            $preImage = 'Prospectus/Image/'.$getProspectusId->image;
            if (Storage::disk('public')->exists($preImage)) {
                Storage::disk('public')->delete($preImage);
            }
            //Prospectus
            $preProspectus = 'Prospectus/'.$getProspectusId->prospectus;
            if (Storage::disk('public')->exists($preProspectus)) {
                Storage::disk('public')->delete($preProspectus);
            }
            $getProspectusId->forceDelete();
        }
        return redirect()->back()->with('message','Prospectus deleted successfully');
    }
    //Move Down
    public function moveDown($id)
    {
        $prospectus = Prospectus::find($id);
        if (!empty($prospectus)){
            $nextProspectus = Prospectus::where('order', '>', $prospectus->order)->orderBy('order','asc')->first();
            if (!empty($nextProspectus)){
                $downWard = $prospectus->update([
                    'order' => $nextProspectus->order
                ]);
                if (isset($downWard)) {
                    $upWard = $nextProspectus->update([
                        'order'=>$prospectus->order-1
                    ]);
                    if (isset($upWard)){
                        return redirect()->back()->with('message','Prospectus Moved Downwards');
                    }
                }
            }
            else{
                return redirect()->back()->with('warning','Can not move further.');
            }
        }
    }
    //Move Up
    public function moveUp($id)
    {
        $prospectus = Prospectus::find($id);
        if (!empty($prospectus)){
            $previousProspectus = Prospectus::where('order', '<', $prospectus->order)->orderBy('order','desc')->first();
            if (!empty($previousProspectus)){
                $upWard = $prospectus->update([
                    'order' => $previousProspectus->order
                ]);
                if (isset($upWard)) {
                    $downWard = $previousProspectus->update([
                        'order'=>$prospectus->order+1
                    ]);
                    if (isset($downWard)){
                        return redirect()->back()->with('message','Prospectus Moved Upwards');
                    }
                }
            }
            else{
                return redirect()->back()->with('warning','Can not move further.');
            }
        }
    }
}
