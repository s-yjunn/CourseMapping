
$(function () {
  $(".courseBlock").draggable();
});

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

  line1
    .attr("x1", CSC111.style.left.slice(0, -2))
    .attr("y1", CSC111.style.top.slice(0, -2))
    .attr("x2", MTH153.style.left.slice(0, -2))
    .attr("y2", MTH153.style.top.slice(0, -2));
  document.getElementById("info").innerHTML = "nothing";
  document.getElementById("info").innerHTML =
    "CSC111: " +
    CSC111.style.left +
    " " +
    CSC111.style.top +
    "<br>" +
    "MTH153: " +
    MTH153.style.left +
    " " +
    MTH153.style.top;
}

// // function dragCourse(courseId) {
// //Make the DIV element draggagle:
// dragElement(document.getElementById("MTH153"));

// function dragElement(elmnt) {
//   var pos1 = 0,
//     pos2 = 0,
//     pos3 = 0,
//     pos4 = 0;
//   elmnt.onmousedown = dragMouseDown;

//   function dragMouseDown(e) {
//     e = e || window.event;
//     e.preventDefault();
//     // get the mouse cursor position at startup:
//     pos3 = e.clientX;
//     pos4 = e.clientY;
//     document.onmouseup = closeDragElement;
//     // call a function whenever the cursor moves:
//     document.onmousemove = elementDrag;
//   }

//   function elementDrag(e) {
//     e = e || window.event;
//     e.preventDefault();
//     // calculate the new cursor position:
//     pos1 = pos3 - e.clientX;
//     pos2 = pos4 - e.clientY;
//     pos3 = e.clientX;
//     pos4 = e.clientY;
//     // set the element's new position:
//     elmnt.style.top = elmnt.offsetTop - pos2 + "px";
//     elmnt.style.left = elmnt.offsetLeft - pos1 + "px";
//   }

//   function closeDragElement() {
//     /* stop moving when mouse button is released:*/
//     document.onmouseup = null;
//     document.onmousemove = null;
//   }
// }
// // }

// function dragCourse(courseId) {
//   function drag_start(event) {
//     var style = window.getComputedStyle(event.target, null);
//     event.dataTransfer.setData(
//       "text/plain",
//       parseInt(style.getPropertyValue("left"), 10) -
//         event.clientX +
//         "," +
//         (parseInt(style.getPropertyValue("top"), 10) - event.clientY)
//     );
//   }
//   function drag_over(event) {
//     event.preventDefault();
//     return false;
//   }
//   function drop(event) {
//     var offset = event.dataTransfer.getData("text/plain").split(",");
//     var dm = document.getElementById(courseId);
//     dm.style.left = event.clientX + parseInt(offset[0], 10) + "px";
//     dm.style.top = event.clientY + parseInt(offset[1], 10) + "px";
//     event.preventDefault();
//     return false;
//   }
//   var dm = document.getElementById(courseId);
//   dm.addEventListener("dragstart", drag_start, false);
// }


