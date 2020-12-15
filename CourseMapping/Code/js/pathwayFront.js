/**
 * @author Yujun Shen
 */

/**
 * Create dropdown menu of prerequisite options and
 * highlight the course red to indicate to the user that the pathway is missing prereqs.
 *
 * @param {HTMLElement} course2
 * @param {string} course2Name
 * @param {Array} prereqs (an array of arrays)
 * @param {Array} userCourses (an array of all courseBlocks in current tab)
 */
function initPrereqOpts(course2, course2Name, prereqs, userCourses) {
  // Mark the course with red
  course2.style.backgroundColor = "#f1a181";

  // Create the menu of prerequisite options
  var optionList = document.createElement("div");
  optionList.className = "prereqsOptions " + "list" + course2Name;
  $(course2).after(optionList);

  prereqs.forEach(function (courseSet) {
    var option = document.createElement("p");
    option.innerHTML = courseSet.join(" + ");

    // When a option is clicked, mark the course with blue and
    // add the corresponding courses to the pathway.
    option.onclick = function () {
      addPrereqs(courseSet, userCourses, course2, course2Name);
      course2.style.backgroundColor = "#a8f7f3";
      optionList.style.display = "none";
    };
    optionList.appendChild(option);
  });

  // Display the menu when the course is clicked
  course2.onclick = function () {
    var list = currentPage.getElementsByClassName("list" + course2Name)[0];
    console.log($(course2).position().top + $(course2).height());
    list.style.top = $(course2).position().top + $(course2).height() + "px";
    list.style.left = $(course2).position().left + "px";
    list.style.display = "block";
  };
}

/**
 * 
 * 
 * @param {array of strings} chosenPrereqs the course names of the prereqs
 * @param {array} displayedCourses all courseBlocks in current tab
 * @param {HTMLElement} courseBlock the course that needs the chosenPrereqs
 * @param {string} courseName
 */
/*  TO ADD: Make so that it doesn't have to delete all of lines to the prereqs
 it had initially. This would allow only some of the prereqs to be changed.

Also, when it askes the user whether it should delete the prereq blocks, 
it should distinguish between the blocks that are connected to something else, and those that aren't 
*/
function addPrereqs(chosenPrereqs, displayedCourses, courseBlock, courseName) {
  // First, remove the original lines.

  // Second, add all the prereqs that aren't already there, and draw the new lines
  for(var i = 0; i < chosenPrereqs.length; i++) {
      var prereqName = chosenPrereqs[i];
      var prereqBlock = document.getElementById(prereqName.split(" ").join(""));
      // If it doesn't already exist, make it.
      if(prereqBlock === null) {
        // count is used to position the created course block
        var count = pathwayContent.childElementCount;
        prereqBlock = createCourseBlock(prereqName, count);
      }
      createLine(prereqBlock, prereqName, courseBlock, courseName);
  }
  // Make the newly added courses draggable
  makeDraggable();

  // // ---- CSS adjustments: ----
  // // After 3 seconds, remove the show class from messageBar
  // setTimeout(function(){messageBar.className = messageBar.className.replace("show", ""); }, 3000); 
}