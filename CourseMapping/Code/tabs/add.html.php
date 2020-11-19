<form class = "addCourse" action="php/addCourse.php" method="post">
    <label for="major"><b>Major</b></label>
    <input type="text" placeholder="Enter Major" name="major" required>

    <label for="num"><b>Course Name</b></label>
    <input type="number" placeholder="Enter Course Number" name="num" required>

    <label for="title"><b>Title</b></label>
    <input type="text" placeholder="Enter Title" name="title" required>

    <label for="credit"><b>Credit</b></label>
    <input type="number" placeholder="Enter Credit" name="credit" required>

    <label for="prereqs"><b>Prerequisites</b></label>
    <input type="text" placeholder="Enter Prerequisites" name="prereqs">

    <label for="coreqs"><b>Corequities</b></label>
    <input type="text" placeholder="Enter Corequisites" name="coreqs">

    <label for="reqfor"><b>Required For</b></label>
    <input type="text" placeholder="Enter Next Courses" name="reqfor">

    <label for="sugfor"><b>Suggested For</b></label>
    <input type="text" placeholder="Enter Suggested For" name="sugfor">

    <label for="overlap"><b>Overlap</b></label>
    <input type="text" placeholder="Enter Overlapped Courses" name="overlap">

    <button type="submit" class = "addCourse">Add Course</button>
</form>
 