/**
 * @author Yujun Shen
 */

// Major chosen by the user
var chosenMajor = "";

// Variables to be used in current pathway tab
var currentPage;
var menu;
var info;
var pathTable;
var pathwayContent;
var map;

/**
 * Update the variables to the elements in current tab
 */
function getCurrentElements() {
  currentPage = document.getElementById(currentTab);
  menu = currentPage.getElementsByClassName("menu")[0];
  info = currentPage.getElementsByClassName("info")[0];
  pathTable = currentPage.getElementsByClassName("pathTable")[0];
  pathwayContent = currentPage.getElementsByClassName("pathwayContent")[0];
  map = currentPage.getElementsByClassName("map")[0];
}

/**
 * When user select a major, clear all the screen.
 * Show all required courses by calling getCourses()
 */
function selectMajor() {
  getCurrentElements();
  // Clear all existing lines, courseBlocks, and info message
  var items = $(currentPage).find(".courseBlock");
  for (let i = 0; i < items.length; i++) {
    items[i].remove();
  }
  var lines = $(currentPage).find(".arrowLine");
  for (let i = 0; i < lines.length; i++) {
    lines[i].remove();
  }
  clearCurrentPathway();
  info.textContent = "";
  info.style.display = "none";

  // Reposition table, courseBlock, and svg
  $(pathTable).css({ marginTop: "0px" });
  $(pathwayContent).css({ marginTop: "0px" });
  $(map).css({ marginTop: "0px" });

  // Set chosenMajor to the selected major
  chosenMajor = $(menu).find("option:selected").val();
  getCourses();
}

/**
 * List the major requirement courses from MajorCatalog
 * Create draggable course div based on requirements
 */
function getCourses() {
  try {
    var requirements = majorCatalog[chosenMajor].major.singular;
    // If the major chosen is not found in json file, print a message
  } catch (error) {
    var warning = document.createElement("p");
    var node = document.createTextNode(
      "Missing information of major " + chosenMajor
    );
    warning.appendChild(node);

    displayInfo(warning);
    return;
  }

  // Create the courseBlocks, and store them
  for (var i = 0; i < requirements.length; i++) {
    var course = document.createElement("div");
    var courseName = requirements[i];
    course.innerHTML = courseName;
    course.className =
      "courseBlock ui-widget-content " + courseName.split(" ").join("");
    course.style.top = "15px";
    course.style.left = "" + (i + 1) * 50 + "px";
    $(pathwayContent).append(course);
    course.style.display = "block";

    var courseInfo = { location: null, type: "singular" };
    storeEdits(-1, courseName, courseInfo); // Eventually change this so that the courses appear in correct order.
  }

  makeDraggable();
  getPaths();
}

/**
 * Make all courseBlock draggable.
 * Find and store its position whenever a courseBlock is dragged.
 */
function makeDraggable() {
  // Define draggable properties
  $(function () {
    // xInitial and yInitial corresponds to the center of the course block
    var xInitial;
    var yInitial;
    var courseBlocks = currentPage.getElementsByClassName("courseBlock");
    $(courseBlocks).draggable({
      containment: pathwayContent,
      scroll: false,
      start: function () {
        xInitial = $(this).position().left + $(this).width() / 2;
        yInitial = $(this).position().top + $(this).height() / 2;
      },
      drag: function () {
        var dragged = $(this).attr("class");
        lineChange(dragged);
      },
      stop: function () {
        var containerWidth = $(pathwayContent).width();
        // The initial semester the course is in
        var initSemNum = getSemNum(xInitial, yInitial, containerWidth);

        // xPos and y Pos correspond to the center of the course block.
        var xPos = $(this).position().left + $(this).width() / 2;
        var yPos = $(this).position().top + $(this).height() / 2;
        var newSemNum = getSemNum(xPos, yPos, containerWidth);

        // Temporarily store course info:
        var courseName = $(this).text();
        var courseInfo =
          currentPathway["sem_" + initSemNum]["nodes"][courseName];
        console.log(currentPathway);
        // Update y-pos of location:
        courseInfo["location"] = yPos;

        if (initSemNum != newSemNum) {
          delete currentPathway["sem_" + initSemNum]["nodes"][courseName];
          // Potential thing to add for future: Include x-position for semesters that aren't locked
        }
        // save the course in its (potentially new) location
        storeEdits(newSemNum, courseName, courseInfo);
      },
    });
  });
}

