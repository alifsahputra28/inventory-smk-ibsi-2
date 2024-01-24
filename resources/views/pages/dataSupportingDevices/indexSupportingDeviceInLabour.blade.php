@extends('layouts.main')
@section('content')
<section class="mt-3">

    {{-- START CARD INFORMATION LAB --}}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5>Name : Lab IT</h5>
                </div>

                <div class="col-6">
                    <h5>Kode Lab : Lab-0001</h5>

                </div>
            </div>
        </div>
    </div>
    {{-- END CARD INFORMATION LAB --}}




    <div class="row mt-5">
        <div class="col-4">
            <div class="list-group border">
                <a  href="{{ route('laboratoryComputer.index', $laboratoryRoom->id) }}"class="list-group-item list-group-item-action" aria-current="true">
                    Data Computers
                </a>
                <a href="{{ route('dataSupportingDevice.index', $laboratoryRoom->id) }}" class="list-group-item list-group-item-action active">Data Supporting
                    Devices</a>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-0 shadow mb-4">
                <div class="mt-3 mx-3">
                    <a href="{{ route('dataSupportingDevice.create', ['laboratory_room' => $laboratoryRoom->id]) }}"
                        class="btn btn-success float-end">Create Data Supporting Device</a>
                </div>
                <div class="card-body">
                    <div>
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-supporting-devices">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">COMPUTER NUMBER</th>
                                <th class="text-center">AMOUNT</th>
                                <th class="text-center">CONDITION</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(function () {
              var table = $('#table-supporting-devices').DataTable({
                  processing: true,
                  serverSide: true,
                  createdRow: function (row, data, dataIndex)
                    {
                      $(row).addClass(`Row${data.id}`);
                    },
                  ajax: "{{ route('dataSupportingDevice.index', $laboratoryRoom->id) }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                      {data: 'supporting_device_number', name: 'supporting_device_number'},
                      {data: 'amount', name: 'amount'},
                      {data: 'condition', name: 'condition'},
                      {data: 'action', name: 'action',
                        orderable: true, 
                        searchable: true},
                  ]
              });
              
            });
</script>
@endsection