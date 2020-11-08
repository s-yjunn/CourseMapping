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

  <div class="sidebar viewBar white viewCard" style="width: 200px">
    <img class="imageClass" src="Images/b&m.png" alt="bm">

    <div class="newFont">
      <a href="#" class="barCol buttonClass" style="width: 200px; font-family"><b>Bookstore</b>x<b>Merch</b></a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('comics')">Comic Books</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('children')">Children's Books</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('scifi')">Science Fiction</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('fiction')">Fiction</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('nonfiction')">Nonfiction</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('debutnovel')">Debut Novel</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('horror')">Horror</a>
      <a href="#" class="barCol buttonClass" onclick="showCollection('romance')">Romance</a>
    </div>
  </div>


  <div class="center">
    <div class="wrapper">
      <div id="comics"><img class="imageClass"  src="Images/comics.png" alt="bm"></div>
      <div id="children"><img class="imageClass" src="Images/children.png" alt="bm"></div>
      <div id="sci-fi"><img class="imageClass" src="Images/scifi.png" alt="bm"></div>
      <div id="fiction"><img class="imageClass" src="Images/fiction.png" alt="bm"></div>
      <div id="nonfiction"><img class="imageClass" src="Images/nonfiction.png" alt="bm"></div>
      <div id="debut-novel"><img class="imageClass" src="Images/debutnovel.png" alt="bm"></div>
      <div id="horror"><img class="imageClass" src="Images/horror.png" alt="bm"></div>
      <div id="romance"><img class="imageClass" src="Images/romance.png" alt="bm"></div>
    </div>
  </div>
  
</body>


</html>

<?php include "php/bookCollection.php";
?>



