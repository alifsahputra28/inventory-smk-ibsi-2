<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                  
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
                                    value="{{ $supportingDeviceInformation->dataSupportingDevice->name ?? old('name') }}"
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
                                    value="{{ $supportingDeviceInformation->dataSupportingDevice->merk ?? old('merk') }}"
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
                                    value="{{ $supportingDeviceInformation->dataSupportingDevice->model_or_type ?? old('model_or_type') }}"
                                />
                            </div>
                        </div>
                    </div>
                        <div class="col">
                            <div class="mb-4">
                                <label for="description">Description</label>
                                <input
                                    type="text"
                                    class="form-control @error('description') is-invalid @enderror"
                                    id="description"
                                    name="description"
                                    required
                                    aria-describedby="description"
                                    value="{{ $supportingDeviceInformation->dataSupportingDevice->description ?? old('description') }}"
                                />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <div class="mb-4">
                                <label for="image">Image</label>
                                <input
                                    type="file"
                                    class="form-control @error('image') is-invalid @enderror"
                                    id="image"
                                    name="image"
                                    aria-describedby="image"
                                    value="{{ $supportingDeviceInformation->dataSupportingDevice->image ?? old('image') }}"
                                />
                            </div>
                        </div>
                     
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
                        <label for="supportingDeviceNumber">Supporting Device Number</label>
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control @error('supporting_device_number') is-invalid @enderror"
                                id="supportingDeviceNumber"
                                name="supporting_device_number"
                                required
                                aria-describedby="supporting_device_number"
                                readonly
                                value="{{ $supportingDeviceInformation->supporting_device_number ?? old('supporting_device_number') }}"
                            />
                            <label for="supportingDeviceNumber"
                                >Supporting device numbering starts from</label
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="mb-4">
                        <label for="diskSize">Amount</label>
                        <input
                            type="number"
                            class="form-control @error('amount') is-invalid @enderror"
                            id="amount"
                            name="amount"
                            required
                            aria-describedby="amount"
                            value="{{ $supportingDeviceInformation->amount ?? old('amount') }}"
                        />
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="mb-4">
                        <label for="condition">Condition</label>
                        <select
                            class="form-select"
                            aria-label="Default select example"
                            name="condition"
                        >
                            <option selected>Open this select</option>
                            <option {{ $supportingDeviceInformation->condition === 'Good' ? 'selected' : '' }} value="Good">Good</option>
                            <option {{ $supportingDeviceInformation->condition === 'Damaged' ? 'selected' : '' }} value="Damaged">Damaged</option>
                            <option {{ $supportingDeviceInformation->condition === 'Lost' ? 'selected' : '' }} value="Lost">Lost</option>
                            <option {{ $supportingDeviceInformation->condition === 'Maintenance' ? 'selected' : '' }} value="Maintenance">Maintenance</option>
                            <option {{ $supportingDeviceInformation->condition === 'Outdated' ? 'selected' : '' }} value="Outdated">Outdated</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="mb-4">
                        <label for="date">Entry Date</label>
                        <input
                            type="date"
                            class="form-control @error('date') is-invalid @enderror"
                            id="date"
                            name="date"
                            required
                            aria-describedby="date"
                            value="{{ $supportingDeviceInformation->date ?? old('date') }}"
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
                        >{{ $supportingDeviceInformation->description ?? old('amount') }}</textarea>
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
        </div>
</div>