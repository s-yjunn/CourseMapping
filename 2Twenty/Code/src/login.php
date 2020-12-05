<?php
function handle_login($uname, $pass)
{
    include ("db_connect.php");

    // verify username:
    $sql = "SELECT * FROM `user` WHERE user = ?;";
    $query = $conn->prepare($sql);
    $query->bind_param('s', $u);

    $u = $uname;
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0)
    {

        // verify password:
        $sql = "SELECT * FROM `user` WHERE pass = ?;";
        $query = $conn->prepare($sql);
        $query->bind_param('s', $p);

        $p = md5($pass); // salted password
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0)
        {
            return 1; // success
            
        }
        else
        {
            return 0; // wrong password
            
        }

    }
    else
    {
        return 0; // wrong username;
        
    }

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
        $sql = "REPLACE INTO store.user(user, pass, mod_priv, admin_priv)";
        $sql .= "   VALUES(?, md5(?), 0, 0);";
        $query = $conn->prepare($sql);
        $query->bind_param('ss', $u, $p);

        $u = $uname;
        $p = md5($pass); // salted password
        $query->execute();

        return 1; // registration success;
        
    }

}

?>
