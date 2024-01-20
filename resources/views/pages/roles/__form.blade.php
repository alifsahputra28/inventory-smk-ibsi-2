<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong class="mb-3">Name</strong>
            <input type="text" name="name" value="{{ $role->name }}" placeholder="Name"
                class="form-control mt-3">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row">
            <strong class="my-3">Permission</strong>
            <div class="col-4">
                <div class="card" style="background-color: #eaeaea">
                    <h4 class="m-2">Dashboard</h4>
                    <div class="card-body">
                        @foreach ($permissionDashboard as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #eaeaea">
                    <h4 class="m-2">Roles</h4>
                    <div class="card-body">
                        @foreach ($permissionRoles as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #eaeaea">
                    <h4 class="m-2">Users</h4>
                    <div class="card-body">
                        @foreach ($permissionUsers as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>