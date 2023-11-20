<x-app-layout>
    <h1 class="mb-0">Add Category</h1>
    <hr />
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="CategoryName" class="form-control" placeholder="CategoryName">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn bg-primary">Submit</button>
            </div>
        </div>
    </form>
</x-app-layout>
