<link rel="stylesheet" href="../css/slideshow.css">
<div class="slideshow-container">
    <?php
    $comp = file_get_contents("../data/contest.json");
    $compData = json_decode($comp, true);
    $currentConts = $compData["pending"];
    $numCont = count($currentConts);
 $winners = '../imgs/contest/';

if($numCont == 0):
    echo '<p>No one has voted yet please comeback later.</p>';    
    
else:
      for ($i = 1; $i < $numCont; $i++):
          ?>
  <div class="mySlides fade">
  <div class="numbertext"><?=($i + 1 ). ' / ' . $numCont ;?></div>
  <img src="../imgs/contest/<?=$currentConts[$i]["image"];?>" style="width:500" class="center">
  </div>';
  <?php endfor; ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <?php endif; ?>

        </div>

        <?php if($numCont != 0): ?>
            <div style="text-align:center">
            <?php for ($i = 1; $i <= $numCont; $i++): ?>
                <span class="dot" onclick="currentSlide('<?= $i; ?>')"></span>
            <?php endfor; ?>
            </div>
        <?php endif; ?>

<br><br><br><br><br><br><br><br><br><br>
<form action="reset.php" method="post">
     <input type="submit" value="Confirm">
     </form>
     

     <br><br><br><br>
<form action="back.php" method="post">
     <input type="submit" value="Go Back">
     </form>

<script src="../js/slides.js"></script>