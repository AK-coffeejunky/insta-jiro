{{-- Edit Modal --}}
<div class="modal fade" id="edit-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 modal-title">
                    <i class="fas fa-edit"></i> Edit Category
                </h3>
            </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 modal-title">
                    <i class="fas fa-trash-alt"></i> Delete Category
                </h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <p class="text-muted">This action will affect all the posts under this category. The posts will not be deleted but will no longer have a category.</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
