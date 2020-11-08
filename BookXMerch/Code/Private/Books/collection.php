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
      <button class="barCol buttonClass" onclick="showCollection()" style="width: 200px; font-family"><b>Bookstore</b>x<b>Merch</b></button>
      <button class="barCol buttonClass" onclick="getBookByGenre('comics')">Comic Books</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('children')">Children's Books</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('sci-fi')">Science Fiction</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('fiction')">Fiction</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('nonfiction')">Nonfiction</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('debut-novel')">Debut Novel</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('horror')">Horror</button>
      <button class="barCol buttonClass" onclick="getBookByGenre('romance')">Romance</button>
    </div>
  </div>


  <div id="books" class="center">
    <div id="wrapper" class="wrapper">
    </div>
  </div>

  <div id="original"> 
    <div class="wrapper">

      <div id="comics"> <button class="imgButton" onclick="getBookByGenre('comics')"><img class="imageClass"  src="Images/comics.png" alt="bm"></button></div>
      <div id="children"> <button class="imgButton" onclick="getBookByGenre('children')"> <img class="imageClass" src="Images/children.png" alt="bm"></button></div>
      <div id="sci-fi"> <button class="imgButton" onclick="getBookByGenre('sci-fi')"><img class="imageClass" src="Images/scifi.png" alt="bm"></button></div>
      <div id="fiction"> <button class="imgButton" onclick="getBookByGenre('fiction')"><img class="imageClass" src="Images/fiction.png" alt="bm"></button></div>
      <div id="nonfiction"> <button class="imgButton" onclick="getBookByGenre('nonfiction')"><img class="imageClass" src="Images/nonfiction.png" alt="bm"></button></div>
      <div id="debut-novel"> <button class="imgButton" onclick="getBookByGenre('debut-novel')"><img class="imageClass" src="Images/debutnovel.png" alt="bm"></button></div>
      <div id="horror"> <button class="imgButton" onclick="getBookByGenre('horror')"><img class="imageClass" src="Images/horror.png" alt="bm"></button></div>
      <div id="romance"> <button class="imgButton" onclick="getBookByGenre('romance')"><img class="imageClass" src="Images/romance.png" alt="bm"></button></div>
    </div>
  </div>

</body>


</html>





