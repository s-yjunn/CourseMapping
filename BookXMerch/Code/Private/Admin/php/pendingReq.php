<!-- Author: Imane | Date: Dec 7th, 2020--> 
<?php 

    echo "<script type='text/javascript' src='../js/scriptAdmin.js'> </script>";
    session_start();

    if(isset($_SESSION["name"])) {
        $loggedUser = $_SESSION["username"];
    } 

    $reqsJSON = file_get_contents("../../Books/BookDefault/Pending/allPendingBooks.json");
    $rowsAll= json_decode($reqsJSON, true);
    $rows = $rowsAll['requests'];
    if(sizeof($rows)==0) {
        echo "<p class='w3-center'> You have no pending requests.</p>";
    }
    $i=0;
    foreach ($rows as $jsons) { 
        $i++;
        $t = "t"+$i;
        echo "<div class='request-card' id='t".$i."'>
                <p class='request-text color-blue'>".$jsons["reqUsername"]."</p>
                <button class='bookDetails' onclick='display(".$t.")'> Book details </button>
                <button onclick='accept(t".$i.")' id='a".$i."' class='w3-green accept'>Accept</button>
                <button onclick='reject(t".$i.")' class='w3-red reject'>Reject</button>
                </div>";
    }
      

?>


