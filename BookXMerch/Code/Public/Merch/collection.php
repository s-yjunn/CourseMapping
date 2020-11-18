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
      <button class="barCol buttonClass" onclick="getMerchByCategory('Clothing')">Clothing</button>
      <button class="barCol buttonClass" onclick="getMerchByCategory('Collectibles')">Collectibles</button>
      <button class="barCol buttonClass" onclick="getMerchByCategory('Other')">Other</button>
    </div>
  </div>


  <div id="Merch" class="center">
    <div id="wrapper" class="wrapper">
    </div>
  </div>

  <div id="original"> 
    <div class="wrapper">

      <div id="Colthing"> <button class="imgButton" onclick="getMerchByCategory('Clothing')"><img class="imageClass"  src="Images/shirt.png" alt="bm"></button></div>
      <div id="Collectibles"> <button class="imgButton" onclick="getMerchByCategory('Collectibles')"> <img class="imageClass" src="Images/mug.png" alt="bm"></button></div>
      <div id="Other"> <button class="imgButton" onclick="getMerchByCategory('Other')"><img class="imageClass" src="Images/notebook.png" alt="bm"></button></div>
    </div>
  </div>

</body>


</html>





