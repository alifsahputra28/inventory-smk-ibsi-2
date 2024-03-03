@extends('layouts.main') @section('content')
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
            <li class="breadcrumb-item active" aria-current="page">
                Table: Laboratory Computer
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Laboratory Computer</h1>
            <p class="mb-0">
                Presents data on the computers used in the laboratory.
            </p>
        </div>
        <div>
            {{--
            <a
                href="{{ route('laboratory-computers.create') }}"
                class="btn btn-gray-600 d-inline-flex align-items-center"
            >
                Add Lab Computers
            </a>
            --}}
            <!-- Button trigger modal -->
            @if (Auth::user()->can('Lab RPL'))
            <a
                href="{{ route('laboratory-computers.create', ['laboratory_room' => $laboratoryRoomsId]) }}"
                class="btn btn-primary"
                >Add Lab Computers</a
            >
            @elseif(Auth::user()->can('Lab Akuntansi'))
            <a
                href="{{ route('laboratory-computers.create', ['laboratory_room' => $laboratoryRoomsId]) }}"
                class="btn btn-primary"
                >Add Lab Computers</a
            >
            @elseif(Auth::user()->can('Lab Administrasi Perkantoran'))
            <a
                href="{{ route('laboratory-computers.create', ['laboratory_room' => $laboratoryRoomsId]) }}"
                class="btn btn-primary"
                >Add Lab Computers</a
            >
            @elseif(Auth::user()->can('Lab Pemasaran'))
            <a
                href="{{ route('laboratory-computers.create', ['laboratory_room' => $laboratoryRoomsId]) }}"
                class="btn btn-primary"
                >Add Lab Computers</a
            >
            @else
            <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
            >
                Add Lab Computers
            </button>
            @endif
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    {{-- START FILTER --}}
    <div class="row input-daterange m-4">
        <div class="col-md-2">
            <input
                type="text"
                name="from_date"
                id="from_date"
                class="form-control"
                placeholder="From Date"
                readonly
            />
        </div>
        <div class="col-md-2">
            <input
                type="text"
                name="to_date"
                id="to_date"
                class="form-control"
                placeholder="To Date"
                readonly
            />
        </div>
        <div class="col-md-4">
            <button
                type="button"
                name="filter"
                id="filter"
                class="btn btn-primary me-2"
            >
                Filter
            </button>
            <button
                type="button"
                name="refresh"
                id="refresh"
                class="btn btn-secondary"
            >
                Refresh
            </button>
        </div>
    </div>
    {{-- END FILTER --}}
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="table-responsive">
            <table
                class="table-laboratory-computers table-centered table-nowrap mb-0"
                id="table-laboratory-computers"
            >
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Lab Room</th>
                        <th class="text-center">Computer Number</th>
                        <th class="text-center">Merk</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">Ram</th>
                        <th class="text-center">Disk Size</th>
                        <th class="text-center">Condition</th>
                        <th class="text-center">Entry Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="staticBackdrop"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    Choice Lab
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laboratoryRooms as $item)
                        <tr class="text-center">
                            <td>{{ $item->name }}</td>
                            <td>
                                <a
                                    href="{{ route('laboratory-computers.create', ['laboratory_room' => $item->id]) }}"
                                    class="btn btn-warning"
                                    >Choose</a
                                >
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

<script>
    $(document).ready(function () {
        $(".input-daterange").datepicker({
            todayBtn: "linked",
            format: "yyyy-mm-dd",
            autoclose: true,
        });

        load_data();

        function load_data(from_date = "", to_date = "") {
            $("#table-laboratory-computers").DataTable({
                processing: true,
                serverSide: true,
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass(`Row${data.id}`);
                },
                ajax: {
                    url: "{{ route('laboratory-computers.index') }}",
                    data: { from_date: from_date, to_date: to_date },
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    { data: "LaboratoryRoom", name: "LaboratoryRoom" },
                    { data: "computer_number", name: "computer_number" },
                    { data: "merk", name: "merk" },
                    { data: "model", name: "model" },
                    { data: "ram", name: "ram" },
                    { data: "disk_size", name: "disk_size" },
                    { data: "condition", name: "condition" },
                    { data: "date", name: "date" },
                    {
                        data: "action",
                        name: "action",
                        orderable: true,
                        searchable: true,
                    },
                ],
                dom: "Blfrtip",
                buttons: [
                    {
                        text: '<i class="bi bi-printer"></i> Print',
                        extend: "print",
                        title: "",
                        message: `<div class="row">
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('assets/img/logo-smk-ibnu-sina.png') }}" class="text-center ms-4" alt="Logo SMK IBNU SINA" width="100" height="100" />
                                </div>
                                <div class="col-8 d-flex justify-content-center align-items-center">
                                    <div class="text-center mt-3">
                                    <h4 class="mb-0 fw-bolder" style="color: #019b4d">YAYASAN PENDIDIKAN IBNU SINA BATAM</h4>
                                    <h5 class="mb-0 fw-bolder" style="color: #019b4d">SEKOLAH MENENGAH KEJURUAN (SMK)</h5>
                                    <p class="mb-0">JL. Teuku Umar Lubuk Baja Kota Telp. (0778)4286721</p>
                                    <p class="mb-0 text-info">Email : smkibsibatam2018@gmail.com</p>
                                    <h5 class="mb-0 fw-bolder" style="color: #019b4d">KOTA BATAM</h5>
                                    </div>
                                </div>
                            </div>
                            <hr style=" border: 2px solid #019b4d;">`,
                        className: "btn btn-primary mb-3",
                        exportOptions: {
                            columns: [0,1, 2, 3, 4, 5, 6, 7, 8],
                        },
                        customize: function (win) {
                            $(win.document.body).css(
                                "background-color",
                                "#ffff"
                            );
                        },
                    },
                ],
                columnDefs: [
                    {
                        orderable: false,
                        targets: -1,
                    },
                ],
            });
        }

        $("#filter").click(function () {
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (from_date != "" && to_date != "") {
                $("#table-laboratory-computers").DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert("Both Date is required");
            }
        });

        $("#refresh").click(function () {
            $("#from_date").val("");
            $("#to_date").val("");
            $("#table-laboratory-computers").DataTable().destroy();
            load_data();
        });
    });
</script>
@endsection
