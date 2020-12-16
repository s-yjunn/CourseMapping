
// <!-- Authors: Imane Berrada and Nukhbah Majid| --> 
var nameSession = "";

function getBookByGenre(genre, sessionName) {
    nameSession = sessionName;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("wrapper").innerHTML = "";
            document.getElementById("booksOfMonth").style.display="none";
            document.getElementById("original").style.display="none";
            document.getElementById("wrapper2").style.display="none";
            document.getElementById("wrapper").innerHTML = "<br>"+ this.responseText;
            document.getElementById("wrapper").style= "margin-left: 240px; max-width: 30em";
            
        }
    }
    xmlhttp.open("GET", "php/bookCollection.php?genre=" + genre, true);
    xmlhttp.send();
}

// $(document).ready(function(){
//     function hideMain() {
//         console.log("working?");
//         document.getElementById("bookDetails").style.display="none";
//         //document.getElementById("reviewForm").style.display="block";
        
//     }
//     $("#reviewBox").click(hideMain);
// });

// function showModal(){
//     document.getElementsById("bookDetails").style.display="none";
//     document.getElementById("reviewForm").style.display="block";
// }

// function hideModal() {
//     document.getElementById("reviewForm").style.display="none";
//     document.getElementById("bookBorder").style.display="block";
// }

// function hideMain2() {
//     document.getElementById("bookDetails").style.display="none";
// }


function showCollection(){
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="block";
    document.getElementById("booksOfMonth").style.display="none";
    document.getElementById("wrapper2").style.display = "none";
}

function showAllBooks(){
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="none";
    document.getElementById("booksOfMonth").style.display="none";
    document.getElementById("wrapper2").style.display = "block";
    
}

function booksOfMonth() {
    document.getElementById("wrapper").innerHTML = "";
    document.getElementById("original").style.display="none";
    document.getElementById("booksOfMonth").style.display="block";
    document.getElementById("wrapper2").style.display = "none";
}


function displayContent(i) {
    // document.getElementById(i).style.display="block";
    window.location.href="php/bookVisualize.php?content=" + i;
}

function addToList(bookId,username){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("alert").innerHTML = "";
            document.getElementById("alert").innerHTML = this.responseText;
            document.getElementById("overlay").style.display="block";
        }
    }
    xmlhttp.open("GET", "addToList.php?id=" + bookId, true);
    xmlhttp.send();
}

function on() {
    document.getElementById("overlay").style.display = "block";
  }
  
  function off() {
    document.getElementById("overlay").style.display = "none";
  }