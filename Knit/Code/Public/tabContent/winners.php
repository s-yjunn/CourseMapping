<?php

/* This is the contents of the winners tab
@author Bethany, styling by Alexis, & openPattern() by Isabel
Last modified 12/16/2020 */

    //get winners' data
    $comp = file_get_contents("data/contest.json");
    $compData = json_decode($comp, true);
    $winnerData = $compData["winners"];
    $numWin = count($winnerData);
?>
<div id="Winners" class="tabcontent">
    <h3 class="underline">Featured</h3>
    <!-- instructions for user -->
    <p>Here are the winners from our last pattern contest. Click on an item you like to view the user-submitted pattern for making it!</p>
    <!-- if there are no winners.... -->
    <?php if ($numWin == 0): ?>
        <!-- ....inform user -->
        <p>There are currently no winners! Please come back later for updates.</p>
    <!-- if there are current winners.... -->
    <?php else: ?>
        <!-- put contents in slideshow -->
		<div class="slideshow-container" id="featuredHome">
        <?php
            //loop through winners
            for($i = 0; $i < $numWin; $i++): 
                //get winning pattern
                $image = "imgs/contest/" . $winnerData[$i]["image"];
            ?>
                <div class="mySlides">
                    <!-- print index / total in slideshow -->
                    <div class="numbertext"> <?= $i + 1; ?> / <?= $numWin; ?> </div>
                    <!-- show pattern. press to open & get more info -->
                    <a onclick="openPattern(<?= $i; ?>, 'featuredPattern', 'featuredHome', 'Featured')"><img src="<?= $image; ?>" style="width:500" class="center" alt='Knit submission by <?= $winnerData[$i]["author"]; ?>'></a>
                </div>
            <?php endfor; ?>
            <!-- press the side buttons to show different patterns -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <?php endif; ?>
        <!-- if there is a slideshow to speak of.... -->
        <?php if($numWin != 0): ?>
            <div style="text-align:center">
            <!-- get total number of winners -->
            <?php for ($i = 1; $i <= $numWin; $i++): ?>
                <!-- show index dots -->
                <span class="dot" onclick="currentSlide('<?= $i; ?>')"></span>
            <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- This div will be filled by php/pattern.php when any pattern is called on -->
    <div id="featuredPattern"></div>
</div>
<script src="js/slides.js"></script>
