<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/subcategory.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<x-app-layout>
    <div class="rounded ">
        @foreach ($subcategories as $subcategory)
            @if ($topic->SubCategoryID== $subcategory->SubCategoryID)
            <a href="{{ route('subcategory', $topic->SubCategoryID)}}"  style="text-decoration: none; color: inherit;">
                <div id="header" class="row p-4  text-dark border border-primary border-4-bottom bg-primary">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-1">
                                <i class="icon-undo text-dark"></i>
                                {{-- <div>
                                    <x-heroicon-o-arrow-down style="width: 1.5rem; height: 1.5rem;" />
                                </div> --}}
                            </div>
                            <div class="col-4 text-dark">
                                <div>
                                    <div class="row fw-bold fs-5">
                                       {{ $topic->TopicName }}
                                      </div>
                                    <div class="row">
                                        @php
                                             $wordCount = 0; // Khởi tạo biến đếm
                                             $wordCountLearned=0;
                                       @endphp
                                        @foreach ($words as $word)
                                            @if ($topic->TopicID == $word->TopicID)
                                                @php
                                                    $wordCount++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach ($words as $word)
                                        @foreach ($histories as $history)
                                        @if ($topic->TopicID == $word->TopicID && $word->WordID==$history->WordID)
                                                @php
                                                    $wordCountLearned++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                                                @endphp
                                         @endif
                                        @endforeach
                                       
                                    @endforeach
                                        {{ $wordCountLearned }}/{{  $wordCount }}
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </a>
            @endif
        @endforeach
       
    </div>
    @foreach($words as $word)
    @if($topic->TopicID == $word->TopicID)
    <div style="margin-top: 0px" >
        <div class="row ">
            <div class="col-3"></div>
            <div class="col-6 voca">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 theme">
                        <div class="row text-primary">
                           {{ $word->EnglishMeaning }} 
                        </div>
                        <div class="row text-dark">
                           {{ $word->VietNamMeaning }} 
                        </div>
                    </div>
                    <div class="col-1" style="cursor: pointer;">
                        <button type="button" class="btn add add-button-{{ $word->WordID }}" data-word-id="{{ $word->WordID }}">
                            <i class="icon-folder-plus text-primary"></i>
                        </button>
                        
                      
                        {{-- <x-ri-add-fill class="text-primary" style="width: 1.5rem; height: 1.5rem;"/> --}}
                    </div>
                </div>
               
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    @endif
    @endforeach
    <div id="buttonfixed">
             <a href="{{ route('review', $topic->TopicID)}}"> <button type="button" class="btn bg-primary" style="width: 300px">Review </button></a>
            <a href="{{ route('flashcard', $topic->TopicID)}}"> <button type="button" class="btn bg-info" style="width: 300px">  FlashCard </button></a>
    </div>
    <br> <br>
    <script>
        var words = @json($words);
        var folder = @json($folders);


        @foreach($words as $word)
            $(".add-button-{{ $word->WordID }}").on("click", function() {
                var userId = {{ $userId }};
                var wordId = $(this).data("word-id");

                console.log(userId);
                console.log(wordId);

                // Gửi dữ liệu lên máy chủ sử dụng Ajax
                $.ajax({
            type: "POST",
            url: "/save-folder",
            
            data: {
                _token: "{{ csrf_token() }}", // Đảm bảo bạn đang gửi token CSRF
                wordId: wordId,
                userId: userId,
            },
            success: function(response) {
                // Xử lý kết quả nếu cần
            },
        });

                // Tiến hành hiển thị từ vựng tiếp theo
            });
        @endforeach



    </script>
</x-app-layout>
