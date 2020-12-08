<?php
function show_featured()
{
    include("db_connect.php");
    
    $sql = "SELECT * FROM `items_for_sale`";
    $sql .= "INNER JOIN featured ON items_for_sale.id = featured.id";
    $query = $conn->query($sql);
    while ($row = $query->fetch_all()) {
        return $row;
    }
    
}
?>