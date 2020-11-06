<?php
//This script adds a new forum post to the forum.json file
$path = "../../data/forum.json";

//get details for new response
$parentPostIndex = $_GET['parent'];
$responseContent = $_GET['responseContent'];
//Including currently logged in user (has to be done in this file since ppl can change accounts after the main page loads)
session_start();
$responseAuthor = $_SESSION["username"];

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

//Format the new response to be pushed
$response = ["author"=>$responseAuthor, "content"=>$responseContent, "score"=>0];

//Add it to the response array of its parent post
array_push($posts[$parentPostIndex]['responses'], $response);

//And put the larger array back into the json file
file_put_contents($path, json_encode($posts));

//Output a success message
echo "<p>Your response was posted.</p>";
?>