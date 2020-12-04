<?php
// This script adds a new vote to the post or response at the given index
// @author Isabel

$path = "../../data/forum.json";

//get details for new vote
$vote = $_POST['vote'];
$type = $_POST['type'];
$index = $_POST['index'];

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

//Array path is slightly different for posts
if ($type == "post") {
    $index = intval($index);
    if ($vote == "up") {
        $posts[$index]["score"] += 1;
    //If downvote, decrease by one
    } else {
        $posts[$index]["score"] -= 1;
    }
//than for comments
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
}

//Put the larger array back into the json file
file_put_contents($path, json_encode($posts));
?>