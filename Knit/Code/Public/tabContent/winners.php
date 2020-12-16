<?php
    $comp = file_get_contents("data/contest.json");
    $compData = json_decode($comp, true);
    $winnerData = $compData["winners"];
    $numWin = count($winnerData);
?>
<div id="Winners" class="tabcontent">
    <h3 class="underline">Featured</h3>
    <p>Here are the winners from our last pattern contest. Click on an item you like to view the user-submitted pattern for making it!</p>
    <?php if ($numWin == 0): ?>
        <p>There are currently no winners! Please come back later for updates.</p>
	<?php else: ?>
		<div class="slideshow-container" id="featuredHome">
		<?php
            for($i = 0; $i < $numWin; $i++): 
                $image = "imgs/contest/" . $winnerData[$i]["image"];
            ?>
                <div class="mySlides">
                    <div class="numbertext"> <?= $i + 1; ?> / <?= $numWin; ?> </div>
                    <a onclick="openPattern(<?= $i; ?>, 'featuredPattern', 'featuredHome', 'Featured')"><img src="<?= $image; ?>" style="width:500" class="center" alt='Knit submission by <?= $winnerData[$i]["author"]; ?>'></a>
                </div>
            <?php endfor; ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        <?php endif; ?>

        <?php if($numWin != 0): ?>
            <div style="text-align:center">
            <?php for ($i = 1; $i <= $numWin; $i++): ?>
                <span class="dot" onclick="currentSlide('<?= $i; ?>')"></span>
            <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- This div will be filled by php/pattern.php when any pattern is called on -->
    <div id="featuredPattern"></div>
</div>
<script src="js/slides.js"></script>
