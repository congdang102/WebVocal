<x-app-layout>
    
    <h1 class="mb-0 fw-bold">Edit Topic</h1>
    <hr />
    <form action="{{ route('admin.words.update', $word->WordID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <label class="form-label fw-bold">SubCategoryID</label>
                <select name="TopicID" class="form-control">
                    <option value="{{ $word->TopicID }}">{{ $word->TopicID }}</option>
                    @foreach($topics as $topic)
                        <option class="text-black">{{ $topic->TopicID }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label fw-bold">English Meaning</label>
                <input type="text" name="EnglishMeaning" class="form-control" placeholder="English meaning" value="{{ $word->EnglishMeaning }}" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label fw-bold">VietNam Meaning</label>
                <input type="text" name="VietNamMeaning" class="form-control" placeholder="VietNam meaning" value="{{ $word->VietNamMeaning }}" >
            </div>
            <div class="col my-4">
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
    