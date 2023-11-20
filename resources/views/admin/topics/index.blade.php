<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Topic') }}
        </h2>
    </x-slot>
    <div class="bg-white">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.topics.create') }}" class="btn btn-primary"><i class="icon-add-solid"></i> Add Topic</a>
        </div>
        <hr />
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>STT</th>
                    <th>Topic Name</th>
                    <th>Image</th>
                    <th>SubCategoryID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($topics->count() > 0)
                @foreach($topics as $topic)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $topic->TopicName }}</td>
                        <td class="align-middle">
                            <img src=" {{ $topic->Image }}" alt="" style="width: 5.5rem; height: 5.5rem;">
                         </td>
                        {{-- <td class="align-middle">{{ $topic->Image }}</td> --}}
                        <td class="align-middle">{{ $topic->SubCategoryID }}</td>
                       
                      
                        <td class="align-middle">
                            <!-- Rest of your code for edit and delete buttons -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- <a href="{{ route('admin.categories.show', $category->CategoryID) }}" type="button" class="btn bg-secondary">Detail</a> --}}
                                <a  href="{{ route('admin.topics.edit', $topic->TopicID)}}" type="button" class="btn bg-warning "><i class="icon-edit"></i> Edit</a>
                                <form action="{{ route('admin.topics.destroy', $topic->TopicID) }}" method="POST" type="button" class="btn bg-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0"><i class="icon-bin"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            
            </tbody>
        </table>
    </div>
 
</x-app-layout>
