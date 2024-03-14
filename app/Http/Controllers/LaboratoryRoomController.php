<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratoryRoomRequest;
use App\Models\LaboratoryRoom;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Yajra\DataTables\DataTables;

class LaboratoryRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:laboratory-room-list', ['only' => ['index']]);
         $this->middleware('permission:laboratory-room-create', ['only' => ['create','store']]);
         $this->middleware('permission:laboratory-room-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:laboratory-room-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('laboratory-rooms')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = LaboratoryRoom::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('laboratory-rooms.edit', $id);
                    // $url_show       = route('laboratoryComputer.index', $id);
                    $url_delete     = route('laboratory-rooms.destroy', $id);

                    $edit     = '<a href="' . $url_edit . '" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                    // $show    = '<a href="' . $url_show . '" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                    $delete    = '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $url_delete . '" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                    $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>' . $edit . '</li>
                  <li>' . $delete . '</li>
                </ul>
              </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
       return view('pages.laboratoryRooms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $latestIdLabRoom = (LaboratoryRoom::latest() === null) ? LaboratoryRoom::latest()->first()->laboratory_number : "LAB-001";
        $laboratoryRoom = new LaboratoryRoom;
       return view('pages.laboratoryRooms.create', compact('latestIdLabRoom','laboratoryRoom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratoryRoomRequest $request)
    {
        $idGenerator = IdGenerator::generate(['table' => 'laboratory_rooms','field'=>'laboratory_number', 'length' => 7, 'prefix' =>'LAB-']);

        LaboratoryRoom::create([
            'laboratory_number' => $idGenerator,
            'name'      => $request->name,
            'pic'      => $request->pic
        ]);
        return redirect()->route('laboratory-rooms.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaboratoryRoom $laboratoryRoom)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaboratoryRoom $laboratoryRoom)
    {
        $latestIdLabRoom = LaboratoryRoom::latest()->first()->laboratory_number;
        return view('pages.laboratoryRooms.edit', compact('latestIdLabRoom'), compact('laboratoryRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaboratoryRoom $laboratoryRoom)
    {
        $laboratoryRoom->update([
            'name'      => $request->name,
            'pic'      => $request->pic
        ]);
        return redirect()->route('laboratory-rooms.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratoryRoom $laboratoryRoom)
    {
        $laboratoryRoom->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data Deleted Successfully'
        ]);
    }

}
