// Major chosen by the user
var showMajors = 0;
var chosenMajor = "XXX";

// Make courses draggable
$(function () {
  $(".courseBlock").draggable();
});

// Get available majors for drop down menu from json file
function getMajors() {
  if (showMajors == 0) {
    $(document).ready(function () {
      $.getJSON("json/majors.json", function (data) {
        var major = "";
        $.each(data, function (key, value) {
          if (key != "meta") {
            major += "<option value =" + key + ">" + key + "</option>";
          }
        });
        $("#menu").append(major);
      });
    });
    showMajors = 1;
  }
}

// When user select a major, show all required courses
function selectMajor() {
  // Clear all existing lines, courseBlocks, and info message
  var items = $(".courseBlock");
  for (let i = 0; i < items.length; i++) {
    items[i].remove();
  }
  var lines = $(".arrowLine");
  for (let i = 0; i < lines.length; i++) {
    lines[i].remove();
  }
  document.getElementById("info").textContent = "";
  document.getElementById("info").style.display = "none";

  // Reposition table, courseBlock, and svg
  $("#pathTable").css({ marginTop: "0px" });
  $("#pathwayContent").css({ marginTop: "0px" });
  $("#map").css({ marginTop: "0px" });

  // Set chosenMajor to the selected major
  chosenMajor = $("#menu option:selected").val();
  getCourses();
}

// Update the line connection each time a course is dragged
function lineChange(dragged) {
  var changedCourse = document.getElementById(dragged);
  var lines = document.getElementsByClassName("arrowLine");
  for (var i = 0; i < lines.length; i++) {
    // Find lines that are affected by dragging
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
    try {
      var requirements = majors[chosenMajor].major.singular;
      // If the major chosen is not found in json file, print a message
    } catch (error) {
      var warning = document.createElement("p");
      var node = document.createTextNode(
        "Missing information of major " + chosenMajor
      );
      warning.appendChild(node);

      var info = document.getElementById("info");
      info.style.display = "block";
      info.appendChild(warning);
      return;
    }

    // Create the courseBlocks
    for (var i = 0; i < requirements.length; i++) {
      var course = document.createElement("div");
      course.innerHTML = requirements[i];
      course.id = requirements[i].split(" ").join("");
      course.className = "courseBlock ui-widget-content";
      course.style.top = "" + (i + 2) * 30 + "px";
      course.style.left = "40px";
      $("#pathwayContent").append(course);
      course.style.display = "block";
    }

    $(function () {
      $(".courseBlock").draggable({
        containment: "#pathwayContent",
        scroll: false,
        drag: function () {
          var dragged = $(this).attr("id");
          lineChange(dragged);
        },
      });
    });
  }

  getPaths();
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
    var userCourses = document.getElementsByClassName("courseBlock");

    // For each course already created on the webpage, check its prereq and create lines accordingly
    for (var i = 0; i < userCourses.length; i++) {
      var department = userCourses[i].innerHTML.substring(0, 3);

      try {
        var prereqs = courses[department][userCourses[i].innerHTML].prereqs;
        // If there is no information of prereq for this course, print a message
      } catch (error) {
        var warning = document.createElement("p");
        var node = document.createTextNode(
          "Missing information of prereq for " + userCourses[i].innerHTML
        );
        warning.appendChild(node);

        var info = document.getElementById("info");
        info.style.display = "block";
        info.appendChild(warning);

        // Shift table, courseBlock, and svg down accordingly
        var height = $("#info").height();
        $("#pathTable").css({ marginTop: "" + height + "px" });
        $("#pathwayContent").css({ marginTop: "" + height + "px" });
        $("#map").css({ marginTop: "" + height + "px" });
        continue;
      }

      // If there is at least one prereq, draw connection
      if (prereqs.length != 0) {
        var course2 = userCourses[i];
        for (var j = 0; j < prereqs.length; j++) {
          var course1 = document.getElementById(prereqs[j].split(" ").join(""));

          // If prereq is not in existing course blocks, print a notice
          if (course1 == null) {
            var warning = document.createElement("p");
            var node = document.createTextNode(
              "Prereq " +
                prereqs[j] +
                " for " +
                course2.innerHTML +
                " is not included in the path."
            );
            warning.appendChild(node);

            var info = document.getElementById("info");
            info.style.display = "block";
            info.appendChild(warning);

            // Shift table, courseBlock, and svg down accordingly
            var height = $("#info").height();
            $("#pathTable").css({ marginTop: "" + height + "px" });
            $("#pathwayContent").css({ marginTop: "" + height + "px" });
            $("#map").css({ marginTop: "" + height + "px" });
            continue;
          }

          // If prereq is an existing course block, create new line connection on svg
          var newPath = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "line"
          );
          newPath.setAttribute("id", course1.id + course2.id);
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
