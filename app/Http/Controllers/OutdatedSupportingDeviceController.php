<?php

namespace App\Http\Controllers;

use App\Models\LaboratoryRoom;
use App\Models\LaboratorySupportingDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OutdatedSupportingDeviceController extends Controller
{
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
                    $data = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        })
                        ->get();
                } elseif ($CanAkuntansi) {
                    $data = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        })
                        ->get();
                } elseif ($CanAdministrasiPerkantoran) {
                    $data = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        })
                        ->get();
                } elseif ($CanPemasaran) {
                    $data = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        })
                        ->get();
                } else {
                    $data = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->whereBetween('date', array($request->from_date, $request->to_date))->get();
                }
            } else {
                if ($CanRPL) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-001');
                        });
                } elseif ($CanAkuntansi) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-002');
                        });
                } elseif ($CanAdministrasiPerkantoran) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-003');
                        });
                } elseif ($CanPemasaran) {
                    $data = LaboratorySupportingDevice::latest()
                        ->whereIn('condition', ['Outdated'])
                        ->whereHas('laboratoryRoom', function ($query) {
                            $query->where('laboratory_number', 'Lab-004');
                        });
                } else {
                    $data = LaboratorySupportingDevice::latest()->whereIn('condition', ['Outdated']);
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

        return view('pages.outdatedSupportingDevice.index', compact('laboratoryRooms', 'laboratoryRoomsId'));
    }
}
