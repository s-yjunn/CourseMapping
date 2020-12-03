function getBooks() {
    document.getElementById("headerBooks").style.display="block";
    document.getElementById("bookGrid").style.display="grid";
    
    document.getElementById("headerUsers").style.display = "none";
    document.getElementById("userGrid").style.display="none";
    document.getElementById("headerReviews").style.display = "none";
    document.getElementById("reviewsGrid").style.display="none";
}

function getUsers() {
    document.getElementById("userGrid").style.display="grid";
    document.getElementById("headerUsers").style.display = "block";

    document.getElementById("headerBooks").style.display="none";
    document.getElementById("bookGrid").style.display="none";
    document.getElementById("headerReviews").style.display = "none";
    document.getElementById("reviewsGrid").style.display="none";
}

function displayContent(i) {
    window.location.href="../Books/php/bookVisualize.php?content=" + i;
}

function getReviews() {
    document.getElementById("headerReviews").style.display="block";
    document.getElementById("reviewsGrid").style.display = "grid";

    document.getElementById("headerBooks").style.display="none";
    document.getElementById("bookGrid").style.display="none";
    document.getElementById("headerUsers").style.display = "none";
    document.getElementById("userGrid").style.display="none";
    
}

function displayReview(review) {
    
}