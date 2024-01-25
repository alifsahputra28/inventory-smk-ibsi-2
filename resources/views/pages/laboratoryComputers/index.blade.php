@extends('layouts.main')

@section('content')
<section>
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
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
                {{-- <a href="{{ route('laboratory-computers.create') }}"
                    class="btn btn-gray-600 d-inline-flex align-items-center">
                    Add Lab Computers
                </a> --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Lab Computers
                </button>
            </div>
        </div>
    </div>


    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table-laboratory-computers table-centered table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">MERK</th>
                            <th class="text-center">MODEL</th>
                            <th class="text-center">PROCESSOR</th>
                            <th class="text-center">VGA</th>
                            <th class="text-center">RAM</th>
                            <th class="text-center">DISK SIZE</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Choice Lab</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <td><a href="{{ route('laboratory-computers.create', ['laboratory_room' => $item->id]) }}" class="btn btn-warning">Choose</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        var table = $(".table-laboratory-computers").DataTable({
            processing: true,
            serverSide: true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass(`Row${data.id}`);
            },
            ajax: "{{ route('laboratory-computers.index') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "merk", name: "merk" },
                { data: "model", name: "model" },
                { data: "processor", name: "processor" },
                { data: "vga", name: "vga" },
                { data: "ram", name: "ram" },
                { data: "disk_size", name: "disk_size" },
                {
                    data: "action",
                    name: "action",
                    orderable: true,
                    searchable: true,
                },
            ],
        });
    });
</script>
@endsection