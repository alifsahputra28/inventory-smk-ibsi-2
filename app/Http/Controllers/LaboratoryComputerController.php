<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratoryComputerRequest;
use App\Models\DataComputer;
use App\Models\LaboratoryComputer;
use App\Models\LaboratoryRoom;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class LaboratoryComputerController extends Controller
{
   function __construct()
    {
         $this->middleware('permission:laboratory-computer-list', ['only' => ['index']]);
         $this->middleware('permission:laboratory-computer-create', ['only' => ['create','store']]);
         $this->middleware('permission:laboratory-computer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:laboratory-computer-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = LaboratoryComputer::latest();
            if (!empty($request->from_date)) {
                if(Auth::user()->can('Lab RPL')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-001');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Akuntansi')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-002');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Administrasi Perkantoran')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-003');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Pemasaran')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-004');
                    })
                    ->get();
                }else{
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->get();
                }
              
            } else {
                if (Auth::user()->can('Lab RPL')) {
                    $data = LaboratoryComputer::latest()
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        });
                } elseif (Auth::user()->can('Lab Akuntansi')) {
                    $data = LaboratoryComputer::latest()
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        });
                } elseif (Auth::user()->can('Lab Administrasi Perkantoran')) {
                    $data = LaboratoryComputer::latest()
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        });
                } elseif (Auth::user()->can('Lab Pemasaran')) {
                    $data = LaboratoryComputer::latest()
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        });
                } else {
                    $data = LaboratoryComputer::latest();
                }
            }
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('LaboratoryRoom', function ($data) {
                    return  $data->laboratoryRoom->name;
                })
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('laboratory-computers.edit', $id);
                    $url_show       = route('laboratory-computers.show', $id);
                    $url_delete     = route('laboratory-computers.destroy', $id);

                    $edit     = '<a href="' . $url_edit . '" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                    $show    = '<a href="' . $url_show . '" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                    $delete    = '<a href="javascript:void(0)" id="' . $id . '" data-id="' . $url_delete . '" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                    $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>' . $edit . '</li>
                  <li>' . $show . '</li>
                  <li>' . $delete . '</li>
                </ul>
              </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (Auth::user()->can('Lab RPL')) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-001')->first()->id;
        } elseif (Auth::user()->can('Lab Akuntansi')) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-002')->first()->id;
        } elseif (Auth::user()->can('Lab Administrasi Perkantoran')) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-003')->first()->id;
        } elseif (Auth::user()->can('Lab Pemasaran')) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-004')->first()->id;
        } else {
            $laboratoryRoomsId = '';
        }

        $laboratoryRooms = LaboratoryRoom::latest()->get();

        return view('pages.laboratoryComputers.index', compact('laboratoryRooms', 'laboratoryRoomsId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LaboratoryRoom $laboratoryRoom)
    {
        $dataComputers = DataComputer::latest()->get();
        $laboratoryComputer = new LaboratoryComputer;
        $laboratoryComputerNumber =  LaboratoryComputer::orderBy('id', 'DESC')->first()->computer_number;
        // dd($laboratoryComputerNumber);
        return view('pages.laboratoryComputers.create', compact('dataComputers', 'laboratoryRoom', 'laboratoryComputer', 'laboratoryComputerNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratoryComputerRequest $request, LaboratoryRoom $laboratoryRoom)
    {
        for ($i = 1; $i <= $request->amount; $i++) {
            $idGenerator = IdGenerator::generate(['table' => 'laboratory_computers', 'field' => 'computer_number', 'length' => 7, 'prefix' => 'COM']);
            LaboratoryComputer::create([
                'laboratory_room_id'    => $laboratoryRoom->id,
                'computer_number'       => $idGenerator,
                'condition'             => $request->condition,
                'date'                  => $request->date,
                'description'           => $request->description,
                'merk'                  => $request->merk,
                'model'                 => $request->model,
                'processor'             => $request->processor,
                'vga'                   => $request->vga,
                'ram'                   => $request->ram,
                'disk_size'             => $request->disk_size,
            ]);
        }

        return redirect()->route('laboratory-computers.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaboratoryComputer $laboratoryComputer)
    {
        return view('pages.laboratoryComputers.show', compact('laboratoryComputer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaboratoryComputer $laboratoryComputer)
    {
        $dataComputers = DataComputer::latest()->get();
        $laboratoryComputerNumber =  LaboratoryComputer::orderBy('id', 'DESC')->first()->computer_number;
        return view('pages.laboratoryComputers.edit', compact('laboratoryComputer', 'dataComputers', 'laboratoryComputerNumber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaboratoryComputerRequest $request, LaboratoryComputer $laboratoryComputer)
    {
        $laboratoryComputer->update([
            'laboratory_room_id'    => $laboratoryComputer->laboratory_room_id,
            'computer_number'       => $laboratoryComputer->computer_number,
            'condition'             => $request->condition,
            'date'                  => $request->date,
            'description'           => $request->description,
            'merk'                  => $laboratoryComputer->merk,
            'model'                 => $laboratoryComputer->model,
            'processor'             => $laboratoryComputer->processor,
            'vga'                   => $laboratoryComputer->vga,
            'ram'                   => $laboratoryComputer->ram,
            'disk_size'             => $laboratoryComputer->disk_size,
        ]);

        return redirect()->route('laboratory-computers.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratoryComputer $laboratoryComputer)
    {
        $laboratoryComputer->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data Deleted Successfully'
        ]);
    }


    public function getComputer(DataComputer $dataComputer)
    {
        if ($dataComputer) {
            return response()->json([
                'merk' => $dataComputer->merk,
                'model' => $dataComputer->model,
                'processor' => $dataComputer->processor,
                'vga' => $dataComputer->vga,
                'ram' => $dataComputer->ram,
                'disk_size' => $dataComputer->disk_size,
            ]);
        } else {
            return response()->json(['error' => 'Computer not found.']);
        }
    }
}
