//file paths:
var savepath = "users/save.php";

// Stores enough infrmation on each pathway to bring it back after a refresh.
// Is also usable for keeping track of the nodes' positions while the user is interacting with the pathway.
var pathway;

// Major chosen by the user
var chosenMajor = "XXX";

// Make courses draggable
$(function () {
  $(".courseBlock").draggable();
});

// List the major requirement courses from json file
function getCourses() {
  // var xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function () {
  //   if (this.readyState == 4 && this.status == 200) {
  //     var majors = JSON.parse(this.responseText);
  //     createCourses(majors, chosenMajor);
  //     document.getElementById("jsonInfo").innerHTML = majors.XXX.major.singular;
  //   }
  // };
  // xmlhttp.open("GET", "../json/majors.json", true);
  // xmlhttp.send();

  $.getJSON("../json/majors.json", function (data) {
    var majors = data;
    createCourses(majors, chosenMajor);
  });

  // Create new course div and make them draggable
  function createCourses(majors, chosenMajor) {
    var requirements = majors[chosenMajor].major.singular;

    for (i = 0; i < requirements.length; i++) {
      var course = document.createElement("div");
      course.innerHTML = requirements[i];
      course.id = requirements[i].split(" ").join("");
      course.className = "courseBlock ui-widget-content";
      course.style.top = "" + (i + 2) * 100 + "px";
      document.body.appendChild(course);
      course.style.display = "block";
    }

    $(function () {
      $(".courseBlock").draggable();
    });
  }
}

function getPaths() {
  document.getElementById("info").innerHTML = document.getElementById(
    "EGR110"
  ).innerHTML;
  // Get courses info from json file
  var xmlhttp2 = new XMLHttpRequest();
  xmlhttp2.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var courses = JSON.parse(this.responseText);
      createLines(courses);
      document.getElementById("info").innerHTML =
        courses.EGR["EGR 290"].prereqs;
    }
  };
  xmlhttp2.open("GET", "../json/courses.json", true);
  xmlhttp2.send();

  // $.getJSON("../json/courses.json", function (data) {
  //   var courses = data;
  //   createLines(courses);
  // });

  // Create prereq connection between courses
  function createLines(courses) {
    var userCourses = document.getElementsByClassName("courseBlock");

    for (i = 0; i < userCourses.length; i++) {
      var prereqs = courses.EGR[userCourses[i].innerHTML].prereqs;

      if (prereqs.length != 0) {
        var course2 = userCourses[i];
        for (j = 0; j < prereqs.length; j++) {
          var course1 = document.getElementById(prereqs[j].split(" ").join(""));
          if (course1 == null) {
            document.getElementById("info").innerHTML =
              "Prereq for " +
              course1.innerHTML +
              " is not included in the path.";
            continue;
          }

          var newPath = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "line"
          );
          newPath.setAttribute("id", course1.id + course2.id);
          newPath.setAttribute("x1", course1.style.left.slice(0, -2));
          newPath.setAttribute("y1", course1.style.top.slice(0, -2));
          newPath.setAttribute("x2", course2.style.left.slice(0, -2));
          newPath.setAttribute("y2", course2.style.top.slice(0, -2));
          $("#map").append(newPath);
        }
      }
    }
  }
}

// Update the line connection each time a course is dragged
function lineChange() {
  //     line1 = $("#line1");
  // CSC111 = $("#CSC111");
  // MTH153 = $("#MTH153");
  // var posCSC111 = CSC111.offset();
  // var posMTH153 = MTH153.offset();
  // line1.setAttribute("x1", posCSC111.left);
  // line1.setAttribute("y1", posCSC111.top);
  // line1.setAttribute("x2", posMTH153.left);
  // line1.setAttribute("y2", posMTH153.top);
  // document.getElementById("info").innerHTML = "nothing";
  // document.getElementById("info").innerHTML =
  //   posCSC111.left + " " + posCSC111.top;

  line1 = $("#line1");
  var CSC111 = document.getElementById("CSC111");
  var MTH153 = document.getElementById("MTH153");
  //document.getElementById("test1").innerHTML = "test";
  line1
    .attr("x1", CSC111.style.left.slice(0, -2))
    .attr("y1", CSC111.style.top.slice(0, -2))
    .attr("x2", MTH153.style.left.slice(0, -2))
    .attr("y2", MTH153.style.top.slice(0, -2));
  // document.getElementById("info").innerHTML = "nothing";
  // document.getElementById("info").innerHTML =
  //   "CSC111: " +
  //   CSC111.style.left +
  //   " " +
  //   CSC111.style.top +
  //   "<br>" +
  //   "MTH153: " +
  //   MTH153.style.left +
  //   " " +
  //   MTH153.style.top;
}

// Returns the server's response as to whether the save was successful.
function save() {
  alert("save");
  var success;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      success = xhttp.responseText;
    }
  };
  xhttp.open("POST", savepath, true);
  xhttp.setRequestHeader("Content-type", "application/json");
  // xhttp.send(pathway.stringify());
  xhttp.send("something");
  return success;
}
