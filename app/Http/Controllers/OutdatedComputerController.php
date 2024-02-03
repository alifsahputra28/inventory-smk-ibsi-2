<?php

namespace App\Http\Controllers;

use App\Models\LaboratoryComputer;
use App\Models\LaboratoryRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OutdatedComputerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = LaboratoryComputer::latest();
            if (!empty($request->from_date)) {
                if(Auth::user()->can('Lab RPL')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereIn('condition', ['Outdated'])
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-001');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Akuntansi')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereIn('condition', ['Outdated'])
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-002');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Administrasi Perkantoran')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereIn('condition', ['Outdated'])
                    ->whereHas('laboratoryRoom', function ($query) {
                        $query->where('laboratory_number', 'Lab-003');
                    })
                    ->get();
                }elseif(Auth::user()->can('Lab Pemasaran')){
                    $data = LaboratoryComputer::whereBetween('date', array($request->from_date, $request->to_date))
                    ->whereIn('condition', ['Outdated'])
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
                    ->whereIn('condition', ['Outdated'])    
                    ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        });
                } elseif (Auth::user()->can('Lab Akuntansi')) {
                    $data = LaboratoryComputer::latest()
                    ->whereIn('condition', ['Outdated'])    
                    ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        });
                } elseif (Auth::user()->can('Lab Administrasi Perkantoran')) {
                    $data = LaboratoryComputer::latest()
                    ->whereIn('condition', ['Outdated'])    
                    ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        });
                } elseif (Auth::user()->can('Lab Pemasaran')) {
                    $data = LaboratoryComputer::latest()
                    ->whereIn('condition', ['Outdated'])    
                    ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        });
                } else {
                    $data = LaboratoryComputer::whereIn('condition', ['Outdated'])->latest();
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

        return view('pages.outdatedComputer.index', compact('laboratoryRooms', 'laboratoryRoomsId'));
    }
}
