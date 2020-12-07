<?php
// This script adds a new forum post to the forum.json file
// @author Isabel
// Last modified 12/7/2020

$path = "../../data/forum.json";

// get details for new post
$postTitle = $_POST['postTitle'];
$postContent = $_POST['postContent'];
$postAuthor = $_POST["uname"];

// and current unix timestamp
$postTime = time();

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

//Format the new post in the same way
$post = ["title"=>$postTitle, 
  "author"=>$postAuthor,
  "content"=>$postContent,
  "score"=>0,
  "posted"=>$postTime,
  "active"=>$postTime,
  "responses"=>[]
];

//Add it to the array
$posts[] = $post;

//And put the array back into the json file
file_put_contents($path, json_encode($posts));
?>