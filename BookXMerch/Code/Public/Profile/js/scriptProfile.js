

function getList() {
    // document.getElementById("userDetails").style.display="none";
    // document.getElementById("rList").style.display="block";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("rList").style.display="block";
            document.getElementById("userDetails").style.display="none";
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
                var cards = document.getElementsByClassName('task-card');
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
                var cards = document.getElementsByClassName('task-card');
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
                    var allCards = document.getElementsByClassName('task-card');
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
                    var allCards = document.getElementsByClassName('task-card');
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
                    var allCards = document.getElementsByClassName('task-card');
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
                    var allCards = document.getElementsByClassName('task-card');
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

    //BxM: passing card details (title and status) to php
           
    function passVal(){
        var allCards = document.getElementsByClassName('task-card');
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