<x-app-layout>
    
    <h1 class="mb-0 fw-bold">Edit Topic</h1>
    <hr />
    <form action="{{ route('admin.topics.update', $topic->TopicID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <label class="form-label fw-bold">SubCategoryID</label>
                <select name="SubCategoryID" class="form-control">
                    <option value="{{ $topic->SubCategoryID }}">{{ $topic->SubCategoryID }}</option>
                    @foreach($subcategories as $subcategory)
                        <option class="text-black">{{ $subcategory->SubCategoryID }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label fw-bold">Topic Name</label>
                <input type="text" name="TopicName" class="form-control" placeholder="TopicName" value="{{ $topic->TopicName }}" >
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
    