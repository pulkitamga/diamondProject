@extends('admin.layouts.master')

@section('main_section')
    <h3>Role Management</h3>

    <!---Add Role Button--->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add Role</button>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="role-list">
            {{-- @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm rounded-pill edit-role" data-id="{{ $role->id }}"
                            data-name="{{ $role->name }}" data-bs-toggle="modal" data-bs-target="#editRoleModal"><i
                                class="fa fa-edit"></i></button>
                        <!-- Delete Role Button -->
                        <button class="btn rounded-pill btn-danger btn-sm delete-role" data-id="{{ $role->id }}">
                            <i class="fa fa-trash m-0"></i>
                        </button>

                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    <!--Add Diamond Shade Modal-->
    <div id="addDiamondShadeModal" class="modal fade" tabindex="-1" aria-labelledby="shadeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="addDiamondShadeForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shadeModalLabel">Add Diamond Shade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="ds_name" class="form-control mb-2" placeholder="Name" required>
                        <input type="text" name="ds_short_name" class="form-control mb-2" placeholder="Short Name">
                        <textarea name="ds_alise" class="form-control mb-2" placeholder="Alias"></textarea>
                        <textarea name="ds_remark" class="form-control mb-2" placeholder="Remark"></textarea>
                        <input type="number" name="ds_sort_order" class="form-control mb-2" placeholder="Sort Order">
                        <label>
                            <input type="checkbox" name="ds_display_in_front" value="1"> Display in Front
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Shade</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("addDiamondShadeForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('diamond-shade.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            "content"),
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    toastr.success(data.message);
                    this.reset();
                    document.querySelector("#addDiamondShadeModal .btn-close").click();
                    location.reload();
                })
                .catch(err => {
                    console.error(err);
                    toastr.error("Failed to add shade.");
                });
        });
    </script>
@endsection
