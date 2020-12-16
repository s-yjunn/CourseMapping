/**
 * @author Yujun Shen and Allison Brand
 */

/**
 * @author Yujun Shen
 * 
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
      addPrereqs(courseSet, course2, course2Name);
      course2.style.backgroundColor = "#a8f7f3";
      optionList.style.display = "none";
    };
    optionList.appendChild(option);
  });

  // Display the menu when the course is clicked
  course2.onclick = function () {
    var list = getByClassFromTab("list" + course2Name);
    console.log($(course2).position().top + $(course2).height());
    list.style.top = $(course2).position().top + $(course2).height() + "px";
    list.style.left = $(course2).position().left + "px";
    list.style.display = "block";
  };
}

/**
 * @author Allison Brand
 * 
 * Adds the selected prereqs to the pathway, and connects them to courseBlock with new arrowLines
 * Also deletes the original prereq arrowLines for this course, and asks the user whether they want to 
 * delete the original prereq blocks that aren't connected to any other courses in the pathway by arrowLines.
 * 
 * @param {array of strings} chosenPrereqs the course names of the prereqs
 * @param {HTMLElement} courseBlock the course that needs the chosenPrereqs
 * @param {string} courseName
 */
/*  TO ADD: Make so that it doesn't have to delete all of lines to the prereqs
 it had initially. This would allow only some of the prereqs to be changed.

Also, when it askes the user whether it should delete the prereq blocks, 
it should distinguish between the blocks that are connected to something else, and those that aren't 
*/
function addPrereqs(chosenPrereqs, courseBlock, courseName) {
  // First, remove the original lines.
  var nameNoSpaces = courseName.split(" ").join("");
  var lines = currentPage.querySelectorAll(".arrowLine");
  var prereqsDetached = []; // The names of any prereqs that are no longer needed for courseBlock
  for(let i = 0; i < lines.length; i++) {
    var classAttr = lines[i].className.baseVal;
    // If the line has a class name that ends with the course name:
    var matchIndex = classAttr.search(nameNoSpaces + "\\b");
    if(matchIndex !== -1) {
      // First store the name of the prereq this line connects:
      prereqsDetached.push(classAttr.slice(matchIndex - 6, matchIndex)); // Course names are 6 chars long
      // console.log("prereqsDetached: " + prereqsDetached + " typeof: " + typeof prereqsDetached);
      // Remove the line.
      lines[i].parentNode.removeChild(lines[i]);
    }
  }
  // Then, ask the user whether the corresponding prereqs should be removed.
  /* Potential thing TO ADD: It would be nice if this part darkened everything on the screen except for the 
   courses to remove, and allowed the user to unselect courses they don't want to remove by clicking on them.
   This could be a method that is used whenever a user wants to remove any courses.
   For now, it just asks the user if they want to remove the courses with a pop-up box.
  */
 courseRemovalPopUp(prereqsDetached, courseName); // Must come before new arrowLines are added.
  // Second, add all the prereqs that aren't already there, and draw the new lines
  for(let i = 0; i < chosenPrereqs.length; i++) {
      var prereqName = chosenPrereqs[i];
      var prereqBlock = getByClassFromTab(prereqName.split(" ").join(""));
      // If it doesn't already exist, make it.
      if(typeof prereqBlock === 'undefined') {
        // count is used to position the created course block
        var count = pathwayContent.childElementCount;
        prereqBlock = createCourseBlock(prereqName, count);
      }

      createLine(prereqBlock, prereqName.replace(" ", ""), courseBlock, nameNoSpaces);
  }
  // Make the newly added courses draggable
  makeDraggable();

  // // ---- CSS adjustments: ----
 // TO ADD: temporarily highlight the added lines
}

/**
 * @author Allison Brand
 * Add the detached prereqs to the pop up to ask the user if they want to delete them if the prereqs are not
 * connected to any other courses in the pathway by the lines.
 * 
 * @param {string[]} prereqsDetached - the names of the courses that used to be used as prereqs for a course, and 
 * which now may need to be deleted. These names do not contain spaces.
 * @param {NodeList} lines - all the lines connecting courses to their prereqs. Used to determine if any of the detached 
 * prereqs are still connected to other courses in the pathway 
 * @param {string} courseName - course name, with a space between the department and number
 */
