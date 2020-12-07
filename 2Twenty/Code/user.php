<!DOCTYPE html>
<html>
<?php
include ("vars/header.php");
include ("vars/navbar.php");


// if registering:
    if (isset($_GET["pass1"]) && isset($_GET["pass2"]))
    {
        echo ("YEEE");
        if (handle_registration($_POST["uname_r"], $_POST["upass_r"]))
        {
    
            // success
            echo ('
                <div class="notification is-success floating" id="good-login">
                    <button class="delete"></button>
                    Successful registration. Thank you!
                </div>
            ');
    
        }
        else
        {
    
            // failure
            echo ('
                    <div class="notification is-danger floating" id="bad-login">
                        <button class="delete"></button>
                        Bad registration. Please try again.
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
                            <p class="title is-4">Change Password</p>
                            <p class="subtitle is-6">

                            <form action="src/changePassword.php" method="get">
                                <br>
                                <input class="input" type="text" name="pass1" placeholder="New Password"><br>
                                <input class="input" type="text" name="pass2" placeholder="Retype Password"><br>
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