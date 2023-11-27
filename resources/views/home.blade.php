<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Icon/style.css') }}">
     
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<x-app-layout>
  <div class=" p-4 bg-primary text-white rounded" style="background-color: rgb(36, 188, 36); color: aliceblue; height: 100px;">
    <div class="row">
        <div class="row">
            <div class="fw-bold ">
              <button id="sign-in" type="button" class="rounded-5 d-flex align-items-center flex-shrink-1 text-dark ">Choose folder to learn</button>
            </div>
        </div>
    </div>
  </div>
<div class="container-fluid text-white">
<div class="row">
<div class="col-2"></div>
<div class="col-8">
  
  
  <div class="row">
    @foreach($categories as $category)
    <div class="fw-bold fs-4 toggle-button1">
      <div class="row" class="text-dark">
        <div class="col-10" style="color: black;">
          {{ $category->CategoryName}}
          
        </div>
        <div class="col-2">
          <span class="toggle-icon"><i class="icon-arrow-up2 text-dark"></i> </span> <!-- Mũi tên hướng xuống (▶) -->
        </div>
      </div>
  </div>
  @foreach($subcategories as $subcategory)
  @if($category->CategoryID == $subcategory->CategoryID)
    <div class="col-4 bg-white mx-2" style="background-image: url({{ $subcategory->Image }}); background-size: cover; background-repeat: no-repeat; background-position: center;">
      <a href="{{ route('subcategory', $subcategory->SubCategoryID)}}" class="bg-white">
        <div class="col rounded" id="toggleDiv1">
          <div class="overlay rounded-1"  style="position: relative;">
            <div class="item" style="position: relative; margin-top: 130px;">
              <div class="item-content">
                <span class="text-dark fw-bold">{{ $subcategory->SubCategoryName }}</span>
                <p class="text-dark">
                  @php
                  $wordCount = 0; // Khởi tạo biến đếm
                  $wordCountLearned = 0;
                 @endphp
              
              @foreach ($topics as $topic )
                  @if ($topic->SubCategoryID == $subcategory->SubCategoryID)
                      @foreach ($words as $word)
                          @if ($topic->TopicID == $word->TopicID)
                              @php
                                  $wordCount++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                              @endphp
                          @endif
                      @endforeach
                  @endif
              @endforeach
              @foreach ($topics as $topic )
                  @if ($topic->SubCategoryID == $subcategory->SubCategoryID)
                      @foreach ($words as $word)
                          @foreach ($histories as $history)
                              @if ($topic->TopicID == $word->TopicID && $word->WordID == $history->WordID)
                                  @php
                                      $wordCountLearned++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                                  @endphp
                              @endif 
                          @endforeach
                         
                      @endforeach
                  @endif
              @endforeach
                {{ $wordCountLearned }} / {{ $wordCount }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
   
  @endif
@endforeach

  @endforeach
  </div>

    <br>
    <br>
  </div>

</div>
<div class="col-2"></div>
</div>


<script src="{{ asset('js/home.js') }}"></script>
</x-app-layout>
