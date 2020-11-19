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
    <!-- <p id="jsonInfo"></p> -->
    <button onclick="getCourses()">Get Courses</button>
    <button onclick="getPaths()">Get Paths</button>

    <div id="CSC111" onclick="lineChange()" class="courseBlock ui-widget-content" style="left:300px">
        CSC111
    </div>
    <div id="MTH153" onclick="lineChange()" class="courseBlock ui-widget-content" style="top: 200px;left:300px">
        MTH153
    </div>

    <svg id="map" height="300" width="500" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
                <path d="M2,2 L2,11 L10,6 L2,2" style="fill: rgb(69, 74, 145);" />
            </marker>
        </defs>

        <line id="line1" class="arrowLine" />
    </svg>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.js"></script> -->
    <script src="../js/pathway.js"></script>
</body>

</html>