<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">


  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="CSS/styles.css">
</head>

<body>

  <script src="JS/script.js"> </script>

  <?php 
  $logFile = "../../../../Private/CommunityPosts/allPosts.JSON";

  

  $arrayOfPosts = file_get_contents(__DIR__ . "../../../../Private/CommunityPosts/allPosts.JSON");
  $postsArray = (json_decode($arrayOfPosts, true));
  //echo var_dump($postshArray);
  $byTitle = array();

  foreach ($postsArray as $key => $jsons) { 
      $newArray = array($jsons["postTitle"],$jsons["Author"],$jsons["datePublication"],$jsons["Text"],$jsons["comments"]);
      array_push($byTitle, $newArray);
  }

  echo "<div>";
  foreach ($byCategory as $newArray) {
    echo "<ul>";
    echo "<b> <button class='fixedButton' onclick='displayContent(".$newArray[3].")' id='".$newArray[3]."'> " . $newArray[0] . "</button></b> ";
    echo "</ul>";
  }
  echo "</div>";
  ?>


  <div id="Merch" class="center">
    <div id="wrapper" class="wrapper">
    </div>
  </div>


</body>


</html>





