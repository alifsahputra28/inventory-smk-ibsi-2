<div class="row">
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
                value="{{ $dataComputer->merk ?? old('merk') }}"
            />
        </div>
    </div>
    <div class="col">
        <div class="mb-4">
            <label for="model">Model</label>
            <input
                type="text"
                class="form-control @error('model') is-invalid @enderror"
                id="model"
                name="model"
                required
                aria-describedby="model"
                value="{{ $dataComputer->model ?? old('model') }}"
            />
        </div>
    </div>
</div>
<h2 class="h5 mb-4">Spesification</h2>
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
                value="{{ $dataComputer->processor ?? old('processor') }}"
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
                value="{{ $dataComputer->vga ?? old('vga') }}"
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
                value="{{ $dataComputer->ram ?? old('ram') }}"
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
                value="{{ $dataComputer->disk_size ?? old('disk_size') }}"
            />
        </div>
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
            />
        </div>
    </div>
</div>
