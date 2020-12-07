<?php
// This function generates the relative timestamps on the forum menu
// Adapted by Isabel from ? https://gist.github.com/Dipak080/5586bbefde7434b74e29d7bc45b9b8ef ?
// (I'm not sure this was the original source)

function timeAgo($time) { 
    // Calculate difference between current time and given timestamp in seconds 
    $diff= time() - $time;
    
    $sec= $diff;
    $min= round($diff / 60 );
    $hrs= round($diff / 3600);
    $days= round($diff / 86400 );
    $weeks= round($diff / 604800);
    $mnths= round($diff / 2600640 );
    $yrs= round($diff / 31207680 );

    if($sec <= 60) { 
        return "Less than a minute ago"; 
    }
    else if($min < 60) { 
        if($min==1) { 
            return "A minute ago"; 
        } 
        else { 
            return "$min minutes ago"; 
        } 
    } 
    
    // Check for hours 
    else if($hrs < 24) { 
        if($hrs == 1) { 
            return "An hour ago"; 
        } 
        else { 
            return "$hrs hours ago"; 
        } 
    } 
    
    // Check for days 
    else if($days < 7) { 
        if($days == 1) { 
            return "A day ago"; 
        } 
        else { 
            return "$days days ago"; 
        } 
    } 
    
    // Check for weeks 
    else if($weeks < 4.3) { 
        if($weeks == 1) { 
            return "A week ago"; 
        } 
        else { 
            return "$weeks weeks ago"; 
        } 
    } 
    
    // Check for months 
    else if($mnths < 12) { 
        if($mnths == 1) { 
            return "A month ago"; 
        } 
        else { 
            return "$mnths months ago"; 
        } 
    } 
    
    // Check for years 
    else { 
        if($yrs == 1) { 
            return "A year ago"; 
        } 
        else { 
            return "$yrs years ago"; 
        } 
    } 
}
?>