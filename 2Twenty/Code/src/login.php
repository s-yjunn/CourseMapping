<?php
function handle_login($uname, $pass)
{
    include ("db_connect.php");

    // verify username:
    $sql = "SELECT * FROM `user` WHERE user = ? AND pass = md5(?);";
    $query = $conn->prepare($sql);
    $query->bind_param('ss', $u, $p);

    $u = $uname;
    $p = $pass;

    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) return 1;
    else return 0;

}

function handle_registration($uname, $pass)
{
    include ("db_connect.php");

    // verify username not taken:
    $sql = "SELECT * FROM `user` WHERE user = ?;";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $u);

    $u = $uname;
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0)
    {
        return 0; // username taken;
        
    }
    else
    {
        // register user:
        $sql = "REPLACE INTO store.user(user, pass, mod_priv, admin_priv, imageURL, info, joined)";
        $sql .= "   VALUES(?, md5(?), 0, 0, ?, ?, ?);";
        $query = $conn->prepare($sql);
        $query->bind_param('sssss', $u, $p, $pic, $desc, $d);

        $u = $uname;
        $p = $pass;
        $pic = "https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png";
        $desc = "Hello World!";
        $d = date("Y-m-d");

        $query->execute();

        return 1;

    }

}

?>
