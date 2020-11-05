<?php
//This script adds a new forum post to the forum.json file

$posts = json_decode(file_get_contents("../data/forum.json"), true);
$post = json_decode($_REQUEST['post']);
array_unshift($posts, $post);
file_put_contents("../data/forum.json", json_encode($posts));

//This doesn't get used anywhere yet but it will later
echo "Your post was added to the forum.<br>";

?>