<?php
// This script deletes the posted forum post from the forum.json file
// @author Isabel
// Last modified 12/7/2020

$path = "../../data/forum.json";

$postIndex = $_POST["index"];

// Get the collection of existing posts as an array 
$posts = json_decode(file_get_contents($path), true);

// delete the one in question (this leaves all other post indexes intact)
unset($posts[$postIndex]);


// and update the json file
file_put_contents($path, json_encode($posts));
?>