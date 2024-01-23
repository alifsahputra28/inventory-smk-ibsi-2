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
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                    Data Computers
                </button>
                <button type="button" class="list-group-item list-group-item-action">Data Supporting
                    Devices</button>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-0 shadow mb-4">
                <div class="mt-3 mx-3">
                    <a href="{{ route('laboratoryComputer.create', ['laboratory_room' => $laboratoryRoom->id]) }}"
                        class="btn btn-success float-end">Create Data Computers</a>
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
                        <table class="table table-bordered" id="table-laboratory-computers">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">COMPUTER NUMBER</th>
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
</section>


<script type="text/javascript">
    $(function () {
              var table = $('#table-laboratory-computers').DataTable({
                  processing: true,
                  serverSide: true,
                  createdRow: function (row, data, dataIndex)
                    {
                      $(row).addClass(`Row${data.id}`);
                    },
                  ajax: "{{ route('laboratoryComputer.index', $laboratoryRoom->id) }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                      {data: 'computer_number', name: 'computer_number'},
                      {data: 'amount', name: 'amount'},
                      {data: 'action', name: 'action',
                        orderable: true, 
                        searchable: true},
                  ]
              });
              
            });
</script>
@endsection