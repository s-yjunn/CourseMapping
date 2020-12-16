// <!-- Author: Imane Berrada | Date: Nov 24th, 2020--> 
$(document).ready(function () {
    
    $(".imgButton").click(function () {

        if ($("#overlayLogin").is(':hidden')) {
            $("#overlayLogin").show();
            $(".imgButton").css({ "filter": "grayscale(100%)" });
 
        } else {
            $("#overlayLogin").hide();
            $(".imgButton").css({ "filter": "grayscale(0%)" });
        };
        
    });
});

function off() {
    document.getElementById("overlayLogin").style.display = "none";
    $(".imgButton").css({ "filter": "grayscale(0%)" });
}