/**
 * @author Yujun Shen
 */

/**
 * Restore pathway for the current tab from sessionStorage.
 * Recreate courseBlock and lines correspondingly.
 *
 * Yujun wrote this function, Allison added a part to restore courseBlocks that are in the
 * bar for unplaced courses.
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
  console.log(restoredInfo);

  // Run through every semester stored in restoredInfo.
  // If there are courses in nodes for that semester, run through nodes and create courseBlock accordingly.
  for (var sem in restoredInfo) {
    if (restoredInfo.hasOwnProperty(sem)) {
      var semNum = parseInt(sem.replace("sem_", ""));
      var nodes = restoredInfo[sem]["nodes"];

      if (isNotEmpty(nodes)) {
        if (semNum === -1) {
          // -1 is the bar for unplaced courses.
          for (let count = 0; count < nodes.length; count++) {
            var courseName = nodes[count];
            addCourseToBar(courseName, count);
          }
        } else {
          var xPos = (containerWidth / 8) * semNum - containerWidth / 16 + 5;
          for (var courseName in nodes) {
            var yPos = nodes[courseName]["location"];
            createCourseBlockHelper(courseName, yPos, xPos, true); // Allison converted some code to this method to acheive consistency with other code
          }
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
      var nodes = currentPathway[sem]["nodes"];
      for (var course in nodes) {
        if (nodes.hasOwnProperty(course)) {
          delete nodes[course];
        }
      }
    }
  }
  sessionStorage[currentTab] = JSON.stringify(currentPathway);
}
