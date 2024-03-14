<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratorySupportingDeviceRequest;
use App\Models\DataComputer;
use App\Models\DataSupportingDevice;
use App\Models\LaboratoryRoom;
use App\Models\LaboratorySupportingDevice;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class LaboratorySupportingDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:laboratory-supporting-device-list', ['only' => ['index']]);
         $this->middleware('permission:laboratory-supporting-device-create', ['only' => ['create','store']]);
         $this->middleware('permission:laboratory-supporting-device-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:laboratory-supporting-device-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $CanRPL = Auth::user()->can('Lab RPL');
        $CanAkuntansi = Auth::user()->can('Lab Akuntansi');
        $CanAdministrasiPerkantoran = Auth::user()->can('Lab Administrasi Perkantoran');
        $CanPemasaran = Auth::user()->can('Lab Pemasaran');
        if ($request->ajax()) {
            // $data = LaboratorySupportingDevice::latest();
            if (!empty($request->from_date)) {
                if ($CanRPL) {
                    $data = LaboratorySupportingDevice::whereNotIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        })
                        ->get();
                } elseif ($CanAkuntansi) {
                    $data = LaboratorySupportingDevice::whereNotIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        })
                        ->get();
                } elseif ($CanAdministrasiPerkantoran) {
                    $data = LaboratorySupportingDevice::whereNotIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        })
                        ->get();
                } elseif ($CanPemasaran) {
                    $data = LaboratorySupportingDevice::whereNotIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        })
                        ->get();
                } else {
                    $data = LaboratorySupportingDevice::whereNotIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))->get();
                }
            } else {
                if ($CanRPL) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereNotIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        });
                } elseif ($CanAkuntansi) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereNotIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        });
                } elseif ($CanAdministrasiPerkantoran) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereNotIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        });
                } elseif ($CanPemasaran) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereNotIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        });
                } else {
                    $data = LaboratorySupportingDevice::latest()->whereNotIn('condition', ['Outdated']);
                }
            }
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('laboratory-supporting-devices.edit', $id);
                    $url_show       = route('laboratory-supporting-devices.show', $id);
                    $url_delete     = route('laboratory-supporting-devices.destroy', $id);

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

        if ($CanRPL) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-001')->first()->id;
        } elseif ($CanAkuntansi) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-002')->first()->id;
        } elseif ($CanAdministrasiPerkantoran) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-003')->first()->id;
        } elseif ($CanPemasaran) {
            $laboratoryRoomsId = LaboratoryRoom::where('laboratory_number', 'Lab-004')->first()->id;
        } else {
            $laboratoryRoomsId = '';
        }

        $laboratoryRooms = LaboratoryRoom::latest()->get();

        return view('pages.laboratorySupportingDevices.index', compact('laboratoryRooms', 'laboratoryRoomsId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(LaboratoryRoom $laboratoryRoom)
    {
        $dataSupportingDevices = DataSupportingDevice::latest()->get();
        $laboratorySupportingDevice = new LaboratorySupportingDevice();
        $laboratorySupportingDeviceNumber =  null;
        // dd($laboratorySupportingDeviceNumber);
        return view('pages.laboratorySupportingDevices.create', compact('laboratoryRoom', 'dataSupportingDevices', 'laboratorySupportingDevice', 'laboratorySupportingDeviceNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LaboratorySupportingDeviceRequest $request, LaboratoryRoom $laboratoryRoom)
    {

        for ($i = 1; $i <= $request->amount; $i++) {
            $idGenerator = IdGenerator::generate(['table' => 'laboratory_supporting_devices', 'field' => 'supporting_device_number', 'length' => 9, 'prefix' => 'DEV']);
            LaboratorySupportingDevice::create([
                'laboratory_room_id'      => $laboratoryRoom->id,
                'supporting_device_number'      => $idGenerator,
                'condition'      => $request->condition,
                'date'      => $request->date,
                'description'      => $request->description,
                'name'      => $request->name,
                'merk'      => $request->merk,
                'model_or_type'      => $request->model_or_type,
            ]);
        }
        return redirect()->route('laboratory-supporting-devices.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaboratorySupportingDevice $laboratorySupportingDevice)
    {
         return view('pages.laboratorySupportingDevices.show', compact('laboratorySupportingDevice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaboratorySupportingDevice $laboratorySupportingDevice)
    {
        $dataSupportingDevices = DataSupportingDevice::latest()->get();
        return view('pages.laboratorySupportingDevices.edit', compact('dataSupportingDevices', 'laboratorySupportingDevice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LaboratorySupportingDeviceRequest $request, LaboratorySupportingDevice $laboratorySupportingDevice)
    {
        $laboratorySupportingDevice->update([
            'laboratory_room_id'      => $laboratorySupportingDevice->laboratory_room_id,
            'supporting_device_number'      => $laboratorySupportingDevice->supporting_device_number,
            'condition'      => $request->condition,
            'date'      => $request->date,
            'description'      => $request->description,
            'name'      => $request->name,
            'merk'      => $request->merk,
            'model_or_type'      => $request->model_or_type,
        ]);
        return redirect()->route('laboratory-supporting-devices.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratorySupportingDevice $laboratorySupportingDevice)
    {
        $laboratorySupportingDevice->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data Deleted Successfully'
        ]);
    }

    public function getSupportingDevice(DataSupportingDevice $dataSupportingDevice)
    {
        if ($dataSupportingDevice) {
            return response()->json([
                'name' => $dataSupportingDevice->name,
                'merk' => $dataSupportingDevice->merk,
                'model_or_type' => $dataSupportingDevice->model_or_type,
            ]);
        } else {
            return response()->json(['error' => 'Computer not found.']);
        }
    }
}
