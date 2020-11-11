<?php
// The below should be in index.php
// session_start(); // Must come before any HTML tags.
// $_SESSION["tabsCreated"] = 0;
// The above should be in index.php

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/pathwayPage.css">
</head>

<body>
    <h1>Untitled Pathway</h1>
    <div class="main" ondragover="drag_over(event)" ondrop="drop(event)">

        <div id="CSC111" onclick="lineChange()" class="courseBlock ui-widget-content">
            CSC111
        </div>
        <div id="MTH153" onclick="lineChange()" class="courseBlock ui-widget-content" style="top: 200px">
            MTH153
        </div>

        <table class="pathTable">
            <tr>
                <th>First Year</th>
                <th>Sophomore</th>
                <th>Junior</th>
                <th>Senior</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

    </div>
    <div class="side">

    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../js/pathway.js"></script>

</body>

</html>