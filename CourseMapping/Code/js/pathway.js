var currentPathway; //Global, stores the javascript object to manipulate, whose string representation is in sessionStorage

// Major chosen by the user
var chosenMajor = "XXX";

// Make courses draggable
$(function () {
  $(".courseBlock").draggable();
});

// Update the line connection each time a course is dragged
function lineChange(changedCourse) {
  var lines = document.getElementsByClassName("arrowLine");
  for (var i = 0; i < lines.length; i++) {
    if (lines[i].id.includes(changedCourse.id)) {
      changingLine = $("#" + lines[i].id);
      var linkedCourse = document.getElementById(
        lines[i].id.replace(changedCourse.id, "")
      );

      // If the course dragged is the prereq for another course, change x1 and y1 of line
      if (lines[i].id.indexOf(changedCourse.id) == 0) {
        changingLine
          .attr("x1", changedCourse.style.left.slice(0, -2))
          .attr("y1", changedCourse.style.top.slice(0, -2))
          .attr("x2", linkedCourse.style.left.slice(0, -2))
          .attr("y2", linkedCourse.style.top.slice(0, -2));
        console.log(changedCourse.style.top + " " + changedCourse.style.left);

        // If the course dragged has a prereq, change x2 and y2 of line
      } else {
        changingLine
          .attr("x1", linkedCourse.style.left.slice(0, -2))
          .attr("y1", linkedCourse.style.top.slice(0, -2))
          .attr("x2", changedCourse.style.left.slice(0, -2))
          .attr("y2", changedCourse.style.top.slice(0, -2));
      }
    }
  }
}

// List the major requirement courses from json file
function getCourses() {
  $.getJSON("json/majors.json", function (data) {
    var majors = data;
    createCourses(majors, chosenMajor);
  });

  // Create new course div and make them draggable
  function createCourses(majors, chosenMajor) {
    var requirements = majors[chosenMajor].major.singular;

    for (var i = 0; i < requirements.length; i++) {
      var course = document.createElement("div");
      course.innerHTML = requirements[i];
      course.id = requirements[i].split(" ").join("");
      course.className = "courseBlock ui-widget-content";
      course.style.top = "" + (i + 2) * 100 + "px";
      course.style.left = "100px";
      course.setAttribute("onclick", "lineChange(" + course.id + ")");
      $("#pathwayContent").append(course);
      course.style.display = "block";
    }

    $(function () {
      $(".courseBlock").draggable();
    });
  }
}

// Create path among existing courses based on their prereq relations
function getPaths() {
  // Get courses info from json file
  $.getJSON("json/courses.json", function (data) {
    var courses = data;
    createLines(courses);
  });

  // Create prereq connection between courses
  function createLines(courses) {
    document.getElementById("info").innerHTML = "Enter line method";
    var userCourses = document.getElementsByClassName("courseBlock");

    for (var i = 0; i < userCourses.length; i++) {
      var department = userCourses[i].innerHTML.substring(0, 3);
      document.getElementById("info").innerHTML = department;
      var prereqs = courses[department][userCourses[i].innerHTML].prereqs;
      document.getElementById("info").innerHTML = prereqs;

      if (prereqs.length != 0) {
        var course2 = userCourses[i];
        for (var j = 0; j < prereqs.length; j++) {
          var course1 = document.getElementById(prereqs[j].split(" ").join(""));

          // If prereq is not in existing course blocks, print a notice
          if (course1 == null) {
            document.getElementById("info").innerHTML =
              "Prereq " +
              prereqs[j] +
              " for " +
              course2.innerHTML +
              " is not included in the path.";
            continue;
          }

          // If prereq is an existing course block, create new line connection on svg
          var newPath = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "line"
          );
          newPath.setAttribute("id", course1.id + course2.id);
          document.getElementById("info").innerHTML =
            "course 1: " + course1.style.left + " " + course1.style.top;
          newPath.setAttribute("class", "arrowLine");
          newPath.setAttribute("x1", course1.style.left.slice(0, -2));
          newPath.setAttribute("y1", course1.style.top.slice(0, -2));
          newPath.setAttribute("x2", course2.style.left.slice(0, -2));
          newPath.setAttribute("y2", course2.style.top.slice(0, -2));
          document.getElementById("map").appendChild(newPath);
        }
      }
    }
  }
}
