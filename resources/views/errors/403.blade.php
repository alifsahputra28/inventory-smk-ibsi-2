@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forbidden</div>

                    <div class="card-body">
                        <p>Sorry, you do not have permission to access this page.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
