<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/pathwayPage.css">
</head>

<body>
    <div>
        <!-- I use a class instead of an id for the pathway title because multiple pathway tabs will be made, and that would be more than one element with the same id. -->
        <h1 class="pathwayTitle" onclick="titleChange(this)">Untitled Pathway</h1>
        <!--  This form allows asks the user to change the title of a pathway.  It uses pathwayMeta.js -->
        <div style="display: none;" class="titleChanger">
            <form onsubmit="changeTitle(this); return false;" >
                <input type="text" name="newTitle" placeholder="New Pathway Title">
            </form>
        </div>
    </div>

    <div class="main" ondragover="drag_over(event)" ondrop="drop(event)">

        <button class = "get" onclick="getCourses()">Get Courses</button>
        <button class = "get" onclick="getPaths()">Get Paths</button>
        <button class="active" onclick="save()">Save</button>

        <p id="info"></p>

        <div id="pathwayContent">
            <!-- <div class="canvasTable"> -->
            <!-- <table class="pathTable">
                <tr>
                    <th>First Year</th>
                    <th>Sophomore</th>
                    <th>Junior</th>
                    <th>Senior</th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table> -->
            <!-- </div> -->

            <!-- <div class="canvasTable"> -->
            <svg id="map" height="300" width="500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
                        <path d="M2,2 L2,11 L10,6 L2,2" style="fill: rgb(69, 74, 145);" />
                    </marker>
                </defs>
                <circle cx="100" cy="100" r="50" style="stroke: black; fill: red;" />
            </svg>
            <!-- </div> -->
        </div>

    </div>
    <div class="side">

    </div>

    <script src="js/pathway.js"></script>
</body>

</html>