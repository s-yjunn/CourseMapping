<form action="php/jsonToTable.php" method="post">
<select name = "major">
    <option value="None">Select Majors</option>
    <option value="EGR">EGR</option>
    <option value="PHY">PHY</option>
</select>
<input type="submit" value="Submit the form"/>
</form>

<!--?php
// $content = file_get_contents("json/courses.json");
// $content_json = json_decode($content, true);
// echo "<form action=\"php/jsonToTable.php\" method=\"post\">";
// echo "<select name = \"major\">";
// echo $content_json[1];
// for($i = 1; $i < count(array_keys($content_json)); $i++){
//         echo "<option value=" . $content_json[$i]. ">". $content_json[$i]. "</option>";
//     };

//     // Close the table
// echo "</select>";
// echo "<input type=\"submit\" value=\"Select\"/>";
// ?> -->
