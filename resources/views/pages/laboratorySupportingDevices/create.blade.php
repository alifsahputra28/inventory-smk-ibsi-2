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
                <a href="{{ route('laboratory-supporting-devices.index') }}"
                    >Table: Laboratory Supporting Devices</a
                >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Add Laboratory Device
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Add Laboratory Supporting Device</h1>
            <p class="mb-0">Form to add laboratory supporting device.</p>
        </div>
        <div>
            <a
                href="{{ route('laboratory-supporting-devices.index') }}"
                class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>

<form
    action="{{ route('laboratory-supporting-devices.store', ['laboratory_room' => $laboratoryRoom->id]) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf @include('pages.laboratorySupportingDevices.__form')
</form>

<script>
    $(document).ready(function () {
        $(".choose-supporting-devices").on("click", function () {
            var supportingDevicesId = $(this).data("id");

            $.ajax({
                type: "GET",
                url: "/get-data-supporting-devices/" + supportingDevicesId,
                success: function (data) {
                    if (data.name) {
                        $("#name").val(data.name);
                        $("#merk").val(data.merk);
                        $("#model_or_type").val(data.model_or_type);
                        $("#chooseDatasupportingDevicesModal").modal("hide"); // Optional: Hide the modal after choosing
                    } else {
                        console.error("Error: " + data.error);
                    }
                },
                error: function (error) {
                    console.error("Error: " + error.statusText);
                },
            });
        });
    });
</script>

@endsection
