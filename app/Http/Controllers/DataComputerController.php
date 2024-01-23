<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataComputerRequest;
use App\Models\ComputerInformation;
use App\Models\DataComputer;
use App\Models\LaboratoryRoom;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Traits\HasImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataComputerController extends Controller
{
    use HasImage;

    public function indexComputerInLabor(Request $request, LaboratoryRoom $laboratoryRoom)
    {
        if ($request->ajax()) {
            $data = ComputerInformation::where('laboratory_room_id', $laboratoryRoom->id)->latest();
            $laboratoryRoomId =  $laboratoryRoom->id;
            return DataTables::of($data, $laboratoryRoomId)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data)  use ($laboratoryRoom) {
                    $id             = $data->id;
                    $url_edit       = route('laboratoryComputer.edit', ['laboratory_room' => $laboratoryRoom->id, 'computer_information' => $id]);
                    $url_show       = route('laboratoryComputer.show', ['laboratory_room' => $laboratoryRoom->id, 'computer_information' => $id]);
                    $url_delete     = route('laboratoryComputer.destroy', $id);

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
        return view('pages.dataComputers.indexComputerInLabor', compact('laboratoryRoom'));
    }
    public function createLaboratoryComputer(LaboratoryRoom $laboratoryRoom)
    {
        $computerInformation = new ComputerInformation;
        $computerNumber = ComputerInformation::latest()->first();
        return view('pages.dataComputers.create', compact('laboratoryRoom', 'computerInformation', 'computerNumber'));
    }

    public function storeLaboratoryComputer(DataComputerRequest $request, LaboratoryRoom $laboratoryRoom)
    {
        // dd($request->all());
        $image = $this->uploadImage($request, $path = 'public/data-computers/');
        $dataComputer =   DataComputer::create([
            'merk'  => $request->merk,
            'model'  => $request->model,
            'processor'  => $request->processor,
            'vga'  => $request->vga,
            'ram'  => $request->ram,
            'disk_size'  => $request->disk_size,
            'image'  => $image->hashName(),
        ]);

        $idGenerator = IdGenerator::generate(['table' => 'computer_information', 'field' => 'computer_number', 'length' => 7, 'prefix' => 'COMP']);

        ComputerInformation::create([
            'data_computer_id'      => $dataComputer->id,
            'laboratory_room_id'    => $laboratoryRoom->id,
            'computer_number'       => $idGenerator,
            'amount'                => $request->amount,
            'condition'             => $request->condition,
            'date'                  => $request->date,
            'description'           => $request->description,
        ]);

        return redirect()->route('laboratoryComputer.index', $laboratoryRoom->id)->with('success', 'Create Data Success');
    }

    public function showLaboratoryComputer(LaboratoryRoom $laboratoryRoom, ComputerInformation $computerInformation){
        return view('pages.dataComputers.show', compact('laboratoryRoom', 'computerInformation'));
    }


    public function editLaboratoryComputer(LaboratoryRoom $laboratoryRoom, ComputerInformation $computerInformation)
    {
        // dd(ComputerInformation::with('dataComputer')->get());
        $computerNumber = ComputerInformation::latest()->first();
        return view('pages.dataComputers.edit', compact('laboratoryRoom', 'computerInformation', 'computerNumber'));
    }



    public function updateLaboratoryComputer(DataComputerRequest $request, LaboratoryRoom $laboratoryRoom, ComputerInformation $computerInformation)
    {
      try {
        DB::beginTransaction();
        $image = $this->uploadImage($request, $path = 'public/data-computers/');

        if ($request->file('image')) {
            Storage::disk('local')->delete('public/data-computers/' . basename($computerInformation->dataComputer->image));
            $computerInformation->dataComputer->update([
                'merk'  => $request->merk,
                'model'  => $request->model,
                'processor'  => $request->processor,
                'vga'  => $request->vga,
                'ram'  => $request->ram,
                'disk_size'  => $request->disk_size,
                'image'  => $image->hashName(),
            ]);
            $computerInformation->update([
                'data_computer_id'      => $computerInformation->dataComputer->id,
                'laboratory_room_id'    => $laboratoryRoom->id,
                'computer_number'       => $computerInformation->computer_number,
                'amount'                => $request->amount,
                'condition'             => $request->condition,
                'date'                  => $request->date,
                'description'           => $request->description,
            ]);
        }

        $computerInformation->dataComputer->update([
            'merk'  => $request->merk,
            'model'  => $request->model,
            'processor'  => $request->processor,
            'vga'  => $request->vga,
            'ram'  => $request->ram,
            'disk_size'  => $request->disk_size,
        ]);
        $computerInformation->update([
                'data_computer_id'      => $computerInformation->dataComputer->id,
                'laboratory_room_id'    => $laboratoryRoom->id,
                'computer_number'       => $computerInformation->computer_number,
                'amount'                => $request->amount,
                'condition'             => $request->condition,
                'date'                  => $request->date,
                'description'           => $request->description,
            ]);
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollBack();
        return redirect()->back()->with('error', $th->getMessage());
    }
        return redirect()->route('laboratoryComputer.index', $laboratoryRoom->id)->with('success', 'Update Data Success');
    }

    public function deleteLaboratoryComputer( ComputerInformation $computerInformation)
    {
        $computerInformation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]);
    }
}
