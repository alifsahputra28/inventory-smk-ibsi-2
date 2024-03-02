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
                Edit Laboratory Device
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit Laboratory Supporting Device</h1>
            <p class="mb-0">Form to edit laboratory supporting device.</p>
        </div>
        <div>
            <a
                href="{{ route('laboratory-supporting-devices.index') }}"
                class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>

<form
    action="{{ route('laboratory-supporting-devices.update', $laboratorySupportingDevice->id) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @method('PATCH')
    @csrf
    @include('pages.laboratorySupportingDevices.__form')
</form>

<div
    class="modal fade"
    id="chooseDataComputerModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Table Data Computers
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="container p-4">
                <div class="border border-grey rounded p-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Processor</th>
                                <th>VGA</th>
                                <th>RAM</th>
                                <th>Disk Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dataComputersTableBody">
                            <!-- Data Computers table will be populated dynamically using JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
