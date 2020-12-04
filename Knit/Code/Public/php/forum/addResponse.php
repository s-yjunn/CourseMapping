<?php
//This script adds a new response to the post at the given index
// @author Isabel

$path = "../../data/forum.json";

//get details for new response
$parentPostIndex = $_POST['parent'];
$responseContent = $_POST['responseContent'];
//Including currently logged in user (has to be done in this file since ppl can change accounts after the main page loads)
session_start();
$responseAuthor = $_SESSION["username"];
//And current timestamp (UTC)
$responseTime = time();

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

//Format the new response to be pushed
$response = ["author"=>$responseAuthor, "content"=>$responseContent, "score"=>0, "posted"=>$responseTime];

//Add it to the response array of its parent post
array_push($posts[$parentPostIndex]['responses'], $response);

//Update the active time for its parent post
$posts[$parentPostIndex]["active"] = $responseTime;

//And put the larger array back into the json file
file_put_contents($path, json_encode($posts));
?>