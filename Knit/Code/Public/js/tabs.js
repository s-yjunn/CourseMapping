/* This file is responsible for the show/hide functionality of the main page's tabs
Adapted slightly by Isabel from the w3schools tabs tutorial */

var currentTab = "Welcome";
//This function displays the tab with the id tabName and hides all others in the "tabcontent" class.
function openTab(tabLink, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  tabLink.className += " active";
  currentTab = tabName;
}