function getList() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("rList").style.display="block";
            document.getElementById("readingListWrapper").innerHTML = "";
            document.getElementById("userDetails").style.display="none";
            document.getElementById("readingListWrapper").innerHTML = "<br>"+ this.responseText;
            // document.getElementById("readingListWrapper").style= "margin-left: 240px; max-width: 30em";
            
        }
    }
    xmlhttp.open("GET", "php/readingList.php", true);
    xmlhttp.send();
}