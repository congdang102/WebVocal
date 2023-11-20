<x-app-layout>
    <h1 class="mb-0">Add Word</h1>
    <hr />
    <form action="{{ route('admin.words.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <select name="TopicID" class="form-control">
                    <option value="">Select a Topic</option>
                    @foreach($topics as $topic)
                        <option class="text-black">{{ $topic->TopicID }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col">
                <input type="text" name="EnglishMeaning" class="form-control" placeholder="EnglishMeaning">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="VietNamMeaning" class="form-control" placeholder="VietNamMeaning">
            </div>
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
