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
                        
                        <div class="col-2">
                            <div class="">
                                
                              </div>
                        </div>
                        <div class="col-4">
                            <div>
                               
                                <div class="row fw-bold fs-5">
                                  My Folder
                                    
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
                <div class="col-7">
                </div>
                </div>
            </div>
        </a>
    </div>
    
    <div style="margin-top: 0px" >
        @foreach ($folders as $folder)
         @if ($folder->UserID == $userId)
            @foreach ($words as $word)
                
           @if ($folder->WordID == $word->WordID)
               
           
             
        
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
                            <form action="{{ route('destroy', $folder->FolderID) }}" method="POST" type="button" class="btn p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn ">
                                    <i class="icon-folder-minus text-primary"></i>
                                </button>
                            </form>
                            {{-- <x-ri-add-fill class="text-primary" style="width: 1.5rem; height: 1.5rem;"/> --}}
                        </div>
                    </div>
                   
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        @endif
                @endforeach
                @endif
        @endforeach
      
    </div>
    <div id="buttonfixed">
       
        <a href="{{ route('folderreview')}}"> <button type="button" class="btn bg-primary" style="width: 300px">  Review </button></a>
        
       
            <a href="{{ route('folderflashcard')}}"> <button type="button" class="btn bg-info" style="width: 300px">  FlashCard </button></a>
        
    </div>
    
</x-app-layout>
