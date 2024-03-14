<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataComputersRequest;
use App\Models\DataComputer;
use App\Traits\HasImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataComputerController extends Controller
{
    use HasImage;
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:data-computer-list', ['only' => ['index']]);
         $this->middleware('permission:data-computer-create', ['only' => ['create','store']]);
         $this->middleware('permission:data-computer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:data-computer-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('users')->select('id', 'name', 'email')->orderBy('created_at', 'DESC');
            $data = DataComputer::latest();
            return DataTables::of($data)
                ->addIndexColumn('DT_RowIndex')
                ->addColumn('action', function ($data) {
                    $id             = $data->id;
                    $url_edit       = route('data-computers.edit', $id);
                    $url_show       = route('data-computers.show', $id);
                    $url_delete     = route('data-computers.destroy', $id);

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
        return view('pages.dataComputers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataComputer = new DataComputer;
        return view('pages.dataComputers.create', compact('dataComputer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataComputersRequest $request)
    {
        $image = $this->uploadImage($request, $path = 'public/data-computers/');
        // dd($image);

        DataComputer::create([
            'merk'          => $request->merk,
            'model'         => $request->model,
            'processor'     => $request->processor,
            'vga'           => $request->vga,
            'ram'           => $request->ram,
            'disk_size'     => $request->disk_size,
            'image'         => $image->hashName(),

        ]);
        return redirect()->route('data-computers.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataComputer $dataComputer)
    {
        return view('pages.dataComputers.show', compact('dataComputer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataComputer $dataComputer)
    {
        return view('pages.dataComputers.edit', compact('dataComputer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataComputer $dataComputer)
    {
        $image = $this->uploadImage($request, $path = 'public/data-computers/');

        if ($request->file('image')) {
            Storage::disk('local')->delete('public/data-computers/' . basename($dataComputer->image));

            $dataComputer->update([
                'merk'          => $request->merk,
                'model'         => $request->model,
                'processor'     => $request->processor,
                'vga'           => $request->vga,
                'ram'           => $request->ram,
                'disk_size'     => $request->disk_size,
                'image'         => $image->hashName(),
            ]);
        }
        $dataComputer->update([
            'merk'          => $request->merk,
            'model'         => $request->model,
            'processor'     => $request->processor,
            'vga'           => $request->vga,
            'ram'           => $request->ram,
            'disk_size'     => $request->disk_size,
        ]);
        return redirect()->route('data-computers.index')->with('success', 'Data Update Successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataComputer $dataComputer)
    {
        $dataComputer->delete();
        Storage::disk('local')->delete('public/data-computers/' . basename($dataComputer->image));
        return response()->json([
            'success'   => true,
            'message'   => 'Data Deleted Successfully'
        ]);
    }
}
