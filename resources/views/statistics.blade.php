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
                $wordCount = 0; // Initialize the word count
                $uniqueWordIds = []; // Initialize an array to track unique WordIDs
            @endphp

            @foreach ($histories as $history)
                @if ($history->UserID == $userId)
                    @php
                        // Check if the WordID is not in the array of unique WordIDs
                        if (!in_array($history->WordID, $uniqueWordIds)) {
                            $wordCount++; // Increment the word count
                            $uniqueWordIds[] = $history->WordID; // Add the WordID to the unique WordIDs array
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
                        $wordCount = 0; // Initialize the word count
                        $earliestLearningDate = null; // Initialize the earliest learning date as null
                        $longestStreak = 0; // Initialize the longest consecutive streak
                        $currentStreak = 0; // Initialize the current consecutive streak
                        $prevLearningDate = null; // Initialize the previous learning date
                    
                        // Sort the histories by created_at in descending order
                        $sortedHistories = $histories->where('UserID', $userId)->sortByDesc('created_at');
                        
                        $currentDate = date('Y-m-d');
                        
                        foreach ($sortedHistories as $history) {
                            $learningDate = $history->created_at->toDateString();
                    
                            if ($earliestLearningDate === null) {
                                $earliestLearningDate = $learningDate; // Set the earliest learning date to the first history record
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
                        $wordCount = 0; // Initialize the word count
                        $earliestLearningDate = null; // Initialize the earliest learning date as null
                        $longestStreak = 0; // Initialize the longest consecutive streak
                        $currentStreak = 0; // Initialize the current consecutive streak
                        $prevLearningDate = null; // Initialize the previous learning date
                        @endphp
                        @foreach ($histories as $history)
                            @if ($history->UserID == $userId)
                                @php
                                    // Check if the WordID is not in the array of unique WordIDs
                                    if (!in_array($history->WordID, $uniqueWordIds)) {
                                        $wordCount++; // Increment the word count
                                        $uniqueWordIds[] = $history->WordID; // Add the WordID to the unique WordIDs array
                                    }
                        
                                    // Trích xuất ngày từ dấu thời gian
                                    $currentLearningDate = $history->created_at->toDateString();
                        
                                    if ($earliestLearningDate === null || $currentLearningDate < $earliestLearningDate) {
                                        $earliestLearningDate = $currentLearningDate; // Update the earliest learning date
                                    }
                        
                                    // Kiểm tra nếu có sự gián đoạn trong việc học
                                    if ($prevLearningDate !== null && $currentLearningDate != date('Y-m-d', strtotime('+1 day', strtotime($prevLearningDate)))) {
                                        $currentStreak = 0; // Reset the current streak
                                    }
                        
                                    $currentStreak++; // Increment the current consecutive streak
                        
                                    if ($currentStreak > $longestStreak) {
                                        $longestStreak = $currentStreak; // Update the longest streak
                                    }
                        
                                    $prevLearningDate = $currentLearningDate; // Update the previous learning date
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