@extends('layouts.main')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg
                        class="icon icon-xxs"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        ></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('laboratory-supporting-devices.index') }}"
                    >Table: Laboratory Supporting Devices</a
                >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Detail Laboratory Supporting Devices:
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Detail Laboratory Supporting Devices</h1>
            <p class="mb-0">Contains details of the laboratory supporting devices.</p>
        </div>
        <div>
            <a href="" class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card p-3">
                            <h2 class="h5 mb-4">Data Supporting Device</h2>
                            <ul
                                class="list-group list-group-flush border-top-0"
                            >
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Name</p>
                                    <h5>{{ $laboratorySupportingDevice->name }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Merk</p>
                                    <h5>{{ $laboratorySupportingDevice->merk }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Model / Type</p>
                                    <h5>{{ $laboratorySupportingDevice->model_or_type }}</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card p-3 mb-3">
                            <h2 class="h5 mb-4">Supporting Device Information</h2>
                            <ul
                                class="list-group list-group-flush border-top-0"
                            >
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Supporting Device Number</p>
                                    <h5>{{ $laboratorySupportingDevice->supporting_device_number }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Condition</p>
                                    <h5>{{ $laboratorySupportingDevice->condition }}</h5>
                                </li>
                                <li
                                    class="list-group-item px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">
                                        Description
                                    </p>
                                    <p class="fs-6">{{ $laboratorySupportingDevice->description }}</p>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="row mt-4">
                  <div class="col">
                    <div class="card p-3 mb-3">
                            <h2 class="h5 mb-4">Laboratory Room</h2>
                            <ul
                                class="list-group list-group-flush border-top-0"
                            >
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Laboratory Number</p>
                                    <h5>{{ $laboratorySupportingDevice->laboratoryRoom->laboratory_number }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">Laboratory Name</p>
                                    <h5>{{ $laboratorySupportingDevice->laboratoryRoom->name }}</h5>
                                </li>
                                <li
                                    class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                                >
                                    <p class="mb-0 text-black-50">PIC</p>
                                    <h5>{{ $laboratorySupportingDevice->laboratoryRoom->pic }}</h5>
                                </li>
                            </ul>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
