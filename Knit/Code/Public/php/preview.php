<link rel="stylesheet" href="css/slideshow.css">
<div class="slideshow-container">

<?php
    $comp = file_get_contents("data/contest.json");
    $compData = json_decode($comp, true);
    $pendingData = $compData["pending"];
    $numPen = count($pendingData);

    if ($numPen == 0): ?>
        <p>No valid winners available. Please try again.</p>
    <?php else:
        for($i = 0; $i < $numPen; $i++): 
            $image = "imgs/contest/" . $pendingData[$i]["image"];
        ?>
            <div class="mySlides">
                <div class="numbertext"> <?= $i + 1; ?> / <?= $numPen; ?> </div>
                <img src="<?= $image; ?>" style="width:500" class="center" alt='author:<?= $pendingData[$i]["author"]; ?>'>
            </div>
        <?php endfor; ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <?php endif; ?>

    <?php if($numPen != 0): ?>
        <div style="text-align:center">
        <?php for ($i = 1; $i <= $numPen; $i++): ?>
            <span class="dot" onclick="currentSlide('<?= $i; ?>')"></span>
        <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<script src="js/slides.js"></script>