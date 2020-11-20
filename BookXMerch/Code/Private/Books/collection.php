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
  <link rel="stylesheet" href="CSS/bookshelf.css"> 
</head>

<body>

  <script src="JS/script5.js"> </script>

  <div class="login-navbar">
    <?php 
    include("../../Public/General/loginHeader.php");
    ?>
  </div>

  <div class="page-content-collections"> 
    <!-- Page Content -->
    <div class="sidebar viewBar white viewCard" style="width: 200px">
      <a href="../../Public/General/index.php"> <img class="imageClass" src="Images/B&M.png" alt="bm" > </a>

      <div class="newFont">
        <button class="barCol buttonClass" onclick="showCollection()" style="width: 200px; font-family"><b>Full B</b>x<b>M Collection</b></button>
        <button class="barCol buttonClass" onclick="booksOfMonth()" style="width: 200px; font-family">Book of the Month</button>
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

    <div id="books" class="margin-left: 240px">
      <div id="wrapper">
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


    <div id="booksOfMonth" style="display:none"> 
    <br>
    <br>
      <dl class="bookshelf wrapper">

          <dt class="dontmakemethink"><span> The Space Between Worlds</span></dt>
          <dd class="dontmakemethink"><a class="amazonLink" href=""><img src="Images/book-front.jpg" alt="alt"></a><br>
          <strong>The Space Between Worlds</strong> by Micaiah Johnson.<br>
          <br><br><br><br><br>

          <a class="publisherLink" href="https://www.goodreads.com/book/show/48848254-the-space-between-worlds">Read me!</a></dd>
        </dl>
    </div>
  <!-- Page Content End (below) -->
  </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="JS/bookshelf.js"></script>


</body>


</html>





