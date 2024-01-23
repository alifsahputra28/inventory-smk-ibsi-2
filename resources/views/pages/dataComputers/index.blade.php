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
                <li class="breadcrumb-item">
                    <a href="{{ route('laboratory-rooms.index') }}">Table: Laboratory Computers</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Add Laboratory Computer
                </li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Table Laboratory Data Computer</h1>
                <p class="mb-0">Form to add laboratory computer.</p>
            </div>
            <div>
                @include('partial.buttonBack')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    {{-- START FILTER --}}
                    <div class="row input-daterange mb-5">
                        <div class="col-md-4">
                           {{-- @if (auth()->hasRole('Manajemen'))
                           <a class="btn btn-success" href="{{ route('laboratoryComputer.create', 4) }}"> Create New Data Computers</a>
                           @endif --}}
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Create New Data Computers
                            </button>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="from_date" id="from_date" class="form-control"
                                placeholder="From Date" readonly />
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                                readonly />
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="filter" id="filter" class="btn btn-primary me-2">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
                        </div>
                    </div>
                    {{-- END FILTER --}}
                    <div>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-laboratory-computers">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">NAME LAB</th>
                                <th class="text-center">COMPUTER NUMBER</th>
                                <th class="text-center">DATE</th>
                                <th class="text-center">AMOUNT</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"> Choice Laboratory</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laboratoryRoom as $item)
                           <tr class="text-center">
                                <td>{{ $item->name }}</td>
                                <td><a href="{{ route('laboratoryComputer.create', $item->id) }}" class="btn btn-info">Choice</a></td>
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
            $('#table-laboratory-computers').DataTable({
                processing: true,
                serverSide: true,
                createdRow: function (row, data, dataIndex)
                {
                $(row).addClass(`Row${data.id}`);
                },
                ajax: {
                    url:"{{ route('dataComputer.index') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'laboratoryRoom', name: 'laboratoryRoom.name'},
                      {data: 'computer_number', name: 'computer_number'},
                      {data: 'date', name: 'date'},
                      {data: 'amount', name: 'amount'},
                      {data: 'action', name: 'action',
                        orderable: true, 
                        searchable: true},
          ],
          dom: "Blfrtip",
                buttons: [
                    {
                        text: '<i class="bi bi-filetype-pdf"></i> pdf',
                        extend: 'pdfHtml5',
                        className: 'btn btn-primary mb-3',
                        orientation: 'landscape',
                        exportOptions: {
                            columns:[ 0, 1, 2, 3]
                        }
                    },
                    {
                        text: '<i class="bi bi-printer"></i> Print',
                        extend: 'print',
                        className: 'btn btn-primary mb-3',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3]
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
                $('#table-laboratory-computers').DataTable().destroy();
                load_data(from_date, to_date);
            } else{
                alert('Both Date is required');
            }

        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#table-laboratory-computers').DataTable().destroy();
            load_data();
        });
    });
</script>
@endsection