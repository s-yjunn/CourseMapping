<?php
function search_store($desc, $sort, $direction)
{
    include("db_connect.php");
    
    $sql = "SELECT * FROM `items_for_sale` WHERE tags LIKE CONCAT('%',?,'%') ";
    $sql .= "OR title LIKE CONCAT('%',?,'%') ";
    $sql .= "OR description LIKE CONCAT('%',?,'%') ";
    $sql .= "OR seller LIKE CONCAT('%',?,'%') ";
    $sql .= "ORDER BY ";
    
    switch ($sort) {
        case "relevance":
            $sql .= "(CASE WHEN title LIKE CONCAT('%',?,'%') THEN 1 ELSE 0 END) ";
            break;
        
        case "price":
            $sql .= "price ";
            break;
    }
    
    switch ($direction) {
        case "desc":
            $sql .= "DESC;";
            break;
        
        case "asc":
            $sql .= "ASC;";
            break;
    }
    
    $query = $conn->prepare($sql);
    if ($sort == "relevance")
        $query->bind_param('sssss', $d, $d, $d, $d, $d);
    if ($sort == "price")
        $query->bind_param('ssss', $d, $d, $d, $d);
    
    $d = $desc;
    $query->execute();
    
    $res = $query->get_result();
    
    while ($row = $res->fetch_all()) {
        return $row;
    }
}
?>