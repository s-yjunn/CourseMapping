<!DOCTYPE html>
<html>
<?php
include("vars/header.php");
include("vars/navbar.php");
include("src/utilities.php");

$_GET['id'] = (isset($_GET['id']) ? $_GET['id'] : 0);

$items_sale = (getUserSelling(getUserName($_GET["id"])));
$portrait   = (getUserImage($_GET["id"]));
$joined     = (getUserJoined($_GET["id"]));
$info       = (getUserInfo($_GET["id"]));

if (isset($_POST["title"], $_POST["image_url"], $_POST["tags"], $_POST["description"], $_POST["price"])) {
    if ((!empty($_POST["title"]) && !empty($_POST["image_url"]) && !empty($_POST["tags"]) && !empty($_POST["description"]) && !empty($_POST["price"])) && (trim($_POST["title"] !== '') && trim($_POST["image_url"] !== '') && trim($_POST["tags"] !== '') && trim($_POST["description"] !== '') && trim($_POST["price"] !== ''))) {
        if (uploadItems($_POST["title"], $_POST["image_url"], $_POST["tags"], $_POST["description"], $_POST["price"]))
            notifyGood("Successful item upload! <a onClick='location.reload();'>Refresh</a> to see your new item.");
        else
            notifyBad("Bad upload attempt. Please try again.");
    } else
        notifyBad("Bad upload attempt. Please try again.");
}

// if changing password:
if (isset($_POST["pass1"], $_POST["pass2"])) {
    if ((!empty($_POST["pass1"])) && (trim($_POST["pass1"] !== ''))) {
        if (changePassword(getUserId($_SESSION["username"]), $_POST["pass1"], $_POST["pass2"]))
            notifyGood("Successfully changed password! Log out to use your new password.");
        else
            notifyBad("Bad password change attempt. Please try again.");
    } else
        notifyBad("Bad password change attempt. Please try again.");
}

// if changing picture:
if (isset($_POST["imageURL"])) {
    if (changePicture(getUserId($_SESSION["username"]), $_POST["imageURL"]))
        notifyGood("Profile information successfully changed! <a onClick='location.reload();'>Refresh</a> to see your changes.");
    else
        notifyBad("Profile unchanged. Please try again.");
}

// if changing info:
if (isset($_POST["newInfo"])) {
    if (changeInfo(getUserId($_SESSION["username"]), $_POST["newInfo"]))
        notifyGood("Profile information successfully changed! <a onClick='location.reload();'>Refresh</a> to see your changes.");
    else
        notifyBad("Profile description unchanged. Please try again.");
}

?>

    <body>
        <section class="section" id="body">
            <div class="container">
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-64x64"> <img src="<?php
echo $portrait;
?>"> </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">
                                    <?php
echo getUserName($_GET["id"]);
?>'s User Page</p>
                                <p class="subtitle is-6">
                                    <?php
if (getUserPrivs($_GET["id"], "adm"))
    echo ("<span class='tag is-danger'>Administrator</span> ");
if (getUserPrivs($_GET["id"], "mod"))
    echo ("<span class='tag is-warning'>Moderator</span> ");
if (!getUserPrivs($_GET["id"], "mod") && !getUserPrivs($_GET["id"], "adm"))
    echo ("<span class='tag is-success'>Regular User</span> ");
if (isset($_SESSION["loggedIn"]) && $_SESSION["username"] == getUserName($_GET["id"]))
    echo ("<span class='tag is-info'>You</span>");
