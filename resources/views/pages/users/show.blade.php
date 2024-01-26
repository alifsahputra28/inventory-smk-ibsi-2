@extends('layouts.main') @section('content')
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
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">Table: User</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                User Name: {{ $user->name }}
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">User</h1>
            <p class="mb-0">Contains details of the user.</p>
        </div>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                <ul class="list-group list-group-flush border-top-0">
                    <li
                        class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                    >
                        <p class="mb-0 text-black-50">Name</p>
                        <h5>{{ $user->name }}</h5>
                    </li>
                    <li
                        class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                    >
                        <p class="mb-0 text-black-50">E-mail</p>
                        <h5>{{ $user->email }}</h5>
                    </li>
                    <li
                        class="list-group-item d-flex align-items-center justify-content-between px-0 border-bottom"
                    >
                        <p class="mb-0 text-black-50">Role</p>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <span class="badge badge-success">{{ $v }}</span>
                            @endforeach
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
