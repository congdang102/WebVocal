<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin dashboard') }}
        </h2>
    </x-slot>
    <div class="row bg-white text-dark">
        <div class="col-1">
            
        </div>
        <div class="col-3 bg-primary ">
            <a href="{{ route('admin.users.index')}}">
                <div class="row">
                    <div class="col-10">
                        <span class="fw-bold fs-3">User</span><br>
                        Số lượng người đăng ký: {{ $users->count() }}
                    </div>
                    <div class="col-2">
                        <img src="/storage/user.png" class="block h-9 w-auto fill-current text-gray-800" alt="">
                    </div>
                </div>
            </a>
            
           
        </div>
        <div class="col-1">
            
        </div>
        <div class="col-3 bg-info ">
            <a href="{{ route('admin.categories.index')}}" >
                <div class="row">
                    <div class="col-10">
                        <span class="fw-bold fs-3"> Category</span>  <br>
                  Số lượng danh mục: {{ $categories->count() }}
                    </div>
                    <div class="col-2">
                        <img src="/storage/categories.png" class="block h-9 w-auto fill-current text-gray-800" alt="">
                    </div>
                </div>
                
              </a>
          
        </div>
        <div class="col-1">

        </div>
        <div class="col-3 bg-warning ">
            <a href="{{ route('admin.subcategories.index')}}" >
                <div class="row">
                    <div class="col-10">
                        <span class="fw-bold fs-3"> SubCategory</span>  <br>
                        Số lượng danh mục con: {{ $subcategories->count() }}
                    </div>
                    <div class="col-2">
                        <img src="/storage/subcategories.png" class="block h-9 w-auto fill-current text-gray-800" alt="">
                    </div>
                </div>
              </a>
        </div>
    </div>
    <div class="row bg-white text-dark my-5">
        <div class="col-1">
            
        </div>
        <div class="col-3 bg-success ">
            <a href="{{ route('admin.topics.index')}}" >
                <div class="row">
                    <div class="col-10">
                        <span class="fw-bold fs-3"> Topic</span>  <br>
                        Số lượng chủ đề : {{ $topics->count() }}
                    </div>
                    <div class="col-2">
                        <img src="/storage/topic.png" class="block h-9 w-auto fill-current text-gray-800" alt="">
                    </div>
                </div>
              </a>
        </div>
        <div class="col-1">
            
        </div>
        <div class="col-3 bg-secondary ">
            <a href="{{ route('admin.words.index')}}" >
                <div class="row">
                    <div class="col-10">
                        <span class="fw-bold fs-3"> Word</span>  <br>
                        Số lượng từ vựng: {{ $words->count() }}
                    </div>
                    <div class="col-2">
                        <img src="/storage/word.png" class="block h-9 w-auto fill-current text-gray-800" alt="">
                    </div>
                </div>
              </a>
        </div>
        <div class="col-1">

        </div>
        <div class="col-3 ">
            
        </div>
    </div>
</x-app-layout>
