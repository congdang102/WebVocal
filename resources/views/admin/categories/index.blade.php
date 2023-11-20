<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Category') }}
        </h2>
    </x-slot>
    <div class="bg-white">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="icon-add-solid"></i>
                Add Category
            </a>
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
                    <th>CategoryName</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count() > 0)
                    @foreach($categories as $category)
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $category->CategoryName }}</td>
                            <td class="align-middle">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin.categories.edit', $category->CategoryID) }}" type="button" class="btn bg-warning"><i class="icon-edit"></i> Edit </a>
                                    <form action="{{ route('admin.categories.destroy', $category->CategoryID) }}" method="POST" type="button" class="btn bg-danger p-0" onsubmit="return confirm('Delete?')">
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
        {{ $categories->links() }} <!-- Hiển thị nút phân trang -->
    </div>
</x-app-layout>
