
<?php
$content = file_get_contents("../json/courses.json");
$content_json = json_decode($content, true);
$major = $_POST["major"];
        // Open the table
echo "<table>";
        // Cycle through the array
foreach (array_keys($content_json[$major])as $course){
        // Output a row
        echo "<tr>";
        echo "<td>" . $course. "</td>";
        echo "</tr>";
    };

    // Close the table
echo "</table>";
?>
