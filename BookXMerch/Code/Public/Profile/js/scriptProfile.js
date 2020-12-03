function getUpload() {
    document.getElementById("rList").style.display="none";
    document.getElementById("userDetails").style.display="none";
    document.getElementById("reviewsList").style.display = "none";
    document.getElementById("uploadButton").style.display = "block";
}
function showUploadModal(){
    document.getElementById("uploadButton").style.display="none";
    document.getElementById("uploadForm").style.display="block";
}

function closeUploadModal(){
    document.getElementById("uploadButton").style.display="block";
    document.getElementById("uploadForm").style.display="none";
}

function getList() {
    // document.getElementById("userDetails").style.display="none";
    // document.getElementById("rList").style.display="block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("rList").style.display="block";
            document.getElementById("userDetails").style.display="none";
            document.getElementById("reviewsList").style.display = "none";
            document.getElementById("uploadButton").style.display = "none";
            document.getElementById("showAll").innerHTML = this.responseText;
            var task_count = document.getElementById("readingSize").innerHTML;
    
                
            //Modified by BxM
            //From Akash Pal's blog https://blog.usejournal.com/create-a-to-do-list-application-with-html-css-and-pure-js-533e1b07c20e
    
            var del_buttons = document.getElementsByClassName('delete'); 
            var task_container = document.querySelector('.tasks-container');
            var task_input = document.getElementById('new-task')
            var completeAll = document.getElementById('check-all-button');
            var clearComplete = document.getElementById('clearComplete');
            var showAll = document.getElementById('show-all');
            var showComplete = document.getElementById('showComplete');
            var showInprogress = document.getElementById('showInprogress');
            var showNotStarted = document.getElementById('showNotStarted');
            var showState = 'show-all';
            showAll.style.color="white";
    
                
            var task_card_string = "<div class=\"status-icon\"></div><p class=\"task-text\"><p class=\"task-status color-red\">Not-Started</p><ion-icon class=\"delete fs-large mg-10\" name=\"close-circle-outline\"></ion-icon>"
    
            updateTaskCount();
            eventSetter();
    
            function updateTaskCount(){
                document.getElementById("taskLeftCount").innerHTML=task_count;
            }
    
            function eventSetter(){
                var del_buttons = document.getElementsByClassName('delete'); 
                for(del of del_buttons){
                    del.addEventListener('click',removeCard);
                }
                var progress_buttons = document.getElementsByClassName('status-icon');
                for(p of progress_buttons){
                    p.addEventListener('click', changeProgress);
                }
                var cards = document.getElementsByClassName('task-card-RL');
                // console.log(cards);
                for(let i=0;i<cards.length;i++){
                    // console.log(cards[i]);
                    cards[i].addEventListener('mouseover', function(){
                        // console.log(cards[i]);
                        cards[i].children[3].style.visibility="initial";
                    })
                    cards[i].addEventListener('mouseleave', function(){
                        // console.log(cards[i].children[3].style.visibility);
                        cards[i].children[3].style.visibility="hidden";
                    })
                }
                    
            }
    
            function reassignIDs(){
                var cards = document.getElementsByClassName('task-card-RL');
                var count=1;
                for(card of cards){
                    card.setAttribute("id", "t"+(count++));
                    card.eve
                }
            }
    
            function resetColor(){
                var allButtons = document.getElementsByClassName('filter-button');
                for(button of allButtons)
                    button.style.color = "gray";
            }
    
            function removeCard(){
                var parent = this.parentElement;
                parent.classList.add('delete-card');
                setTimeout(function(){
    
                    parent.parentNode.removeChild(parent);
                    updateTaskCount();
                    reassignIDs(); 
                    eventSetter();
                }, 550)
                task_count --;
    
            }
    
            function changeProgress(){
    
                var parentCard = this.parentElement;
                var status = parentCard.classList[1];
                parentCard.classList.remove(status);
                var statusElem = parentCard.children[2];
                
                if(status == 'Not-Started'){
                    parentCard.classList.add('In-progress');
                    statusElem.innerHTML="In-progress";
                    statusElem.classList.remove(statusElem.classList[1]);
                    statusElem.classList.add('color-blue');
    
                }
                else if(status =='Completed'){
                    parentCard.classList.add('In-progress');
                    statusElem.innerHTML="In-progress";
                    statusElem.classList.remove(statusElem.classList[1]);
                    statusElem.classList.add('color-blue');
                }
                else{
                    parentCard.classList.add('Completed');
                    statusElem.innerHTML="Completed";
                    statusElem.classList.remove(statusElem.classList[1]);
                    statusElem.classList.add('color-green');
                }
            }
    
    
            clearComplete.addEventListener('click', function(){
                let cards = document.getElementsByClassName('Completed');
                let parent = cards[0].parentElement;
                let length = cards.length;
                let count=length-1;
                intervalID = setInterval(function(){
                    cards[count].classList.add('delete-card');
                    task_count--;
                    setTimeout(function(){
                        this.parentNode.removeChild(this); 
                        updateTaskCount();
                }.bind(cards[count]),500 )
                    count--;
                    if(count<0){
                        clearInterval(intervalID);
                    }
                }, 500);
                    
    
            });
            showAll.addEventListener('click',function(){
                    
                if(showState !='show-all'){
                    resetColor();
                    this.style.color="white";
                    var allCards = document.getElementsByClassName('task-card-RL');
                    for(card of allCards){
                        card.style.display = "flex";
                    }
                    showState ='show-all';
                }
            });
    
    
    
            showComplete.addEventListener('click',function(){
                    
                if(showState !='showComplete'){
                    resetColor();
                    this.style.color="white";
                    var allCards = document.getElementsByClassName('task-card-RL');
                    // allCards[0].style.display = "none";
                    for(card of allCards){
                        if(card.classList[1]!='Completed')
                            card.style.display = "none";
                        else
                            card.style.display = "flex";
                    }
                    showState = 'showComplete';
                }
            });
    
            showInprogress.addEventListener('click',function(){
    
                if(showState !='showInprogress'){
                    resetColor();
                    this.style.color="white";
                    var allCards = document.getElementsByClassName('task-card-RL');
                    // allCards[0].style.display = "none";
                    for(card of allCards){
                        if(card.classList[1]!='In-progress')
                            card.style.display = "none";
                        else
                            card.style.display = "flex";
                    }
                    showState = 'showInprogress';
                }
            });
            showNotStarted.addEventListener('click',function(){
    
                if(showState !='showNotStarted'){
                    resetColor();
                    this.style.color="white";
                    var allCards = document.getElementsByClassName('task-card-RL');
                    // allCards[0].style.display = "none";
                    for(card of allCards){
                        if(card.classList[1]!='Not-Started')
                            card.style.display = "none";
                        else
                            card.style.display = "flex";
                    }
                    showState = 'showNotStarted';
                }
            });
            }
        }
        xmlhttp.open("GET", "php/readingList.php", true);
        xmlhttp.send();
    }
    


