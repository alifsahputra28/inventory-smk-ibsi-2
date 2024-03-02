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
                value="{{ $dataSupportingDevice->name }}"
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
                value="{{ $dataSupportingDevice->merk }}"
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
                value="{{ $dataSupportingDevice->model_or_type }}"
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
            value="{{ $dataSupportingDevice->description }}"
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
            {{ $dataSupportingDevice->id ===null ? 'required' : '' }} />
    </div>
</div>
