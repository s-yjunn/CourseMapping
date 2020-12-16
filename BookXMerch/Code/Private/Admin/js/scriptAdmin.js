//Author: Imane 
//Date: Dec 7th, 2020
function getBooks() {
    document.getElementById("headerBooks").style.display="block";
    document.getElementById("bookGrid").style.display="grid";
    
    document.getElementById("headerUsers").style.display = "none";
    document.getElementById("userGrid").style.display="none";
    document.getElementById("headerReviews").style.display = "none";
    document.getElementById("reviewsGrid").style.display="none";
    document.getElementById("headerRequests").style.display="none";
    document.getElementById("requestsGrid").style.display = "none";
}

function getUsers() {
    document.getElementById("userGrid").style.display="grid";
    document.getElementById("headerUsers").style.display = "block";

    document.getElementById("headerBooks").style.display="none";
    document.getElementById("bookGrid").style.display="none";
    document.getElementById("headerReviews").style.display = "none";
    document.getElementById("reviewsGrid").style.display="none";
    document.getElementById("headerRequests").style.display="none";
    document.getElementById("requestsGrid").style.display = "none";
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
    document.getElementById("headerRequests").style.display="none";
    document.getElementById("requestsGrid").style.display = "none";
}

function displayReview(review) {
    
}
getRequests();
function getRequests() {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("headerRequests").style.display="block";
            document.getElementById("requestsGrid").style.display = "block";
        
            document.getElementById("headerBooks").style.display="none";
            document.getElementById("bookGrid").style.display="none";
            document.getElementById("headerUsers").style.display = "none";
            document.getElementById("userGrid").style.display="none";
            document.getElementById("headerReviews").style.display="none";
            document.getElementById("reviewsGrid").style.display = "none";

            document.getElementById("showAll").innerHTML = this.responseText;
            var allCards = document.getElementsByClassName('request-card');
            document.getElementById("pendingRequests").innerHTML = allCards.length;
            }

            var acceptAll = document.getElementById("acceptAll");
            acceptAll.addEventListener('click', function(){
                var allCards = document.getElementsByClassName('request-card');
                for(card of allCards){
                    accept(t1);
                }
            });
        }
        xmlhttp.open("GET", "php/pendingReq.php", true);
        xmlhttp.send();
    }

    //Reject the Upload request 
    //Imane Berrada
    //Date: Monday, Dec 7th
    function reject(request){
        var id = request.id;
        var inside = request.childNodes[1].innerHTML;
        var parent = request.parentElement;
        parent.removeChild(request);

       //Send requests (using post Method)
        var allCards = document.getElementsByClassName('request-card');

        //Update number of pending requests
        document.getElementById("pendingRequests").innerHTML = allCards.length;

        var allElements=[];
        
        var count=1;
        for(card of allCards){
            allElements.push([card.id,card.childNodes[1].innerHTML]);
            
            card.setAttribute("id", "t"+(count++));
            newCount = count-1;
            card.childNodes[3].setAttribute('onclick',"display("+newCount+")");
            card.childNodes[5].setAttribute('onclick',"accept("+card.id+")");
            card.childNodes[7].setAttribute('onclick',"reject("+card.id+")");
            console.log(card);
            
            card.eve
        }
        var data = {
                fn: allElements,
                toRemove: [id,inside]
        };
        console.log(data);
        $.post("php/updateRejectedRequest.php", data);
    }

    //Accept the Upload request 
    //Imane Berrada
    //Date: Monday, Dec 7th
    function accept(request){
      
        var id = request.id;
        var inside = request.childNodes[1].innerHTML;
        var parent = request.parentElement;
        parent.removeChild(request);

        //Send requests (using post Method)
        var allCards = document.getElementsByClassName('request-card');

        //Update number of pending requests
        document.getElementById("pendingRequests").innerHTML = allCards.length;

        var allElements=[];

        var count=1;
        for(card of allCards){
            allElements.push([card.id,card.childNodes[1].innerHTML]);
 
            card.setAttribute("id", "t"+(count++));
            newCount = count-1;
            card.childNodes[3].setAttribute('onclick',"display("+newCount+")");
            card.childNodes[5].setAttribute('onclick',"accept("+card.id+")");
            card.childNodes[7].setAttribute('onclick',"reject("+card.id+")");
            console.log(card);
            
            card.eve
        }
        var data = {
                fn: allElements,
                toAdd: [id,inside]
        };
     
        $.post("php/updateAcceptedRequest.php", data);
    }

    //Display Book details
    function display(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) { 
                document.getElementById("bookDetails").innerHTML=this.responseText;
                document.getElementById("bookDetails").style.display="block";
            }

        }
        xmlhttp.open("GET", "php/bookDetails.php?content=" + id, true);
        xmlhttp.send();
    }