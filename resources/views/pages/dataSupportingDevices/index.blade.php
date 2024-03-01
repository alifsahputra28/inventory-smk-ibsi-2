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
            <li class="breadcrumb-item active" aria-current="page">
                Table: Data Supporting Devices
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Data Supporting Devices</h1>
            <p class="mb-0">
                A database of supporting devices in laboratory computer merk,
                models and specifications.
            </p>
        </div>
        <div>
            <a
                href="{{ route('data-supporting-devices.create') }}"
                class="btn btn-gray-600 d-inline-flex align-items-center"
            >
                Add Data Supporting Devices
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 offset-md-6"></div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="table-responsive">
            <table
                class="table-data-supporting-devices table-centered table-nowrap mb-0"
            >
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Model</th>
                        <th class="text-center">Model/Type</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var table = $(".table-data-supporting-devices").DataTable({
            processing: true,
            serverSide: true,
            createdRow: function (row, data, dataIndex) {
                $(row).addClass(`Row${data.id}`);
            },
            ajax: "{{ route('data-supporting-devices.index') }}",
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
