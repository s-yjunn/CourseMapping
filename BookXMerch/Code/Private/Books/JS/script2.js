
function getBookByGenre(genre) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("wrapper").innerHTML = "";
            document.getElementById("booksOfMonth").style.display="none";
            document.getElementById("original").style.display="none";
            document.getElementById("wrapper").innerHTML = "<br>"+ this.responseText;
            document.getElementById("wrapper").style= "margin-left: 240px; max-width: 30em";
            
        }
    }
    xmlhttp.open("GET", "php/bookCollection.php?genre=" + genre, true);
    xmlhttp.send();
}


function showCollection(){
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="block";
    document.getElementById("booksOfMonth").style.display="none";
    
}

function booksOfMonth() {
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="none";
    document.getElementById("booksOfMonth").style.display="block";
}

function displayContent(i) {
    document.getElementById(i).style.display="block";
}