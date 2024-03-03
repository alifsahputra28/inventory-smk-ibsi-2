<div class="card border-0 shadow components-section">
    <div class="card-body">
        <h2 class="h5">Data Computer</h2>
        <button
            type="button"
            class="btn btn-primary w-100 mb-4"
            data-bs-toggle="modal"
            data-bs-target="#chooseDataComputerModal"
        >
            <i class="ri-search-2-line"></i> Choose Data Computers
        </button>
        <div class="row">
            <div class="col">
                <div class="mb-4">
                    <label for="merk">Merk</label>
                    <input
                        type="text"
                        class="form-control @error('merk') is-invalid @enderror"
                        id="selectedComputerMerk"
                        name="merk"
                        required
                        aria-describedby="merk"
                        required
                        readonly
                        value="{{ $laboratoryComputer->merk ?? old('merk')}}"
                    />
                </div>
            </div>
            <div class="col">
                <div class="mb-4">
                    <label for="model">Model</label>
                    <input
                        type="text"
                        class="form-control @error('model') is-invalid @enderror"
                        id="selectedComputerModel"
                        name="model"
                        required
                        aria-describedby="model"
                        required
                        readonly
                        value="{{ $laboratoryComputer->model ?? old('model')}}"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4">
                    <label for="processor">Processor</label>
                    <input
                        type="text"
                        class="form-control @error('processor') is-invalid @enderror"
                        id="processor"
                        name="processor"
                        required
                        aria-describedby="processor"
                        required
                        readonly
                        value="{{ $laboratoryComputer->processor ?? old('processor')}}"
                    />
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4">
                    <label for="vga">VGA</label>
                    <input
                        type="text"
                        class="form-control @error('vga') is-invalid @enderror"
                        id="vga"
                        name="vga"
                        required
                        aria-describedby="vga"
                        required
                        readonly
                        value="{{ $laboratoryComputer->vga ?? old('vga')}}"
                    />
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4">
                    <label for="ram">RAM / GB</label>
                    <input
                        type="number"
                        class="form-control @error('ram') is-invalid @enderror"
                        id="ram"
                        name="ram"
                        required
                        aria-describedby="ram"
                        required
                        readonly
                        value="{{ $laboratoryComputer->ram ?? old('ram')}}"
                    />
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="mb-4">
                    <label for="diskSize">Disk Size / GB</label>
                    <input
                        type="number"
                        class="form-control @error('disk_size') is-invalid @enderror"
                        id="disk_size"
                        name="disk_size"
                        required
                        aria-describedby="disk_size"
                        required
                        readonly
                        value="{{ $laboratoryComputer->disk_size ?? old('disk_size')}}"
                    />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card border-0 shadow components-section mt-3">
    <div class="card-body">
        <h2 class="h5 mb-3">Computer Information</h2>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="mb-4">
                    <label for="supportingDeviceNumber"
                        >Computer Number</label
                    >
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('computer_number') is-invalid @enderror"
                            id="supportingDeviceNumber"
                            name="computer_number"
                            required
                            aria-describedby="computer_number"
                            readonly
                            value="{{ ($laboratoryComputerNumber === null) ? 'COM0001' :  $laboratoryComputerNumber}}"
                        />
                        <label for="supportingDeviceNumber"
                            >Computer numbering starts from</label
                        >
                    </div>
                </div>
            </div>
            @if ($laboratoryComputer->id === null)
            <div class="col-lg-12 col-sm-12">
                <div class="mb-4">
                    <label for="diskSize">Amount</label>
                    <input
                        type="number"
                        class="form-control @error('amount') is-invalid @enderror"
                        id="amount"
                        name="amount"
                        required
                        aria-describedby="amount"
                    />
                </div>
            </div>
            @endif
            <div class="col-lg-12 col-sm-12">
                <div class="mb-4">
                    <label for="condition">Condition</label>
                    <select
                        class="form-select"
                        aria-label="Default select example"
                        name="condition"
                        value="{{ $laboratoryComputer->condition ?? old('condition')}}"
                    >
                        <option selected>Open this select</option>
                        <option {{ $laboratoryComputer->
                            condition === 'Good' ? 'selected' : '' }}
                            value="Good">Good
                        </option>
                        <option {{ $laboratoryComputer->
                            condition === 'Good Enough' ? 'selected' : '' }}
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
                        value="{{ $laboratoryComputer->date ?? old('date')}}"
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
                        >{{ $laboratoryComputer->description ?? old('description')}}</textarea
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

{{-- Modal Data Computers --}}
<div
    class="modal fade"
    id="chooseDataComputerModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Table Data Computers
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
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Processor</th>
                                <th>VGA</th>
                                <th>RAM</th>
                                <th>Disk Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataComputers as $item)
                            <tr>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->processor }}</td>
                                <td>{{ $item->vga }}</td>
                                <td>{{ $item->ram }}</td>
                                <td>{{ $item->disk_size }}</td>
                                <td>
                                    <a
                                        class="btn btn-warning choose-computer"
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
