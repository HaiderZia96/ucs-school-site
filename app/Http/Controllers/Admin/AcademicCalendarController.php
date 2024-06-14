<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Main\AcademicCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AcademicCalendarController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:calendar-list', ['only' => ['index']]);
        $this->middleware('permission:calendar-create', ['only' => ['create','store']]);
        $this->middleware('permission:calendar-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:calendar-softdelete', ['only' => ['destroy']]);
        $this->middleware('permission:calendar-restore', ['only' => ['restore']]);
        $this->middleware('permission:calendar-delete', ['only' => ['delete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = AcademicCalendar::withTrashed()->latest()->paginate(10);
        return view('Main.backend.Calendar.index', compact('data'))->with('i', ($request->input('page', 1) -1) * 10);
    }

    public function getCalendars(Request $request)
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
        $totalRecords = AcademicCalendar::withTrashed()->select('count(*) as allcount')
            ->Where('academic_calendars.name', 'like', '%' .$searchValue . '%')
            ->orderBy('academic_calendars.order', 'ASC')
            ->count();

        $totalRecordswithFilter = AcademicCalendar::withTrashed()
            ->select('count(*) as allcount')
            ->Where('academic_calendars.name', 'like', '%' .$searchValue . '%')
            ->orderBy('academic_calendars.order', 'ASC')
            ->count();
        // Fetch records
        $records = AcademicCalendar::orderBy('academic_calendars.order')
            ->withTrashed()
            ->Where('academic_calendars.name', 'like', '%' .$searchValue . '%')
            ->select('academic_calendars.*')
            ->orderBy('academic_calendars.order', 'ASC')
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
            $archived = $record->archived;
            if ($archived == 1)
            {
                $archived = 'Yes';
            }
            if ($archived == 2){
                $archived = 'No';
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
                "archived" => $archived,
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
        return view('Main.backend.Calendar.create');
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
        $data['order'] = AcademicCalendar::max('order')+1;
        //Validation
        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:academic_calendars,slug',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'calendar' => 'required|mimes:pdf|max:25000',
            'sub_details' => 'required',
            'status' => 'required',
            'archived' => 'required',
        ]);
        // Upload Image
        if ($request->hasFile('image') ) {
            $image = $request->file('image');
            $getImage = $data['slug'].'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Calendar/Image', $image, $getImage);
            $data['image'] = $getImage;
        }
        // Upload Calendar
        if ($request->hasFile('calendar') ) {
            $calendar = $request->file('calendar');
            $getCalendar = $data['slug'].'.'.$request->calendar->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Calendar', $calendar, $getCalendar);
            $data['calendar'] = $getCalendar;
        }

        $CalendarStore = AcademicCalendar::create($data);

        if($CalendarStore->save()){
            return redirect(route('calendar.index'))
                ->with('message','Calendar Added Successfully');
        }
        else{
            return redirect(route('calendar.create'))->with('message','There is something wrong please try again!');
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
        $editCalendar = AcademicCalendar::findOrFail($id);
        return view('Main.backend.Calendar.edit', compact('editCalendar'));
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
        $updateCalendar = AcademicCalendar::findOrFail($id);
        $data = $request->all();
        $data['slug'] = Str::slug($request->slug, '-');
        $data['created_by']=Auth::user()->id;
        $data['updated_by']=Auth::user()->id;
        //Validation
        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|string|unique:academic_calendars,slug,'.$updateCalendar->id,
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'calendar' => 'mimes:pdf|max:25000',
            'sub_details' => 'required',
            'status' => 'required',
            'archived' => 'required',
        ]);
        // Upload Image
        if ($request->hasFile('image') ) {
            if (isset($updateCalendar) && $updateCalendar->image) {
                $preImage = 'Calendar/Image/'.$updateCalendar->image;
                if (Storage::disk('public')->exists($preImage)) {
                    Storage::disk('public')->delete($preImage);
                }
            }
            $image = $request->file('image');
            $getImage = $data['slug'].'.'.$request->image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Calendar/Image', $image, $getImage);
            $data['image'] = $getImage;
        }
        else{
            $data['image'] = $updateCalendar->image;
        }
        // Upload Calendar
        if ($request->hasFile('calendar') ) {
            if (isset($updateCalendar) && $updateCalendar->calendar) {
                $preCalendar = 'Calendar/'.$updateCalendar->calendar;
                if (Storage::disk('public')->exists($preCalendar)) {
                    Storage::disk('public')->delete($preCalendar);
                }
            }
            $prospectus = $request->file('calendar');
            $getCalendar = $data['slug'].'.'.$request->calendar->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('Calendar', $prospectus, $getCalendar);
            $data['prospectus'] = $getCalendar;
        }
        else{
            $data['prospectus'] = $updateCalendar->prospectus;
        }

        $CalendarUpdate = $updateCalendar->update($data);

        if($CalendarUpdate){
            return redirect(route('calendar.index'))
                ->with('message','Calendar Updated Successfully');
        }
        else{
            return redirect(route('calendar.create'))->with('message','There is something wrong please try again!');
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
        $getCalendarid = AcademicCalendar::find($id);
        $destroyPage=$getCalendarid->delete();
        if($destroyPage){
            return redirect(route('calendar.index'))
                ->with('message','Calendar Deleted Successfully!');
        }
        else{
            return redirect(route('calendar.index'))
                ->with('message','There is something wrong please try again!');
        }
    }
    // restore Calendar page
    public function restore(Request $request, $id){
        $restoreCalendar = AcademicCalendar::onlyTrashed()->find($id);
        if ($restoreCalendar->restore()) {
            return redirect(route('calendar.index'))
                ->with('message','Calendar Restored Successfully!');
        }else {
            return redirect(route('calendar.index'))
                ->with('message','There is something wrong please try again!');
        }
    }
    // force delete
    public function delete(AcademicCalendar $getCalendarId, $id)
    {
        $getCalendarId = AcademicCalendar::onlyTrashed()->find($id);
        if(isset($getCalendarId)){
            //Image
            $preImage = 'Calendar/Image/'.$getCalendarId->image;
            if (Storage::disk('public')->exists($preImage)) {
                Storage::disk('public')->delete($preImage);
            }
            //Calendar
            $preCalendar = 'Calendar/'.$getCalendarId->calendar;
            if (Storage::disk('public')->exists($preCalendar)) {
                Storage::disk('public')->delete($preCalendar);
            }
            $getCalendarId->forceDelete();
        }
        return redirect()->back()->with('message','Calendar deleted successfully');
    }
    //Move Down
    public function moveDown($id)
    {
        $prospectus = AcademicCalendar::find($id);
        if (!empty($prospectus)){
            $nextCalendar = AcademicCalendar::where('order', '>', $prospectus->order)->orderBy('order','asc')->first();
            if (!empty($nextCalendar)){
                $downWard = $prospectus->update([
                    'order' => $nextCalendar->order
                ]);
                if (isset($downWard)) {
                    $upWard = $nextCalendar->update([
                        'order'=>$prospectus->order-1
                    ]);
                    if (isset($upWard)){
                        return redirect()->back()->with('message','Calendar Moved Downwards');
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
        $prospectus = AcademicCalendar::find($id);
        if (!empty($prospectus)){
            $previousCalendar = AcademicCalendar::where('order', '<', $prospectus->order)->orderBy('order','desc')->first();
            if (!empty($previousCalendar)){
                $upWard = $prospectus->update([
                    'order' => $previousCalendar->order
                ]);
                if (isset($upWard)) {
                    $downWard = $previousCalendar->update([
                        'order'=>$prospectus->order+1
                    ]);
                    if (isset($downWard)){
                        return redirect()->back()->with('message','Calendar Moved Upwards');
                    }
                }
            }
            else{
                return redirect()->back()->with('warning','Can not move further.');
            }
        }
    }
}
