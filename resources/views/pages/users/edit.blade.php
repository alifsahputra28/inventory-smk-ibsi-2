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
            <li class="breadcrumb-item">
                <a href="{{ route('users.index') }}">Table: User</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Edit User: {{ $user->name }}
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit User</h1>
            <p class="mb-0">Form to edit user.</p>
        </div>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your
                        input.<br /><br />
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ route('users.update', $user->id) }}"
                    method="POST"
                >
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                value="{{ $user->name }}"
                                name="name"
                                class="form-control"
                                id="name"
                                required
                            />
                        </div>
                        <div class="col-6">
                            <label for="email">E-mail</label>
                            <input
                                type="text"
                                value="{{ $user->email }}"
                                name="email"
                                class="form-control"
                                id="email"
                                required
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="password">Password</label>
                            <input
                                type="text"
                                value="{{ $user->password }}"
                                name="password"
                                class="form-control"
                                id="password"
                                required
                            />
                        </div>
                        <div class="col-6">
                            <label for="confirmPassword"
                                >Confirm Password</label
                            >
                            <input
                                type="text"
                                name="confirm-password"
                                class="form-control"
                                id="confirmPassword"
                                required
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select
                                    name="roles[]"
                                    class="form-control"
                                    multiple
                                >
                                  @foreach($roles as $role)
                                  <option 
                                    value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}
                                  >
                                    {{ $role }}
                                  </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button
                            class="btn btn-gray-600 mt-2 ms-2 animate-up-2 float-end"
                            type="submit"
                        >
                            <i class="ri-send-plane-line me-1"></i> Submit
                        </button>
                        <button
                            class="btn btn-warning mt-2 animate-up-2 float-end"
                            type="reset"
                        >
                            <i class="ri-refresh-line me-1"></i> Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
