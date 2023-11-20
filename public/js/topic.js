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

