
$(document).ready(function () {
    
    $(".imgButton").click(function () {
        
        if ($("#pleaseLogin").is(':hidden')) {
            $("#pleaseLogin").show();
            $(".imgButton").css({ "filter": "grayscale(100%)" });
 
        } else {
            $("#pleaseLogin").hide();
            $(".imgButton").css({ "filter": "grayscale(0%)" });
        };
        
    });
    
    $("#closeModal").click(function () {
        $("#pleaseLogin").hide();
        $(".imgButton").css({ "filter": "grayscale(0%)" });
    });
});