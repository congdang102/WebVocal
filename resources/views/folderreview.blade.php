<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/flashcard.css') }}">
</head>
<x-app-layout>
  
        <div class="rounded bg-primary">
            <a href="/folder" style="text-decoration: none; color: inherit;">
                <div id="header" class="row p-4  text-white ">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-1">
                                <i class="icon-undo text-white"></i>
                            </div>
                            <div class="col-4">
                                <div>
                                    <div class="row fw-bold fs-5">
                                        {{-- {{ $topic->TopicName }} --}}
                                    </div>
                                    <div class="row">
                                        @php
                                        $wordCount =0;
                                        $wordLearned=0;
                                    @endphp
                                    @foreach ($folders as $folder)
                                        @if ($folder->UserID == $userId  )
                                            @php
                                                $wordCount++;
                                            @endphp                      
                                        @endif
                                    @endforeach
                                    @foreach ($folders as $folder)
                                        @if ($folder->UserID == $userId  )
                                            @foreach ($folderhistories as $folderhistory)
                                            @if ($folder->WordID == $folderhistory->WordID)
                                                    @php
                                                    $wordLearned++;
                                                    @endphp  
                                            @endif
                                              
                                            @endforeach
                                                            
                                    @endif
                                @endforeach
                                    {{ $wordLearned }}/{{  $wordCount }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                    </div>
                </div>
            </a>
        </div>
        <div class="card1 text-white">
            <div class="front face">
                <div class="word"></div>
            </div>
            <div class="back face">
                <div>
                    <div class="row">
                        <div class="col">
                            <img src="" alt="" class="img-fluid mx-auto d-block" style="width: 3.5rem; height: 3.5rem;">
                        </div>
                    </div>
                </div>
                <div class="meaning"></div>
             
            </div>
        </div>
        <div class="card2 text-white" style="display: none">
            <div class="front2 face2 bg-info text-white">
                <div class="word2">Congratuations! You have fishned everything!</div>
                <div>
                    <button id="btn-browse-again" type="button" class="btn mx-1 bg-primary btn-reverse">Browers all again</button>
                </div>
            </div>
            
        </div>
        <div class="text-center mt-5">
            <button type="button" class="btn mx-1 bg-primary btn-back">Back</button>
            <button type="button" class="btn mx-1 bg-primary btn-next" id="btn-next" aria-label="Next Word">Next</button>
    
        </div>
    
    
    <script>
        document.querySelector(".card1").addEventListener("click", () => {
            document.querySelector(".card1 .front").classList.toggle("flipped");
            document.querySelector(".card1 .back").classList.toggle("back-flipped");
            document.querySelector(".card1").classList.add("lift-card");
    
            setTimeout(() => {
                document.querySelector(".card1").classList.remove("lift-card");
            }, 1000);
        });
    
        var words = @json($words);
        var folders = @json($folders);
        var folderhistories = @json($folderhistories);
        var currentIndex = 0;
        var userId = {{ $userId }};
        // Khởi tạo danh sách filteredWords
        var filteredWords = words.filter(function(word) {
            return folders.some(function(folder) {
                return word.WordID === folder.WordID && folder.UserID == userId && folderhistories.some(function(folderhistory) {
                    return word.WordID === folderhistory.WordID;
                });
            });
        });
    
        var currentIndex = 0;
        function showWord(index) {
        if (index >= 0 && index < filteredWords.length) {
            $(".word").text(filteredWords[index].EnglishMeaning);
            $(".meaning").text(filteredWords[index].VietNamMeaning);
            $(".img-fluid").attr("src", filteredWords[index].Image);
        } else {
            if (index >= filteredWords.length) {
                // Hiển thị card2 nếu đã vượt quá số lượng từ vựng
                $(".card1").hide();
                $(".card2").show();
                $(".btn-next").hide();
                $(".btn-back").hide();
            }
        }
    }
        $("#btn-browse-again").on("click", function() {
        currentIndex = 0;
        showWord(currentIndex);
        $(".card1").show();
        $(".card2").hide();
        $(".btn-next").show();
        $(".btn-back").show();
    });

    // var viewedWords = [];
        var currentIndex = 0;

        $("#btn-next").on("click", function() {
            var userId = {{ $userId }};

            if (currentIndex < filteredWords.length) {
                var currentWord = filteredWords[currentIndex];
                var wordId = currentWord.WordID;
                // Gửi dữ liệu lên máy chủ sử dụng Ajax
        //         $.ajax({
        //     type: "POST",
        //     url: "/save-folderhistory",
        //     data: {
        //         _token: "{{ csrf_token() }}", // Đảm bảo bạn đang gửi token CSRF
        //         wordId: wordId,
        //         userId: userId,
        //     },
        //     success: function(response) {
        //         // Xử lý kết quả nếu cần
        //     },
        // });


                // Tiến hành hiển thị từ vựng tiếp theo
                currentIndex++;
                showWord(currentIndex);
            }
        });


            $(".btn-back").on("click", function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    showWord(currentIndex);
                }
            });

            showWord(currentIndex);
    </script>
    <br> <br>
    
</x-app-layout>
