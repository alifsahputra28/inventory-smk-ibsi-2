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
                    <h5>Kode Lab :  Lab-0001</h5>

                </div>
            </div>
        </div>
    </div>
{{-- END CARD INFORMATION LAB --}}



    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="list-group border">
                        <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                            Data Computers
                        </button>
                        <button type="button" class="list-group-item list-group-item-action">Data Supporting Devices</button>
                    </div>
                </div>
                <div class="col-8">
                    Disini data device computer labornya IT
                    <a href="{{ route('laboratoryCreateComputer', ['laboratory_room' => $laboratoryRoom->id]) }}" class="btn btn-success float-end">Create Data Computers</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection