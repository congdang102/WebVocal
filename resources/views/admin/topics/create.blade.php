<x-app-layout>
    <h1 class="mb-0">Add Topic</h1>
    <hr />
    <form action="{{ route('admin.topics.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <select name="SubCategoryID" class="form-control">
                    <option value="">Select a SubCategory</option>
                    @foreach($subcategories as $subcategory)
                        <option class="text-black">{{ $subcategory->SubCategoryID }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col">
                <input type="text" name="TopicName" class="form-control" placeholder="TopicName">
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