/**
 * Saves edits to both currentPathway and sessionStorage
 * -1 means the bar that courses appear in initially
 *
 * @param {int or string} sem either an int between 1 and 8, or -1
 * @param {string} courseName
 * @param {object} courseInfo
 */
function storeEdits(sem, courseName, courseInfo) {
  // Update currentPathway
  currentPathway["sem_" + sem]["nodes"][courseName] = courseInfo;
  // Save change to sessionStorage:
  sessionStorage[currentTab] = JSON.stringify(currentPathway);
}

/**
 * Coverts the given xPos into the semester number,
 * starting at 1 for first semester freshman year, and ending at 8
 *
 * @param {int} xPos corresponds to the center of the course block
 * @param {int} containerWidth
 * @returns {int} semester number
 */
function getSemNum(xPos, yPos, containerWidth) {
  if (yPos < 100) {
    // _------------------------------ CHANGE THIS !!!!! 100 = bar height
    return -1;
  }
  var semWidth = containerWidth / 8;
  var semNum = Math.ceil(xPos / semWidth);
  return semNum;
}

/**
 * Get the prereq relations for course divs based on CourseCatalog
 * Create path among existing courses based on their prereq relations
 */
function getPaths() {
  var userCourses = currentPage.getElementsByClassName("courseBlock");

  // For each course already created on the webpage, check its prereq and create lines accordingly
  for (var i = 0; i < userCourses.length; i++) {
    var department = userCourses[i].innerHTML.substring(0, 3);

    try {
      var prereqs = courseCatalog[department][userCourses[i].innerHTML].prereqs;
      // If there is no information of prereq for this course, print a message
    } catch (error) {
      var warning = document.createElement("p");
      var node = document.createTextNode(
        "Missing information of prereq for " + userCourses[i].innerHTML
      );
      warning.appendChild(node);

      displayInfo(warning);
      continue;
    }

    // If there is at least one prereq, draw connection
    if (prereqs.length != 0) {
      var course2 = userCourses[i];
      var course2Name = course2.className.replace(
        "courseBlock ui-widget-content ",
        ""
      );
      for (var j = 0; j < prereqs.length; j++) {
        var course1Name = prereqs[j].split(" ").join("");
        var course1 = currentPage.getElementsByClassName(course1Name)[0];

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

          displayInfo(warning);
          continue;
        }

        // If prereq is an existing course block, create new line connection on svg
        var newPath = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "line"
        );

        newPath.setAttribute("class", "arrowLine " + course1Name + course2Name);
        newPath.setAttribute("x1", course1.style.left.slice(0, -2));
        newPath.setAttribute("y1", course1.style.top.slice(0, -2));
        newPath.setAttribute("x2", course2.style.left.slice(0, -2));
        newPath.setAttribute("y2", course2.style.top.slice(0, -2));
        map.appendChild(newPath);
      }
    }
  }
}

/**
 * Update the line connection each time a course is dragged
 *
 * @param {string} name of the course being dragged
 */
function lineChange(dragged) {
  var changedCourse = currentPage.getElementsByClassName(dragged)[0];
  var lines = currentPage.getElementsByClassName("arrowLine");
  for (var i = 0; i < lines.length; i++) {
    // Find lines that are affected by dragging
    var changedCourseName = changedCourse.className
      .replace("courseBlock ui-widget-content ", "")
      .replace(" ui-draggable ui-draggable-handle ui-draggable-dragging", "");
    var lineName = lines[i].className.baseVal
      .replace("arrowLine ", "")
      .replace(" ui-draggable ui-draggable-handle", "");
    if (lineName.includes(changedCourseName)) {
      changingLine = $(lines[i]);
      var linkedCourseName = lineName.replace(changedCourseName, "");
      var linkedCourse = currentPage.getElementsByClassName(
        linkedCourseName
      )[0];

      // If the course dragged is the prereq for another course, change x1 and y1 of line
      if (lineName.indexOf(changedCourseName) == 0) {
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

/**
 * Display info and shift table, courseBlock, and svg down accordingly
 *
 * @param {string} the warning message to be displayed
 */
function displayInfo(warning) {
  info.style.display = "block";
  info.appendChild(warning);

  var height = $(info).height();
  $(pathTable).css({ marginTop: "" + height + "px" });
  $(pathwayContent).css({ marginTop: "" + height + "px" });
  $(map).css({ marginTop: "" + height + "px" });
}