// buttonReadingList = document.getElementById("reading-list-button"); 
// buttonReadingList.addEventListener('click', getList());

function getReviews() {
    var xmlhttp = new XMLHttpRequest();
    //var params = 'username=' + username + '&name' + name; 
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            // something changes here when we get the reviews processed.
            document.getElementById("userDetails").style.display = "none";
            document.getElementById("rList").style.display="none";
            document.getElementById("uploadButton").style.display = "none";
            document.getElementById("reviewsList").style.display = "block";
            reviewsByUser = this.responseText;
            console.log("this: ", JSON.parse(reviewsByUser)); 
            addReviews(JSON.parse(reviewsByUser)); 
            // show the tab with all the details of the reviews by the user.
            

        }
    }

    xmlhttp.open("POST", "php/reviews.php", true);
    xmlhttp.send();
}

var reviews_container = document.querySelector('.reviews-container');
console.log("reviews container: ", reviews_container); 


function addReviews(reviewsByUser) {
    // add style --> come back later.

    


    // clear out all reviews every time and then fill them. 
    reviews_container.innerHTML = "";

    // array of users reviews in the form {id, rating, comment}. create divs and populate the reviews container 
    //task_container.appendChild(task_card);
    var review_main= document.createElement('div');
    for(i=0; i<reviewsByUser.length; i++) {

        // console.log("times run: ", i);

        var review_card = document.createElement('div');
        var styleContentDiv = "<div class=\"status-icon\"></div><p class=\"task-text color-blue\">"+reviewsByUser[i].title+"</p><br><p class=\"task-text\">"+reviewsByUser[i].comment+"</p><br><a class=\"task-status color-blue\" href=\"../../../../../../common/BookXMerch/Code/Private/Books/php/bookVisualize.php?content="+reviewsByUser[i].id+"\">Book Details</a>";
        review_card.innerHTML = styleContentDiv; 
        review_card.setAttribute("class", "task-card-RL In-progress"); 
        review_card.setAttribute("id", "r"+i);
        
        

        
        review_main.appendChild(review_card);
        
        //let card_text = document.querySelector('#r' + i + " p");
        //card_text.innerHTML = "Book ID: "+ reviewsByUser[i].id + ", Rating: " + reviewsByUser[i].rating + ", Comment: " + reviewsByUser[i].comment;
    }
    console.log("review main", review_main);
    reviews_container.appendChild(review_main);
}


//BxM: passing card details (title and status) to php
        
function passVal(){
    //Saved reading list snackbar (pop-up)
    var x = document.getElementById("savedList");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    //Send updated list (using post Method)
    var allCards = document.getElementsByClassName('task-card-RL');
    var allElements=[];
    for(card of allCards){
        allElements.push([card.childNodes[9].innerHTML,card.childNodes[3].innerHTML,card.classList[1]])
    }
    var data = {
        
            fn: allElements,
            str: "this_is_a_dummy_test_string2"
    };

    $.post("php/updateList.php", data);
}