function courseRemovalPopUp(prereqsDetached, lines, courseName) {
  console.log("prereqsDetache in fn: " + prereqsDetached + " typeof: " + typeof prereqsDetached);
  // Regenerate the lines variable, so that it does not include deleted lines
  var lines = currentPage.querySelectorAll(".arrowLine");
   // Only make the pop-up if any prereqs were actually detached
  if(prereqsDetached.length !== 0) {
    // prereqsDetached will be split into these 2 arrays.
    var isolatedPrereqs = [];
    var connectedPrereqs = [];
    // For every detached prereq, search the arrowLines to see if the course is still connected to the pathway.
    for(let courseID of prereqsDetached) {
      var stillConnected = false;
      // Scan through the arrowLines
      for(let i = 0; i < lines.length; i++) {
        var classAttr = lines[i].className.baseVal;
        // If the line has a class name that includes the course, it is connected to that course.
        if(classAttr.includes(courseID)) {
          console.log("classAttr: " + classAttr + " while course is : " + courseID);
          stillConnected = true;
          break;
        }
      }
      // console.log(courseID + " is still connected: " + stillConnected);
      if(stillConnected) {
        connectedPrereqs.push(courseID);
      } else {
        isolatedPrereqs.push(courseID);
      }
    }
    console.log("IsolatedPrereqs: " + isolatedPrereqs + " type: " + typeof isolatedPrereqs);
    // Now we know which prereqs are still connected.
    // Only make the pop-up if there are some isolated ones.
    if(isolatedPrereqs.length !== 0) {
      // First add the course whose prereqs have been changed to the description in the pop-up.
      document.getElementById("messageRemove").innerHTML += courseName + "."; 
      // Add the isolated courses to the pop-up so the user can delete them.
      for(let courseID of isolatedPrereqs) {
        var courseRect = document.createElement("span");
        courseRect.innerHTML = spaceAdded(courseID);
        courseRect.class = "courseRect";
        console.log("courseRect: " + courseRect);
        document.getElementById('listToRemove').appendChild(courseRect);
      }
      // Mention any detatched prereqs that are not being removed because they are still connected to the pathway.
      if(connectedPrereqs.length !== 0) {
        let coursesString = "";
        for(let courseID of connectedPrereqs) {
          // console.log("courseID: " + courseID);
          // Add connected prereq to coursesString:
          coursesString += spaceAdded(courseID) + ", ";
        }
        /* A HTML paragraph describing the detached prereqs that will not be removed
        because they are still connected to the pathway*/
        var notRemoveable = document.createElement("p");
        notRemoveable.innerHTML = "The following courses will not be removed because they are still connected in the pathway: " + fixListGrammer(coursesString); 
        // Insert this paragraph after the list of courses to remove.
        document.getElementById('listToRemove').insertAdjacentElement("afterend", notRemoveable);
      }

      // Show the finished pop-up
      document.getElementById('popUp').style.display='block';

      // The below function is used by a button in the pop-up:
      // Define the function to remove courses here, so it has access to isolatedPrereqs
      document.getElementById("removeCourses").onclick = function () {
        // This string will be used to let the user know which courses were removed.
        let coursesString = "";
        /* As the program iterates through isolatedPrereqs, coursesString will be put together
        and the prereqs will be deleted.*/
        for(let courseID of isolatedPrereqs) {
          // Remove courseBlock from the pathway and storage.
          removeCourseBlock(courseID);
          // Add isolated prereq to coursesString:
          coursesString += spaceAdded(courseID) + ", ";
        }

        // The pop-up is no longer needed.
        document.getElementById('popUp').style.display='none';

        // Let the user know what was deleted with messageBar.
        showMessage("Removed " + fixListGrammer(coursesString, isolatedPrereqs.length));
      };
    }
  }
}

/**
 * @author Allison Brand
 * Adds a space to a courseID after the first three characters (which are the department id).
 * @param {string} courseID - with no space
 */
function spaceAdded(courseID) {
  return courseID.slice(0, 3) + " " + courseID.slice(3);
}

/**
 * @author Allison Brand
 * Fixes the grammar of the courses list
 * @param {string} coursesList - a list of course names where every course name has ", " after it
 * @param {number} num - the number of courses in the list.
 */
function fixListGrammer(coursesList, num) {
  // Remove trailing comma and whitespace (this is two characters).
  // Add a period.
  var improvedList = coursesList.slice(0, -2) + ".";
  if(num > 1) {
    // Add "and" before the last course in the list.
    // Every course name is seven characters long, and the period at the end brings the total to eight.
    improvedList = improvedList.slice(0, -8) + "and " + improvedList.slice(-8);
  } 
  return improvedList;
}

/**
 * @author Allison Brand
 * Since we have multiple tabs in the same page, we can't use id's for the elements in a tab, or there would be conflicts.
 * We use class names instead, and then get elements by class name from the tab div
 * Each of these class names is unique within a tab, so the first (and only) element 
 * in the array returned by getElementsByClassName is it.
 * @param {string} className 
 */
function getByClassFromTab(className) {
  return currentPage.getElementsByClassName(className)[0];
}