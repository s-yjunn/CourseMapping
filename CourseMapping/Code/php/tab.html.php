<!-- @author Yujun Shen -->

<!DOCTYPE html>
<html>
<?php
// file paths:
$majorFileName = "../json/majors.json";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/pathwayPage.css">
    <link rel="stylesheet" type="text/css" href="css/courseBlockDropDown.css">
</head>

<body>
    <div>
        <!-- I use a class instead of an id for the pathway title because multiple pathway tabs will be made, and that would be more than one element with the same id. -->
        <h1 class="pathwayTitle" onclick="titleChange(this)">Untitled Pathway &#9998</h1>
        <!--  This form allows asks the user to change the title of a pathway.  It uses pathwayMeta.js -->
        <div style="display: none;" class="titleChanger ">
            <form onsubmit="changeTitle(this); return false;">
                <input type="text" name="newTitle" placeholder="New Pathway Title">
            </form>
        </div>
    </div>


    <div class="main" ondragover="drag_over(event)" ondrop="drop(event)">

        <select class="menu">
            <option value="None">Select a Major</option>
            <?php
            $majorFile = fopen($majorFileName, 'r');

            $majors = json_decode(fread($majorFile, filesize($majorFileName)), false);
            foreach ($majors as $key => $value) {
                if ($key != "meta") {
                    echo "<option value =$key>" . $key . "</option>" . "<br>";
                }
            }
            ?>
        </select>
        <button class="courseBtn" onclick="selectMajor()">Get Courses</button>
        <button class="active" <?php include './saveButtons/blank.php'; ?> onclick="save()">Save</button>
        <button class="unsavedBtn" <?php include './saveButtons/unsaved.php'; ?> onclick="save()">Save Unsaved Work</button>

        <div class="info">
        </div>

        <div class="pathwayContent" style="position:absolute;">
        </div>

        <table class="pathTable">
            <tr>
                <td colspan="4"></td>
            </tr>
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

        <svg class="map" height="300" width="500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <marker id="markerArrow" markerWidth="13" markerHeight="13" refX="2" refY="6" orient="auto">
                    <path d="M2,2 L2,11 L10,6 L2,2" style="fill: rgb(69, 74, 145);" />
                </marker>
            </defs>
        </svg>
    </div>
    <div class="side">

    </div>

    <script src="js/pathway.js"></script>
</body>

</html>