?> </p>
                            </div>
                        </div>
                        <div class="tabs is-centered">
                            <ul>
                                <li class="is-active" id="about">
                                    <a onClick="
                                        $('#about_tab').removeClass('is-hidden'); 
                                        $('#selling_tab').addClass('is-hidden');
                                        $('#settings_tab').addClass('is-hidden');

                                        $('#about').addClass('is-active');
                                        $('#selling').removeClass('is-active');
                                        $('#settings').removeClass('is-active');
                                    "> <span class="icon is-small"><i class="fas fa-address-card"></i></span> <span>About</span> </a>
                                </li>
                                <li id="selling">
                                    <a onClick="
                                        $('#about_tab').addClass('is-hidden'); 
                                        $('#selling_tab').removeClass('is-hidden');
                                        $('#settings_tab').addClass('is-hidden');

                                        $('#about').removeClass('is-active');
                                        $('#selling').addClass('is-active');
                                        $('#settings').removeClass('is-active');
                                    "> <span class="icon is-small"><i class="fas fa-shopping-bag"></i></span> <span>For Sale</span> </a>
                                </li>
                                <?php
if (isset($_SESSION["loggedIn"]) && $_SESSION["username"] == getUserName($_GET["id"]))
    echo ("
                                        <li id=\"settings\">
                                            <a onClick=\"
                                                $('#about_tab').addClass('is-hidden'); 
                                                $('#selling_tab').addClass('is-hidden');
                                                $('#settings_tab').removeClass('is-hidden');
        
                                                $('#about').removeClass('is-active');
                                                $('#selling').removeClass('is-active');
                                                $('#settings').addClass('is-active');
                                            \">
                                            <span class=\"icon is-small\"><i class=\"fas fa-cog\"></i></span>
                                            <span>Utilities</span>
                                            </a>
                                        </li>
                                    ");
?>
                           </ul>
                        </div>
                        <div class="content" id="about_tab">
                            <div class="title is-4 mb-4">About
                                <?php
echo getUserName($_GET['id']);
?>
                           </div>
                            <div class="subtitle is-6 mb-4">Member since
                                <?php
echo $joined;
?>.</div>
                            <div class="notification is-light">
                                <?php
echo $info;
?>
                           </div>
                        </div>
                        <div class="content is-hidden" id="selling_tab">
                            <div class="title is-4 mb-4">
                                <?php
echo getUserName($_GET['id']);
?>'s Shop</div>
                            <div class="columns is-multiline">
                                <?php
display_items($items_sale);
?>
                           </div>
                        </div>
                        <div class="content is-hidden" id="settings_tab">
                            <div class="title is-4 mb-4">Settings</div>
                            <div class="subtitle is-6 mt-4 mb-4">Upload Items to Shop</div>
                            <form method="POST">
                                <div class="control">
                                    <input class="input" type="text" name="title" maxlength="128" placeholder="Title">
                                    <input class="input mt-1" type="text" name="image_url" placeholder="Image URL">
                                    <input class="input mt-1" type="text" name="tags" placeholder="Tags">
                                    <input class="input mt-1" type="text" name="price" placeholder="Price">
                                    <textarea class="textarea mt-1" name="description" maxlength="1024" placeholder="Description"></textarea>
                                    <input class="button is-primary mt-2" type="submit" value="Upload"> 
                                </div>
                            </form>
                            <hr class="divider"/>
                            <div class="subtitle is-6 mt-4 mb-4">Change Profile Info</p>
                            <form method="POST">
                                <div class="control">
                                    <input class="input mt-1" type="text" name="imageURL" value="<?php
echo $portrait;
?>"><br>
                                    <textarea class="textarea mt-1" name="newInfo" maxlength="1024"><?php
echo $info;
?></textarea>
                                    <input class="button is-primary mt-2" type="submit" value="Edit Profile">
                                </div>
                            </form>
                            <hr class="divider"/>
                            <div class="subtitle is-6 mt-4 mb-4">Change Password</p>
                            <form method="POST">
                                <div class="control">
                                    <input class="input mt-1" type="text" name="pass1" placeholder="New Password"><br>
                                    <input class="input mt-1" type="password" name="pass2" placeholder="Confirm New Password"><br>
                                    <input class="button is-danger is-outlined mt-2" type="submit" value="Change Password">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
include("vars/footer.php");
?>
   </body>

</html>