<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <link rel="stylesheet" type="text/css" href="../css/pathwayPage.css" />
</head>

<body>
    <p id="info"></p>

    <div id="CSC111" onclick="lineChange()" class="courseBlock ui-widget-content">
        CSC111
    </div>
    <div id="MTH153" onclick="lineChange()" class="courseBlock ui-widget-content" style="top: 200px">
        MTH153
    </div>

    <svg>
        <line id="line1" /></svg>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script src="../js/pathway.js"></script>
</body>

</html>