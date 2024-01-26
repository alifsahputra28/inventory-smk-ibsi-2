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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = LaboratoryComputer::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
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
        if (Auth::user()->hasRole('Admin')) {
            $laboratoryRooms = LaboratoryRoom::latest()->get();
        }elseif(Auth::user()->hasRole('Ka.Lab RPL')){
            $laboratoryRooms = LaboratoryRoom::where('laboratory_number','Lab-001')->latest()->get();
        }

        return view('pages.laboratoryComputers.index', compact('laboratoryRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LaboratoryRoom $laboratoryRoom)
    {
        $dataComputers = DataComputer::latest()->get();
        $laboratoryComputer = new LaboratoryComputer;
        return view('pages.laboratoryComputers.create', compact('dataComputers', 'laboratoryRoom', 'laboratoryComputer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratoryComputerRequest $request, LaboratoryRoom $laboratoryRoom)
    {
        for ($i = 1; $i <= $request->amount; $i++) {
            $idGenerator = IdGenerator::generate(['table' => 'laboratory_computers', 'field' => 'computer_number', 'length' => 7, 'prefix' => 'COMP']);
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

        return redirect()->route('laboratory-computers.index')->with('success', 'Create Data Success');
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
        return view('pages.laboratoryComputers.edit', compact('laboratoryComputer', 'dataComputers'));
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

        return redirect()->route('laboratory-computers.index')->with('success', 'Update Data Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratoryComputer $laboratoryComputer)
    {
       $laboratoryComputer->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data User Berhasi Di Hapus'
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
