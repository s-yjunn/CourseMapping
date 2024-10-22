/**
 * @author Yujun Shen, Allison made additions
 *
 * Allison's additions are commented as such, everything else is Yujun's.
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

var courseWidth;
var courseHeight;

/**
 * Update the variables to the elements in current tab
 */
function getCurrentElements() {
  currentPage = document.getElementById(currentTab);
  if (currentPage == null) {
    return;
  }
  menu = getByClassFromTab("menu");
  info = getByClassFromTab("info");
  pathTable = getByClassFromTab("pathTable");
  pathwayContent = getByClassFromTab("pathwayContent");
  map = getByClassFromTab("map");
}

/**
 * When user select a major, clear all the screen.
 * Show all required courses by calling getCourses()
 */
function selectMajor() {
  getCurrentElements();
  // Clear all existing lines, courseBlocks, prereq option lists, and info message
  var items = $(currentPage).find(".courseBlock");
  for (let i = 0; i < items.length; i++) {
    items[i].remove();
  }
  var lines = $(currentPage).find(".arrowLine");
  for (let i = 0; i < lines.length; i++) {
    lines[i].remove();
  }
  var lists = $(currentPage).find(".prereqsOptions");
  for (let i = 0; i < lists.length; i++) {
    lists[i].remove();
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
    createCourseBlock(requirements[i], i);
  }

  makeDraggable();
  getPaths();
}

/**
 * @author Yujun wrote the original method, Allison separated out the helper method: createCourseBlockHelper
 * Create the courseBlock and initialize it into currentPathway.
 *
 * @param {string} courseName with space
 * @param {number} count how many courses are already added to the bar
 * Used to determine the position for this one.
 * @returns the created course block
 */
function createCourseBlock(courseName, count) {
  // Create it and add to the bar of unplaced courses in the pathway
  var position = (count + 1) * 50;
  var course = createCourseBlockHelper(courseName, 15, position, false);
  // Store the new data
  var courseInfo = { location: null, type: "singular" };
  storeEdits(-1, courseName, courseInfo); // Eventually change this so that the courses appear in correct order.
  return course;
}

/**
 * @author Yujun wrote the code, Allison separated it into a helper method and added adjustToCenter
 * Creates the courseBlock with the position specified by top and left.
 * Does not add the data into currentPathway and sessionStorage.
 * @param {string} courseName with space
 * @param {int} top the string that course.style.top will be set to
 * @param {int} left the string that course.style.left will be set to
 * @param {boolean} adjustToCenter - if this is true, top and left will be interpreted as
 * the positions of the center of the course block. To adjust so that they represent the actual
 * top and left, half the height of a course block will be subtracted from top, and half the width
 * from left.
 */
function createCourseBlockHelper(courseName, top, left, adjustToCenter) {
  var course = document.createElement("div");
  course.innerHTML = courseName;
  var nameNoWhitespace = courseName.split(" ").join("");
  course.className = "courseBlock ui-widget-content " + nameNoWhitespace;
  $(pathwayContent).append(course);
  if (adjustToCenter) {
    top -= parseInt($(course).height()) / 2;
    left -= parseInt($(course).width()) / 2;
  }
  course.style.top = top + "px";
  course.style.left = left + "px";

  course.style.display = "block";
  return course;
}

/**
 * Make all courseBlock draggable and doubleclickable
 * Find and store its position whenever a courseBlock is dragged.
 *
 * @author Yujun and Allison and Hyana
 * Both Allison and Yujun made this function. Hyana added an additional feature
 */
