<!DOCTYPE html>
<html>
<?php
include ("vars/header.php");
include ("vars/navbar.php");
include ("src/accountUtilities.php");

// if uploading items 
// code written by Jessica
if (isset($_POST["title"]) && isset($_POST["image_url"]) && isset($_POST["tags"]) && isset($_POST["description"]) && isset($_POST["price"]))
{

    if (uploadItems($_POST["title"], $_POST["image_url"], $_POST["tags"], $_POST["description"], $_POST["price"])) {
        //success
        echo ('<div class="notification is-success floating" id="good-login">
        <button class="delete"></button>
        Successful item upload. Thank you!
    </div>');

    }
    else{
        //failure
        echo ('<div class="notification is-success floating" id="good-login">
        <button class="delete"></button>
        Bad item upload. Please try again.
    </div>');
    }
}


// if changing password:
    if (isset($_POST["pass1"]) && isset($_POST["pass2"]))
    {
        if (changePassword(getUserId($_SESSION["username"]),$_POST["pass1"], $_POST["pass2"]))
        {
    
            // success
            echo ('
                <div class="notification is-success floating" id="good-login">
                    <button class="delete"></button>
                    Password Changed!
                </div>
            ');
    
        }
        else
        {
    
            // failure
            echo ('
                    <div class="notification is-danger floating" id="bad-login">
                        <button class="delete"></button>
                        Passwords don\'t match.
                    </div>
                ');
    
        }
    }


// if changing picture:
    if (isset($_POST["imageURL"]))
    {
        if (changePicture($_POST["imageURL"]))
        {
    
            // success
            echo ('
                <div class="notification is-success floating" id="good-login">
                    <button class="delete"></button>
                    Image Changed!
                </div>
            ');
    
        }
        else
        {
    
            // failure
            echo ('
                    <div class="notification is-danger floating" id="bad-login">
                        <button class="delete"></button>
                        Image wasn\'t uploaded
                    </div>
                ');
    
        }
    }

// if changing info:
    if (isset($_POST["newInfo"]))
    {
        if (changeInfo($_POST["newInfo"]))
        {
    
            // success
            echo ('
                <div class="notification is-success floating" id="good-login">
                    <button class="delete"></button>
                    Info Updated!
                </div>
            ');
    
        }
        else
        {
    
            // failure
            echo ('
                    <div class="notification is-danger floating" id="bad-login">
                        <button class="delete"></button>
                        Info wasn\'t updated.
                    </div>
                ');
    
        }
    }



if (isset($_GET['id']))
{
    $items_sale = (getUserSelling(getUserName($_GET["id"])));
}
else
{
    $_GET['id'] = 0;
    $items_sale = (getUserSelling(getUserName($_GET["id"])));
}
?>

	<body>
		<section class="section" id="body">
			<div class="container">
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                            <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?php echo getUserName($_GET["id"]) ?>'s User Page</p>
                            <p class="subtitle is-6">
                                <?php 
                                    if(getUserPrivs($_GET["id"], "adm")) echo("<span class='tag is-danger'>Administrator</span> ");
                                    if(getUserPrivs($_GET["id"], "mod")) echo("<span class='tag is-warning'>Moderator</span> ");
                                    if(!getUserPrivs($_GET["id"], "mod") && !getUserPrivs($_GET["id"], "adm")) echo("<span class='tag is-success'>Regular User</span> ");
                                    if(isset($_SESSION["loggedIn"]) && $_SESSION["username"] == getUserName($_GET["id"])) echo("<span class='tag is-info'>You</span>");
                                ?>
                            </p>
                        </div>
                        </div>

                        <div class="content">
                            <div class="columns is-multiline">
                            <?php display_items($items_sale); ?> </div>
                        </div>
                    </div>
                </div>
			</div>
		</section>

        <section class="section" id="body">
            <div class="container">

            <div class="card">
                    <div class="card-content">
                        <div class="media">

                        <div class="media-content">

                        <p class="title is-4">Add New Item To Your Shop</p>
                            <p class="subtitle is-6">

                            <form method="POST">
                                <br>
                                <input class="input is-rounded mb-4 mt-4" type="text" name="title" placeholder="Title">
                                <input class="input is-rounded mb-4 mt-4" type="text" name="image_url" placeholder="Image URL">
                                <input class="input is-rounded mb-4 mt-4" type="text" name="tags" placeholder="Tags">
                                <input class="input is-rounded mb-4 mt-4" type="text" name="price" placeholder="Price">
                                <input class="input is-rounded mb-4 mt-4" type="text" name="description" placeholder="Description">
                                <input class="button is-primary mt-4" type="submit" value="Upload" id="upload-submit"> 
                            </form>

                            </p>

                            <br>

                            <p class="title is-4">Change Password</p>
                            <p class="subtitle is-6">

                            <form method="post">
                                <br>
                                <input class="input" type="text" name="pass1" placeholder="New Password"><br>
                                <input class="input" type="text" name="pass2" placeholder="Retype Password"><br>
                                <input type="submit" class = "button is-primary mt-4">
                            </form>

                            </p>
                            <br>

                            <p class="title is-4">Change Image</p>
                            <p class="subtitle is-6">

                            <form method="post">
                                <br>
                                <input class="input" type="text" name="imageURL" placeholder="Image URL"><br>
                                <input type="submit" class = "button is-primary mt-4">
                            </form>

                            </p>
                            <br>

                            <p class="title is-4">Change Info</p>
                            <p class="subtitle is-6">

                            <form method="post">
                                <br>
                                <input class="input" type="text" name="newInfo" placeholder="New Info"><br>
                                <input type="submit" class = "button is-primary mt-4">
                            </form>

                            </p>


                        </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>


		<?php
include ("vars/footer.php");
?>
	</body>

</html>
