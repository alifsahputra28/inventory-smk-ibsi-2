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
                    Table: Laboratory Supporting Devices
                </li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Laboratory Supporting Devices</h1>
                <p class="mb-0">
                    Presents data on the supporting devices used in the laboratory.
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Lab Support Devices
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
                <table class="table-laboratory-supporting-devices table-centered table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">MERK</th>
                            <th class="text-center">MODEL/TYPE</th>
                            <th class="text-center">CONDITION</th>
                            <th class="text-center">DATE</th>
                            <th class="text-center">DESCRIPTION</th>
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
                                <td><a href="{{ route('laboratory-supporting-devices.create', ['laboratory_room' => $item->id]) }}"
                                        class="btn btn-warning">Choose</a></td>
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
        var table = $(".table-laboratory-supporting-devices").DataTable({
            processing: true,
            serverSide: true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass(`Row${data.id}`);
            },
            ajax: "{{ route('laboratory-supporting-devices.index') }}",
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "name", name: "name" },
                { data: "merk", name: "merk" },
                { data: "model_or_type", name: "model_or_type" },
                { data: "condition", name: "condition" },
                { data: "date", name: "date" },
                { data: "description", name: "description" },
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