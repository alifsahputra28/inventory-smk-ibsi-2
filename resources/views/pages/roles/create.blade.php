@extends('layouts.main')
@section('content')
    <section>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="float-end">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
        
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                           @include('pages.roles.__form')
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection