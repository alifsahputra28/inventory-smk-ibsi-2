<div class="card border-0 shadow components-section">
    <div class="card-body">
        <h2 class="h5">Data Computer</h2>
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
                        value="{{ $computerInformation->dataComputer->merk ?? old('merk') }}"
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
                        value="{{ $computerInformation->dataComputer->model ?? old('model') }}"
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
                        value="{{ $computerInformation->dataComputer->processor ?? old('processor')}}"
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
                        value="{{ $computerInformation->dataComputer->vga ?? old('vga')}}"
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
                        value="{{ $computerInformation->dataComputer->ram ?? old('ram')}}"
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
                        value="{{ $computerInformation->dataComputer->disk_size ?? old('disk_size')}}"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="mb-4">
                        <label for="image">Image</label>
                        <input
                            type="file"
                            class="form-control @error('image') is-invalid @enderror"
                            id="image"
                            name="image"
                            aria-describedby="image"
                            value="{{ $computerInformation->dataComputer->image ?? old('image')}}"
                        />
                    </div>
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
                    <label for="computerNumber">Computer Number</label>
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control @error('computer_number') is-invalid @enderror"
                            id="computerNumber"
                            required
                            aria-describedby="computer_number"
                            value="{{ ($computerInformation->id === null) ? Str::limit($computerNumber->computer_number, 4, $computerNumber->id + 2) : $computerInformation->computer_number}}"
                            {{-- value="{{ $computerInformation->computer_number}}" --}}
                            readonly
                        />
                        <label for="computerNumber"
                            >Computer numbering starts from</label
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
                        value="{{ $computerInformation->amount ?? old('amount')}}"
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
                        <option {{ $computerInformation->condition === 'Good' ? 'selected' : ''}} value="Good">Good</option>
                        <option {{ $computerInformation->condition === 'Damaged' ? 'selected' : ''}} value="Damaged">Damaged</option>
                        <option {{ $computerInformation->condition === 'Lost' ? 'selected' : ''}} value="Lost">Lost</option>
                        <option {{ $computerInformation->condition === 'Maintenance' ? 'selected' : ''}} value="Maintenance">Maintenance</option>
                        <option {{ $computerInformation->condition === 'Outdated' ? 'selected' : ''}} value="Outdated">Outdated</option>
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
                        value="{{ $computerInformation->date ?? old('date') }}"
                    />
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mb-4">
                <label for="description">Description</label>
                <div class="form-floating">
                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Leave a comment here"
                        id="floatingTextarea2"
                        style="height: 100px"
                    >{{ $computerInformation->description ?? old('description')}}</textarea>
                </div>
            </div>
        </div>
        <div class="">
            <Button class="btn btn-success">Submit</Button>
        </div>

    </div>
</div>