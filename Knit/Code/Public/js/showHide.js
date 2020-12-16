/* This file contains shorthand functions to display or hide elements
@author Isabel (I know there are brief jQuery functions for show/hide, but I prefer this syntax) */

//This function shows an element given its id
function show(elmId) {
    document.getElementById(elmId).style.display = "block";
}

//This function hides an element given its id
function hide(elmId){
    document.getElementById(elmId).style.display = "none";
}