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
      //addPrereqs(courseSet, userCourses);
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

// addPrereqs()
