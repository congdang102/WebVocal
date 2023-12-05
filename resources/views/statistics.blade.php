<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</head>
<x-app-layout>
  
        <div class="row text-dark my-5">
            <div id="left" class="col-3">
            </div>
            <div id="mid" class="col-6">
                <div class="row bg-primary text-center justify-content-center rounded-4 fw-5">
                    @php
                        $wordCount = 0; 
                        $uniqueWordIds = []; 
                    @endphp
        
                    @foreach ($histories as $history)
                        @if ($history->UserID == $userId)
                            @php
                               
                                if (!in_array($history->WordID, $uniqueWordIds)) {
                                    $wordCount++; 
                                    $uniqueWordIds[] = $history->WordID;
                                }
                            @endphp
                        @endif
                    @endforeach
                            <div class="fw-bold"> <button class="btn btn-light text-primary fw-bold"> {{ $wordCount }} </button>  </div>
                            Words learned 
                </div>
                <div class="row fw-bold fs-4">
                    Streak
                </div>
                <div class="row rounded-4">
                    <div class="col-6 border border-dark rounded-start-4 " >
                        <div class="row">
                            <div class="col-1">
                                <i class="icon-fire" style="color: orange"></i>
                            </div>
                            <div class="col-11">
                                @php
                                $wordCount = 0; 
                                $earliestLearningDate = null;
                                $longestStreak = 0; 
                                $currentStreak = 0; 
                                $prevLearningDate = null; 
                            
                               
                                $sortedHistories = $histories->where('UserID', $userId)->sortByDesc('created_at');
                                
                                $currentDate = date('Y-m-d');
                                
                                foreach ($sortedHistories as $history) {
                                    $learningDate = $history->created_at->toDateString();
                            
                                    if ($earliestLearningDate === null) {
                                        $earliestLearningDate = $learningDate;
                                    }
                            
                                    if ($learningDate === $currentDate) {
                                        $currentStreak++;
                                        $currentDate = date('Y-m-d', strtotime("-1 day", strtotime($currentDate)));
                                    } else {
                                        break;
                                    }
                                }
                            
                                echo '<span class="fw-bold">' . $currentStreak . ' days</span>';
                                // echo ' Current streak';
                                @endphp
                            </div>
                            <p >Current streak</p>
                            
                        </div>
                        <div class="row">
                            @if ($currentStreak > 0)
                                You had the streak today
                            @else
                                Complete one lesson per day to prolong your streak
                            @endif
                        </div>
                        
                    </div>
                
                    <div class="col-6 border border-dark rounded-end-4 ">
                        <div class="row">
                            <div class="col-1">
                                <i class="icon-history text-primary"></i>
                            </div>
                            <div class="col-11">
                                @php
                                $wordCount = 0; 
                                $earliestLearningDate = null; 
                                $longestStreak = 0; 
                                $currentStreak = 0; 
                                $prevLearningDate = null; 
                                @endphp
                                @foreach ($histories as $history)
                                    @if ($history->UserID == $userId)
                                        @php
                                            if (!in_array($history->WordID, $uniqueWordIds)) {
                                                $wordCount++; 
                                                $uniqueWordIds[] = $history->WordID; 
                                            } 
                                            $currentLearningDate = $history->created_at->toDateString();
                                
                                            if ($earliestLearningDate === null || $currentLearningDate < $earliestLearningDate) {
                                                $earliestLearningDate = $currentLearningDate; 
                                            }
                                            if ($prevLearningDate !== null && $currentLearningDate != date('Y-m-d', strtotime('+1 day', strtotime($prevLearningDate)))) {
                                                $currentStreak = 0; 
                                            }
                                
                                            $currentStreak++; 
                                
                                            if ($currentStreak > $longestStreak) {
                                                $longestStreak = $currentStreak; 
                                            }
                                
                                            $prevLearningDate = $currentLearningDate; 
                                        @endphp
                                    @endif
                                @endforeach
                                <span class="fw-bold">{{ $longestStreak }} Days</span>  <br>
                                 Logest streak <br>
                            @if ($longestStreak > 0)
                                <p class="fw-bold">Let's break this record</p>
                            
                            @endif
                           
                            
                            </div>
                        </div>
                        <div class="row">
                           
                            </div>
                    </div>
                </div>
                
                </div>
                <div id="right" class="col-3">
                </div>
        </div>


</x-app-layout>