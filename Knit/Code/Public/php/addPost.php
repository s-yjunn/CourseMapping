<?php
//This script adds a new forum post to the forum.json file
$path = "../data/forum.json";

//get details for new post
$postTitle = $_GET['postTitle'];
$postContent = $_GET['postContent'];
//Including currently logged in user (has to be done in this file since ppl can change accounts after the main page loads)
session_start();
$postAuthor = $_SESSION["username"];

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

//Format the new post in the same way
$post = ["title"=>$postTitle, "author"=>$postAuthor, "content"=>$postContent, "score"=>0, "responses"=>[]];

//Add it to the array
array_unshift($posts, $post);

//And put the array back into the json file
file_put_contents($path, json_encode($posts));

//This doesn't get used anywhere yet but it will later
echo "<p>\"$postTitle\" was added to the forum.</p>";
?>