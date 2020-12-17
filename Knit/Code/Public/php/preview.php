<?php 
/* This is to show the pending winners for admin to preview
@author Bethany
Last modified 12/16/2020 */
?>

<div class="slideshow-container">

<?php
    //get pending data
    $comp = file_get_contents("../data/contest.json");
    $compData = json_decode($comp, true);
    $pendingData = $compData["pending"];
    $numPen = count($compData["pending"]);
    //if there were no valid contestants (i.e. contestants with votes)
    if (count($compData["pending"]) == 0): 
    echo  $numPen ?>
        <!-- show error message -->
        <p>No valid winners available. Please try again.</p>
        <!-- if there are valid contestants -->
    <?php else:
        //loop through pending winners
        for($i = 0; $i < $numPen; $i++):
            //get img path 
            $image = "imgs/contest/" . $pendingData[$i]["image"];
        ?>
            <div class="mySlides">
                <!-- print img index / total number of imgs -->
                <div class="numbertext"> <?= $i + 1; ?> / <?= $numPen; ?> </div>
                <!-- show img -->
                <img src="<?= $image; ?>" style="width:500" class="center" alt='author:<?= $pendingData[$i]["author"]; ?>'>
            </div>
        <?php endfor; ?>
        <!-- press side buttons to change displayed img -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <?php endif; ?>
        <!-- if there are valid pending winners -->
    <?php if($numPen != 0): ?>
        <div style="text-align:center">
        <!-- show index dots -->
        <?php for ($i = 1; $i <= $numPen; $i++): ?>
            <span class="dot" onclick="currentSlide('<?= $i; ?>')"></span>
        <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<script src="js/slides.js"></script>