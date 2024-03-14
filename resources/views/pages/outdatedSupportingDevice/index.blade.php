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
        </div>
    </div>


    <div class="card border-0 shadow mb-4">
            {{-- START FILTER --}}
            <div class="row input-daterange m-4">
                <div class="col-md-2">
                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                        readonly />
                </div>
                <div class="col-md-2">
                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                    <button type="button" name="filter" id="filter" class="btn btn-primary me-2">Filter</button>
                    <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
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
                <table class="table-laboratory-supporting-devices table-centered table-nowrap mb-0" id="table-laboratory-supporting-devices">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NAME</th>
                            <th class="text-center">MERK</th>
                            <th class="text-center">MODEL/TYPE</th>
                            <th class="text-center">CONDITION</th>
                            <th class="text-center">DATE</th>
                            <th class="text-center">DESCRIPTION</th>
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

<script>
    $(document).ready(function(){
    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format:'yyyy-mm-dd',
        autoclose:true
    });

    load_data();

    function load_data(from_date = '', to_date = ''){
        $('#table-laboratory-supporting-devices').DataTable({
            processing: true,
            serverSide: true,
            createdRow: function (row, data, dataIndex)
            {
            $(row).addClass(`Row${data.id}`);
            },
            ajax: {
                url:"{{ route('data-outdated-supporting-device.index') }}",
                data:{from_date:from_date, to_date:to_date}
            },
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
                // {
                //     data: "action",
                //     name: "action",
                //     orderable: true,
                //     searchable: true,
                // },
      ],
      dom: "Blfrtip",
            buttons: [
                {
                    text: '<i class="bi bi-printer"></i> Print',
                    extend: 'print',
                    title:'',
                    message : `<div class="row">
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
                    className: 'btn btn-primary mb-3',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3,4,5,6]
                    },
                    customize:function(win) {
                        $(win.document.body).css('background-color', '#ffff');
                    }
                },
                
            ],
            columnDefs: [{
                orderable: false,
                targets: -1
            }],

        });
    }

    $('#filter').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        if(from_date != '' &&  to_date != ''){
            $('#table-laboratory-supporting-devices').DataTable().destroy();
            load_data(from_date, to_date);
        } else{
            alert('Both Date is required');
        }

    });

    $('#refresh').click(function(){
        $('#from_date').val('');
        $('#to_date').val('');
        $('#table-laboratory-supporting-devices').DataTable().destroy();
        load_data();
    });
});
</script>
@endsection