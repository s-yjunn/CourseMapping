function updateVote(i){

    var compData = JSON.parse("../data/contest.json");
  
    var currentData = compData.contestants;
  
        currentData[i].votes += 1;

        $("#hide").click(function(){
            $("#hide").hide();
          });
  
  }