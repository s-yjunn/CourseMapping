function getBooks() {
    document.getElementById("headerBooks").style.display="block";
    document.getElementById("bookGrid").style.display="grid";
    document.getElementById("headerUsers").style.display = "none";
    document.getElementById("userGrid").style.display="none";
    
}

function getUsers() {
    document.getElementById("headerBooks").style.display="none";
    document.getElementById("bookGrid").style.display="none";
    document.getElementById("userGrid").style.display="grid";
    document.getElementById("headerUsers").style.display = "block";
}

function displayContent(i) {
    window.location.href="../Books/php/bookVisualize.php?content=" + i;
}