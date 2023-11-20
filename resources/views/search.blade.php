<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<x-app-layout>
<div class="search-wrapper">
    <div class="input-holder">
        <input type="text" class="search-input text-white" placeholder="Keywork..." oninput="searchWords(this.value)" />
        <button class="search-icon" onclick="searchToggle(this, event);"><span></span></button>
    </div>
    <span class="close" onclick="searchToggle(this, event);"></span>
</div>

<div style="margin-top: 130px" id="wordList" style="display: none;">
    @foreach($words as $word)
    <div class="row word-container" style="display: none">
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
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
    @endforeach
</div>

<script>
    //Hieu ung mo o search
    function searchToggle(obj, evt) {
        var container = $(obj).closest('.search-wrapper');

        if (!container.hasClass('active')) {
            container.addClass('active');
            evt.preventDefault();
        } else if (container.hasClass('active') && $(obj).closest('.input-holder').length === 0) {
            container.removeClass('active');
            // Xóa nội dung trong ô tìm kiếm
            container.find('.search-input').val('');

            // Ẩn danh sách từ điển
            $("#wordList").hide();
        }
    }
    //Tim kiem tu vung
    function searchWords(searchTerm) {
    searchTerm = searchTerm.toLowerCase();
    var displayedWordCount = 0;

    if (searchTerm === "") {
        // Ô tìm kiếm trống, ẩn danh sách từ điển
        $("#wordList").hide();
    } else {
        // Hiển thị danh sách từ điển và tìm kiếm kết quả
        $("#wordList").show();
        $(".word-container").each(function() {
            var englishMeaning = $(this).find(".text-primary").text().toLowerCase();

            if (englishMeaning.includes(searchTerm) && displayedWordCount < 10) {
                $(this).show();
                displayedWordCount++;
            } else {
                $(this).hide();
            }
        });
    }
}


    //Them tu vung
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