function makeDraggable() {
  // Define draggable properties
  $(function () {
    // xInitial and yInitial corresponds to the center of the course block
    var xInitial;
    var yInitial;
    var courseBlocks = currentPage.getElementsByClassName("courseBlock");
    /** Start of Hyana's contribution to Yujun and Allison's code. */
    $(courseBlocks).dblclick(function () {
      var course = String($(this).text());
      var department = course.split(" ")[0];
      var title = courseCatalog[department][course]["info"]["title"];
      var credits = courseCatalog[department][course]["info"]["credits"];
      var id = document.getElementById("infoPopUp");
      id.innerHTML =
        "<b>Title: </b>" +
        title +
        "<br>" +
        "<b>Credits: </b>" +
        credits +
        "</div>";
      document.getElementById("courseinfo").style.display = "block";
    });
    /** End of Hyana's contribution to Yujun and Allison's code. */
    $(courseBlocks).draggable({
      containment: pathwayContent,
      scroll: false,
      start: function () {
        xInitial = $(this).position().left + $(this).width() / 2;
        yInitial = $(this).position().top + $(this).height() / 2;

        // Close the prequisite options menu (if the course has one) when dragging
        var prereqList = getByClassFromTab(
          "list" + $(this).text().split(" ").join("")
        );
        if (prereqList != null) {
          prereqList.style.display = "none";
        }
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

/**@author Allison */

/**
 * @author Allison Brand
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
 * @author Allison Brand
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
 * @author Allison Brand
 *
 * Given a courseBlock's id, removes its HTML element,
 * and deletes it from currentPathway and sessionStorage.
 *
 * Does not delete any arrowlines that might connect to the course.
 * TO ADD? A boolean parameter to determine if it should look for any arrowlines?
 *
 * @param {string} courseID - courseName with no space
 */
function removeCourseBlock(courseID) {
  var courseBlock = getByClassFromTab(courseID);

  // Remove it from currentPathway and sessionStorage.
  var yPos =
    parseInt(courseBlock.style.top) + $(courseBlock).height() / 2;
  var xPos =
    parseInt(courseBlock.style.left) + $(courseBlock).width() / 2;
  var containerWidth = $(pathwayContent).width();
  var semNum = getSemNum(xPos, yPos, containerWidth);
  delete currentPathway["sem_" + semNum]["nodes"][spaceAdded(courseID)];
  serverSaveNeeded = true;
  currentPathway["serverSaveNeeded"] = true;
  sessionStorage[currentTab] = JSON.stringify(currentPathway);

  // Delete the courseBlock HTML element
  courseBlock.parentNode.removeChild(courseBlock);
}

/** End of Allison's contribution to Yujun's code. */

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
      var course2Name = course2.className
        .replace("courseBlock ui-widget-content ", "")
        .replace(" ui-draggable ui-draggable-handle", "");

      // If there is more than 1 option to satisfy the prerequisite requirement for course2
      if (Array.isArray(prereqs[0])) {
        initPrereqOpts(course2, course2Name, prereqs, userCourses);
      }

      // If there is only 1 way to statisfy the prerequisite requirement for course2
      else {
        for (var j = 0; j < prereqs.length; j++) {
          var course1Name = prereqs[j].split(" ").join("");
          var course1 = getByClassFromTab(course1Name);

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
          createLine(course1, course1Name, course2, course2Name);
        }
      }
    }
  }
}

/**
 * Draw the line on svg between course1 and course2.
 *
 * @param {HTMLElement} course1
 * @param {string} course1Name
 * @param {HTMLElement} course2
 * @param {string} course2Name
 */
function createLine(course1, course1Name, course2, course2Name) {
  var newPath = document.createElementNS("http://www.w3.org/2000/svg", "line");

  newPath.setAttribute("class", "arrowLine " + course1Name + course2Name);
  newPath.setAttribute("x1", course1.style.left.slice(0, -2));
  newPath.setAttribute("y1", course1.style.top.slice(0, -2));
  newPath.setAttribute("x2", course2.style.left.slice(0, -2));
  newPath.setAttribute("y2", course2.style.top.slice(0, -2));
  map.appendChild(newPath);
}

/**
 * Update the line connection each time a course is dragged
 *
 * @param {string} name of the course being dragged
 */
function lineChange(dragged) {
  var changedCourse = getByClassFromTab(dragged);
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
      var linkedCourse = getByClassFromTab(linkedCourseName);

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
