<x-app-layout>
    <h1 class="mb-0">Add SubCategory</h1>
    <hr />
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <select name="CategoryID" class="form-control">
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option class="text-black">{{ $category->CategoryID }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col">
                <input type="text" name="SubCategoryName" class="form-control" placeholder="SubCategoryName">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <input type="file" name="Image" class="form-control-file">
            </div>
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn bg-primary">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>
