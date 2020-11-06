<?php
//This script adds a new forum post to the forum.json file
$path = "../../data/forum.json";

//get details for new vote
$vote = $_GET['vote'];
$type = $_GET['type'];
$index = $_GET['index'];

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

function compare($a, $b) {
    return $b["score"] - $a["score"];
}

//Array path is slightly different for posts
if ($type == "post") {
    $index = intval($index);
    if ($vote == "up") {
        $posts[$index]["score"] += 1;
    //If downvote, decrease by one
    } else {
        $posts[$index]["score"] -= 1;
    }
    //Then sort all posts by score
    uasort($posts, "compare");
//Than for comments
} else {
    $indexes = json_decode($index, true);
    $postIndex = $indexes[0];
    $responseIndex = $indexes[1];
    //If upvote, increase score by one
    if ($vote == "up") {
        $posts[$postIndex]["responses"][$responseIndex]["score"] += 1;
    //If downvote, decrease by one
    } else {
        $posts[$postIndex]["responses"][$responseIndex]["score"] -= 1;
    }
    //Then sort this post's comments by score
    uasort($posts[$postIndex]["responses"], "compare");
}

//And put the larger array back into the json file
file_put_contents($path, json_encode($posts));
?>