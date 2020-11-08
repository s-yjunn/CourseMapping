
function getBookByGenre(genre) {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("original").style.display="none";
            document.getElementById("wrapper").innerHTML = this.responseText;
            document.getElementById("wrapper").style= "margin-left: 240px";
        }
    }
    xmlhttp.open("GET", "php/bookCollection.php?genre=" + genre, true);
    xmlhttp.send();
}


function showCollection(){
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="block";
}
