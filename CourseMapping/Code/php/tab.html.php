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
    <button class="active" onclick="save()">Save</button>
    <div class="main" ondragover="drag_over(event)" ondrop="drop(event)">

        <button onclick="getCourses()">Get Courses</button>
        <button onclick="getPaths()">Get Paths</button>

        <p id="jsonInfo"></p>

        <table class="pathTable">
            <tr>
                <th>First Year</th>
                <th>Sophomore</th>
                <th>Junior</th>
                <th>Senior</th>
            </tr>
            <tr>
                <td>
                    <p id='test1'></p>
                    <div id="CSC111" class="courseBlock ui-widget-content">
                        CSC111
                    </div>
                    <div id="MTH153" onclick="lineChange()" class="courseBlock ui-widget-content" style="top: 400px">
                        MTH153
                    </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <svg id="map" height="300" width="500" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
                    <path d="M2,2 L2,11 L10,6 L2,2" style="fill: rgb(69, 74, 145);" />
                </marker>
            </defs>

            <line id="line1" class="arrowLine" />
        </svg>

    </div>
    <div class="side">

    </div>

    <script src="js/pathway.js"></script>
</body>

</html>