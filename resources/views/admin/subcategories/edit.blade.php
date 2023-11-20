<x-app-layout>
    <h1 class="mb-0 fw-bold">Edit SubCategory</h1>
    <hr />
  
    <form action="{{ route('admin.subcategories.update', $subcategory->SubCategoryID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <label class="form-label fw-bold">CategoryID</label>
                <select name="CategoryID" class="form-control">
                    <option value="{{ $subcategory->CategoryID }}">{{ $subcategory->CategoryID }}</option>
                    @foreach($categories as $category)
                        <option class="text-black">{{ $category->CategoryID }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label fw-bold">SubCategory Name</label>
                <input type="text" name="SubCategoryName" class="form-control" placeholder="CategoryName" value="{{ $subcategory->SubCategoryName }}" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <input type="file" name="Image" class="form-control-file">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
    </x-app-layout>
    