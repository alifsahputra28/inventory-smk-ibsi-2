<?php

namespace App\Http\Controllers;

use App\Models\DataSupportingDevice;
use App\Models\LaboratoryComputer;
use App\Models\LaboratorySupportingDevice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
    $computerLabour= LaboratoryComputer::all()->count();
    $dataSupportingDevice= DataSupportingDevice::all()->count();
    $outdatedComputer = LaboratoryComputer::whereIn('condition', ['Outdated'])->get()->count();
    $outdatedSupportingDevice = LaboratorySupportingDevice::whereIn('condition', ['Outdated'])->get()->count();
    return view('pages.dashboard.index', compact('computerLabour', 'dataSupportingDevice', 'outdatedComputer', 'outdatedSupportingDevice'));
   }
}
