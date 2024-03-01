<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <label for="laboratoryNumber">Laboratory Number</label>
            <input
                type="text"
                class="form-control @error('laboratory_number') is-invalid @enderror"
                id="laboratoryNumber"
                required
                aria-describedby="laboratory_number"
                value="{{ $latestIdLabRoom }}"
                readonly
            />
        </div>
    </div>
    <div class="col-12">
        <div class="mb-4">
            <label for="name">Name</label>
            <div class="input-group">
                <span class="input-group-text">Laboratory</span>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    required
                    aria-describedby="name"
                    value="{{ $laboratoryRoom->name ?? old('name') }}"
                />
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="mb-4">
            <label for="name">PIC</label>
            <div class="input-group">
                <input
                    type="text"
                    class="form-control @error('pic') is-invalid @enderror"
                    id="pic"
                    name="pic"
                    required
                    aria-describedby="pic"
                    value="{{ $laboratoryRoom->pic ?? old('pic') }}"
                />
            </div>
        </div>
    </div>
</div>
