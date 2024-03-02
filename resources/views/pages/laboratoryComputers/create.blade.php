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
                <a href="{{ route('laboratory-computers.index') }}"
                    >Table: Laboratory Computers</a
                >
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Add Laboratory Computer
            </li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Add Laboratory Computer</h1>
            <p class="mb-0">Form to add laboratory computer.</p>
        </div>
        <div>
            <a
                href="{{ route('laboratory-computers.index') }}"
                class="btn btn-danger"
                ><i class="ri-arrow-left-line me-2"></i>Back</a
            >
        </div>
    </div>
</div>

<form
    action="{{ route('laboratory-computers.store', ['laboratory_room' => $laboratoryRoom->id]) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @include('pages.laboratoryComputers.__form')
</form>

<script>
    $(document).ready(function () {
        $(".choose-computer").on("click", function () {
            var computerId = $(this).data("id");

            $.ajax({
                type: "GET",
                url: "/get-data-computer/" + computerId,
                success: function (data) {
                    if (data.merk) {
                        $("#selectedComputerMerk").val(data.merk);
                        $("#selectedComputerModel").val(data.model);
                        $("#processor").val(data.processor);
                        $("#vga").val(data.vga);
                        $("#ram").val(data.ram);
                        $("#disk_size").val(data.disk_size);
                        $("#chooseDataComputerModal").modal("hide"); // Optional: Hide the modal after choosing
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
