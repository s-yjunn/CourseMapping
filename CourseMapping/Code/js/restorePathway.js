/**
 * @author Yujun Shen
 */

/**
 * Restore pathway for the current tab from sessionStorage.
 * Recreate courseBlock and lines correspondingly.
 */
function restorePathway() {
  if (document.getElementById(currentTab) == null) {
    return;
  }
  getCurrentElements();

  // If there are already courseBlocks in tab, do not restore nor recreate.
  if ($(currentPage).has(".courseBlock").length) {
    return;
  }

  var restoredInfo = JSON.parse(sessionStorage[currentTab]);
  var containerWidth = $(pathwayContent).width();

  // Run through every semester stored in restoredInfo.
  // If there are courses in nodes for that semester, run through nodes and create courseBlock accordingly.
  for (var sem in restoredInfo) {
    if (restoredInfo.hasOwnProperty(sem)) {
      var semNum = parseInt(sem.replace("sem_", ""));
      var nodes = restoredInfo[sem]["nodes"];

      if (isNotEmpty(nodes)) {
        console.log(nodes);
        var xPos = (containerWidth / 8) * semNum - containerWidth / 16 + 5;

        for (var courseName in nodes) {
          var yPos = nodes[courseName]["location"];
          var courseBlock = document.createElement("div");
          courseBlock.innerHTML = courseName;
          courseBlock.className =
            "courseBlock ui-widget-content " + courseName.split(" ").join("");
          $(pathwayContent).append(courseBlock);
          $(courseBlock).css({ top: yPos - $(courseBlock).height() / 2 });
          $(courseBlock).css({ left: xPos - $(courseBlock).width() / 2 });
          courseBlock.style.display = "block";
        }
      }
    }
  }

  makeDraggable();
  getPaths();
}

/**
 * Check if the node contains any course.
 *
 * @param {object} info[sem][nodes] that contains courses
 */
function isNotEmpty(nodes) {
  for (var course in nodes) {
    if (nodes.hasOwnProperty(course)) return true;
  }
  return false;
}

/**
 * When the user call for classes from a major again by clicking Get Courses,
 * clear currentPathway and sessionStorage to store new info.
 */
function clearCurrentPathway() {
  for (var sem in currentPathway) {
    if (currentPathway.hasOwnProperty(sem)) {
      console.log("enter if");
      var nodes = currentPathway[sem]["nodes"];
      for (var course in nodes) {
        if (nodes.hasOwnProperty(course)) {
          console.log("delete");
          delete nodes[course];
        }
      }
    }
  }
  sessionStorage[currentTab] = JSON.stringify(currentPathway);
}
