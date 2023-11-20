<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/subcategory.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<x-app-layout>
    <div class="rounded bg-primary">
        <a href="/home" style="text-decoration: none; color: inherit;">
            <div id="header" class="row p-4  text-dark border border-primary border-4-bottom">
                <div class="col-5">
                    <div class="row">
                        <div class="col-1">
                            <div>
                                <i class="icon-arrow-down"></i>
                                
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="">
                                <img src="{{ $subcategory->Image }}" class="rounded-4" alt="Loi" style="width: 2.5rem; height: 2.5rem;">
                              </div>
                        </div>
                        <div class="col-4">
                            <div>
                               
                                <div class="row fw-bold fs-5">
                                    {{ $subcategory->SubCategoryName }}
                                    
                                  </div>
                                  
                                <div class="row">
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
                                </div>
                               
                               
                            </div>
                    </div>
                </div>
                <div class="col-7">
                </div>
                </div>
            </div>
        </a>
    </div>
    
    <div style="margin-top: 0px" >
        @foreach($topics as $topic)
        @if($subcategory->SubCategoryID == $topic->SubCategoryID)
        <a href="{{ route('topic', $topic->TopicID)}}" >
            <div class="row theme my-2"  style="cursor: pointer;">
                <div class="col-4">
                </div>
                <div class="col-4  text-dark">
                    <div class="row  ">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ $topic->Image }}" class="rounded-cicle" alt="..." style="width: 5.5rem; height: 5.5rem;">
                          </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center fw-bold">
                        {{ $topic->TopicName }}
                    </div>
                    <div class="row d-flex justify-content-center align-items-center text-primary">
                        <div class="col-3 justify-content-end">
                        </div>
                        <div class="col-1 justify-content-end">
                            <i class="icon-checkbox-checked"></i>
                        </div>
                        <div class="col-2">
                           
                        @php
                            $wordCount = 0; // Khởi tạo biến đếm
                            $wordCountLearned = 0; 
                        @endphp
                        
                        @foreach ($words as $word)
                            @foreach ($histories as $history)
                                @if ($topic->TopicID == $word->TopicID && $word->WordID== $history->WordID)
                                    @php
                                        $wordCountLearned++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                                    @endphp
                                @endif
                            @endforeach
                          
                        @endforeach
                        @foreach ($words as $word)
                        @if ($topic->TopicID == $word->TopicID)
                            @php
                                $wordCount++; // Tăng biến đếm khi tìm thấy từ thỏa mãn điều kiện
                            @endphp
                        @endif
                    @endforeach
                       {{  $wordCountLearned }} / {{ $wordCount }}
                        
                           
                           
                        </div>
                        <div class="col-4">
                            <i class="icon-clock"></i>
                        </div>
                    </div>  
                </div>
                <div class="col-4">
                </div>
            </div>
        </a>
        @endif
        @endforeach
      
    </div>
    <div id="buttonfixed">
       
            {{-- <button type="button" class="btn btn-primary bg-primary" style="width: 300px">Review</button>
        
       
            <button type="button" class="btn bg-warning" style="width: 300px">Flashcard</button>
         --}}
    </div>
    
    <br> <br>
</x-app-layout>
