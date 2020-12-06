/**
 * @author Yujun Shen
 */

// Major Catalog read from json file
var majorCatalog;
// Course Catalog read from json file
var courseCatalog;

// Read json files and store them as js objects
$.getJSON("json/majors.json", function (data) {
  majorCatalog = data;
});

$.getJSON("json/courses.json", function (data) {
  courseCatalog = data;
});
