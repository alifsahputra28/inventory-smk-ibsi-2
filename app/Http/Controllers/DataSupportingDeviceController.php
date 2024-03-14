<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataSupportingDeviceRequest;
use App\Models\DataSupportingDevice;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataSupportingDeviceController extends Controller
{
    use HasImage;
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:data-supporting-list', ['only' => ['index']]);
         $this->middleware('permission:data-supporting-create', ['only' => ['create','store']]);
         $this->middleware('permission:data-supporting-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:data-supporting-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataSupportingDevice::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('data-supporting-devices.edit', ['data_supporting_device'   => $id]);
                    $url_show       = route('data-supporting-devices.show', $id);
                    $url_delete     = route('data-supporting-devices.destroy', $id);

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
        return view('pages.dataSupportingDevices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataSupportingDevice = new DataSupportingDevice;
        return view('pages.dataSupportingDevices.create', compact('dataSupportingDevice'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataSupportingDeviceRequest $request)
    {
        $image = $this->uploadImage($request, $path = 'public/data-supporting-devices/');
        DataSupportingDevice::create([
            'name'              => $request->name,
            'merk'              => $request->merk,
            'model_or_type'     => $request->model_or_type,
            'description'       => $request->description,
            'image'             => $image->hashName(),
        ]);
        return redirect()->route('data-supporting-devices.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSupportingDevice $dataSupportingDevice)
    {
        return view('pages.dataSupportingDevices.show', compact('dataSupportingDevice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSupportingDevice $dataSupportingDevice)
    {
        return view('pages.dataSupportingDevices.edit', compact('dataSupportingDevice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataSupportingDeviceRequest $request, DataSupportingDevice $dataSupportingDevice)
    {
        $image = $this->uploadImage($request, $path = 'public/data-supporting-devices/');

        if ($request->file('image')) {
            Storage::disk('local')->delete('public/data-supporting-devices/' . basename($dataSupportingDevice->image));
            $dataSupportingDevice->update([
                'name'              => $request->name,
                'merk'              => $request->merk,
                'model_or_type'     => $request->model_or_type,
                'description'       => $request->description,
                'image'             => $image->hashName(),
            ]);
        }

        $dataSupportingDevice->update([
            'name'              => $request->name,
            'merk'              => $request->merk,
            'model_or_type'     => $request->model_or_type,
            'description'       => $request->description,
        ]);
        return redirect()->route('data-supporting-devices.index')->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSupportingDevice $dataSupportingDevice)
    {
      $dataSupportingDevice->delete();
        Storage::disk('local')->delete('public/data-supporting-devices/' . basename($dataSupportingDevice->image));
        return response()->json([
            'success'   => true,
            'message'   => 'Data Deleted Successfully'
        ]);
    }
}
