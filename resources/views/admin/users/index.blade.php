<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List User') }}
        </h2>
    </x-slot>
    <div class="bg-white">
        {{-- <div class="d-flex align-items-center justify-content-between">
            <h1  class="mb-0 text-bold">List User</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
        </div> --}}
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>UserType</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0) <!-- Đổi $user thành $users để phù hợp với tên biến bạn đã sử dụng trong bảng -->
        @foreach($users as $user) <!-- Đổi $user thành $users và $rs thành $user để phù hợp với tên biến bạn đã sử dụng trong vòng lặp -->
            <tr>
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->email }}</td> <!-- Thêm trường email vào bảng -->
                <td class="align-middle">{{ $user->usertype }}</td> <!-- Thêm trường usertype vào bảng -->
                <td class="align-middle">{{ $user->created_at }}</td> <!-- Thêm trường created_at vào bảng -->
                <td class="align-middle">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.users.show', $user->id) }}" type="button" class="btn bg-secondary"></i> Detail</a>
                        {{-- <a href="{{ route('admin.users.edit', $user->id)}}" type="button" class="btn bg-warning">Edit</a> --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" type="button" class="btn bg-danger p-0"  onsubmit="return confirm('Delete?')">
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
