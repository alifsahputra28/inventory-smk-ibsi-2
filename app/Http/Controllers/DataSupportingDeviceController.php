<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataSupportingDeviceRequest;
use App\Models\DataSupportingDevice;
use App\Models\LaboratoryRoom;
use App\Models\SupportingDeviceInformation;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\HasImage;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataSupportingDeviceController extends Controller
{
    use HasImage;
    public function indexDataSupportingInLabor(Request $request, LaboratoryRoom $laboratoryRoom){
        if ($request->ajax()) {
            $data = SupportingDeviceInformation::where('laboratory_room_id', $laboratoryRoom->id)->latest();
            $laboratoryRoomId =  $laboratoryRoom->id;
            return DataTables::of($data, $laboratoryRoomId)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data)  use ($laboratoryRoom) {
                    $id             = $data->id;
                    $url_edit       = route('dataSupportingDevice.edit', ['laboratory_room' => $laboratoryRoom->id, 'supporting_device_information' => $id]);
                    $url_show       = route('dataSupportingDevice.show', ['laboratory_room' => $laboratoryRoom->id, 'supporting_device_information' => $id]);
                    $url_delete     = route('dataSupportingDevice.destroy', $id);

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
       
        return view('pages.dataSupportingDevices.indexSupportingDeviceInLabour', compact('laboratoryRoom'));
    }

    public function createLaboratorySupportingDevice(LaboratoryRoom $laboratoryRoom){
        $supportingDeviceInformation = new SupportingDeviceInformation;
        return view('pages.dataSupportingDevices.create', compact('laboratoryRoom', 'supportingDeviceInformation'));
    }
    public function storeLaboratorySupportingDevice(DataSupportingDeviceRequest $request,LaboratoryRoom $laboratoryRoom){
        try {
            DB::beginTransaction();
                $image = $this->uploadImage($request, $path = 'public/data-supporting-devices/');
               
                $dataSupportingDevice = DataSupportingDevice::create([
                    'name'              => $request->name,
                    'merk'              => $request->merk,
                    'model_or_type'     => $request->model_or_type,
                    'description'       => $request->description,
                    'image'             => $image->hashName()
                ]);

                $idGenerator = IdGenerator::generate(['table' => 'supporting_device_information', 'field' => 'supporting_device_number', 'length' => 10, 'prefix' => 'SUPPDEV']);

                SupportingDeviceInformation::create([
                    'data_supporting_device_id' => $dataSupportingDevice->id,
                    'laboratory_room_id'        => $laboratoryRoom->id,
                    'supporting_device_number'  => $idGenerator,
                    'amount'                    => $request->amount,
                    'condition'                 => $request->condition,
                    'date'                      => $request->date,
                    'description'               => $request->description,
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        
        return redirect()->route('dataSupportingDevice.index', $laboratoryRoom->id)->with('success', 'Create Data Success');
    }


    public function showLaboratorySupportingDevice(LaboratoryRoom $laboratoryRoom, SupportingDeviceInformation $supportingDeviceInformation){
        return view('pages.dataSupportingDevices.show',compact('laboratoryRoom','supportingDeviceInformation'));
    }

    public function editLaboratorySupportingDevice(LaboratoryRoom $laboratoryRoom, SupportingDeviceInformation $supportingDeviceInformation){
        return view('pages.dataSupportingDevices.edit',compact('laboratoryRoom','supportingDeviceInformation'));
    }

    public function updateLaboratorySupportingDevice(DataSupportingDeviceRequest $request,LaboratoryRoom $laboratoryRoom, SupportingDeviceInformation $supportingDeviceInformation){
        try {
           DB::beginTransaction();
           $image = $this->uploadImage($request, $path = 'public/data-supporting-devices/');
           if ($request->file('image')) {
            Storage::disk('local')->delete('public/data-computers/' . basename($supportingDeviceInformation->dataSupportingDevice->image));
            
            $supportingDeviceInformation->dataSupportingDevice->update([
                'name'              => $request->name,
                'merk'              => $request->merk,
                'model_or_type'     => $request->model_or_type,
                'description'       => $request->description,
                'image'             => $image->hashName()
            ]);
            $supportingDeviceInformation->update([
                'data_supporting_device_id' => $supportingDeviceInformation->dataSupportingDevice->id,
                'laboratory_room_id'        => $laboratoryRoom->id,
                'supporting_device_number'  => $supportingDeviceInformation->supporting_device_number,
                'amount'                    => $request->amount,
                'condition'                 => $request->condition,
                'date'                      => $request->date,
                'description'               => $request->description,
            ]);
        }

        $supportingDeviceInformation->dataSupportingDevice->update([
            'name'              => $request->name,
            'merk'              => $request->merk,
            'model_or_type'     => $request->model_or_type,
            'description'       => $request->description,
        ]);
        $supportingDeviceInformation->update([
            'data_supporting_device_id' => $supportingDeviceInformation->dataSupportingDevice->id,
            'laboratory_room_id'        => $laboratoryRoom->id,
            'supporting_device_number'  => $supportingDeviceInformation->supporting_device_number,
            'amount'                    => $request->amount,
            'condition'                 => $request->condition,
            'date'                      => $request->date,
            'description'               => $request->description,
        ]);

           DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('dataSupportingDevice.index', $laboratoryRoom->id)->with('success', 'Update Data Success');
    }

    public function deleteLaboratorySupportingDevice(SupportingDeviceInformation $supportingDeviceInformation){
        $supportingDeviceInformation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted Data Success!.',
        ]);
    }
}
