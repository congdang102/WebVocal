<x-app-layout>
    
<h1 class="mb-0 fw-bold">Edit Product</h1>
<hr />
<form action="{{ route('admin.categories.update', $category->CategoryID) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6 mb-3">
            <label class="form-label fw-bold">Category Name</label>
            <input type="text" name="CategoryName" class="form-control" placeholder="CategoryName" value="{{ $category->CategoryName }}" >
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
</x-app-layout>
