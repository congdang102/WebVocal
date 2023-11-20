<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/folder.css') }}">
    <link rel="stylesheet" href="{{ asset('Icon/style.css') }}">
     
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<x-app-layout>
    <div class="rounded ">
            <div id="header" class="row p-4  text-white border border-primary border-4-bottom">
                <div class="col-5">
                
             
                    <div class="row">
                       
                        <div class="col-1">
                            <a href="/home" style="text-decoration: none; color: inherit;">
                                <i class="icon-undo text-white"></i>
                            </a>
                            {{-- <div>
                                <x-heroicon-o-arrow-down style="width: 1.5rem; height: 1.5rem;" />
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <div>
                                <div class="row fw-bold fs-5">
                                    Love
                                  </div>
                                  
                                <div class="row">
                                    0/30
                                </div>
                        </div>
                    </div>
                </div>
        
     
            </div>
                <div class="col-7 d-flex justify-content-end">
                    <button type="button" class="btn text-white">
                        <i class="icon-edit">Edit name</i>
                    </button>
                    <button type="button" class="btn text-white">
                        <i class="icon-bin">Delete this folder</i>
                    </button>
              
                   

                   
                </div>
            </div>
            
       
    </div>
    <div style="margin-top: 0px" >
        <div class="row ">
            <div class="col-3"></div>
            <div class="col-6 voca">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="row text-primary">
                            March
                        </div>
                        <div class="row text-white">
                            "none" Thang 3
                        </div>
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn ">
                            <i class="icon-folder-minus text-white"></i>
                        {{-- <x-ri-add-fill style="width: 1.5rem; height: 1.5rem;"/> --}}
                    </button> 
                       
                        {{-- <x-ri-add-fill class="text-primary" style="width: 1.5rem; height: 1.5rem;"/> --}}
                    </div>
                </div>
               
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div id="buttonfixed">
            <button type="button" class="btn bg-primary" style="width: 300px">Review</button>
            <button type="button" class="btn bg-info" style="width: 300px"> <a href="/flashcard">FlashCard</a></button>
    </div>
    <br> <br>
{{-- <script src="{{ asset('js/home.js') }}"></script> --}}
</x-app-layout>
