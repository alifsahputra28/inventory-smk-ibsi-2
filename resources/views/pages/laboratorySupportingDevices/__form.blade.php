<div class="card border-0 shadow components-section">
    <div class="card-body">
        <h2 class="h5">Data Supporting Device</h2>
        <button
            type="button"
            class="btn btn-primary w-100 mb-4"
            data-bs-toggle="modal"
            data-bs-target="#chooseDatasupportingDevicesModal"
        >
            <i class="ri-search-2-line"></i> Choose Data Supprting Devices
        </button>
        <div class="row">
            <div class="col">
                <div class="mb-4">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        required
                        aria-describedby="name"
                        readonly
                        value="{{ $laboratorySupportingDevice->name }}"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-4">
                    <label for="merk">Merk</label>
                    <input
                        type="text"
                        class="form-control @error('merk') is-invalid @enderror"
                        id="merk"
                        name="merk"
                        required
                        aria-describedby="merk"
                        readonly
                        value="{{ $laboratorySupportingDevice->merk }}"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-4">
                    <label for="model_or_type">Model/Type</label>
                    <input
                        type="text"
                        class="form-control @error('model_or_type') is-invalid @enderror"
                        id="model_or_type"
                        name="model_or_type"
                        required
                        aria-describedby="model_or_type"
                        readonly
                        value="{{ $laboratorySupportingDevice->model_or_type }}"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border-0 shadow components-section mt-3">
    <div class="card-body">
        <h2 class="h5 mb-3">Supporting Device Information</h2>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="mb-4">
                    <label for="supportingDeviceNumber"
                        >Supporting Device Number</label
                    >
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('supporting_device_number') is-invalid @enderror"
                            id="supportingDeviceNumber"
                            name="supporting_device_number"
                            required
                            aria-describedby="supporting_device_number"
                            readonly
                            value="{{ ($laboratorySupportingDeviceNumber === null) ? 'DEVICE001' :  $laboratorySupportingDeviceNumber}}"
                        />
                        <label for="supportingDeviceNumber"
                            >Supporting device numbering starts from</label
                        >
                    </div>
                </div>
            </div>
            @if ($laboratorySupportingDevice->id === null)
            <div class="col-lg-6 col-sm-6">
                <div class="mb-4">
                    <label for="diskSize">Amount</label>
                    <input
                        type="number"
                        class="form-control @error('amount') is-invalid @enderror"
                        id="amount"
                        name="amount"
                        required
                        aria-describedby="amount"
                        value="{{ $laboratorySupportingDevice->amount }}"
                    />
                </div>
            </div>
            @endif

            <div class="col-lg-6 col-sm-6">
                <div class="mb-4">
                    <label for="condition">Condition</label>
                    <select
                        class="form-select"
                        aria-label="Default select example"
                        name="condition"
                    >
                        <option selected>Open this select</option>
                        <option {{ ($laboratorySupportingDevice->
                            condition === 'Good') ? 'selected' : '' }}
                            value="Good">Good
                        </option>
                        <option {{ ($laboratorySupportingDevice->
                            condition === 'Good Enough') ? 'selected' : '' }}
                            value="Good Enough">Good Enough
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="mb-4">
                    <label for="date">Entry Date</label>
                    <input
                        type="date"
                        class="form-control @error('date') is-invalid @enderror"
                        id="date"
                        name="date"
                        required
                        aria-describedby="date"
                        value="{{ $laboratorySupportingDevice->date }}"
                    />
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-4">
                <label for="description">Description</label>
                <div class="form-floating">
                    <textarea
                        class="form-control"
                        placeholder="Leave a comment here"
                        id="floatingTextarea2"
                        style="height: 100px"
                        name="description"
                        >{{ $laboratorySupportingDevice->description }}</textarea
                    >
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button
                class="btn btn-gray-600 mt-2 ms-2 animate-up-2 float-end"
                type="submit"
            >
                <i class="ri-send-plane-line me-1"></i>
                Save
            </button>
            <button
                class="btn btn-warning mt-2 animate-up-2 float-end"
                type="reset"
            >
                <i class="ri-refresh-line me-1"></i> Reset
            </button>
        </div>
    </div>
</div>

{{-- MODAL DATA SUPPORTING DEVICES --}}

<div
    class="modal fade"
    id="chooseDatasupportingDevicesModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Table Data Supporting Devices
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="container p-4">
                <div class="border border-grey rounded p-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Merk</th>
                                <th>Model/Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSupportingDevices as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->model_or_type }}</td>
                                <td>
                                    <a
                                        class="btn btn-warning choose-supporting-devices"
                                        data-id="{{ $item->id }}"
                                        >Choose</a
                                    >
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
