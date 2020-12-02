<!DOCTYPE html>
<html>
<?php 
        include("vars/header.php");
        include("src/featured.php");
        include("src/search.php");
        include("src/itemsSelling.php");

        $cart;
        //$cart = (show_cart());

        
        $uname = 'shoePainter';

        $selling = (search_selling($uname));

?>


<nav class="navbar is-white" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<div class="navbar-item"> <a href='index.php'><span class='twenty-title'>2Twenty</span></a> </div>
			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"> <span aria-hidden="true"></span> <span aria-hidden="true"></span> <span aria-hidden="true"></span> </a>
		</div>
		<div class="navbar-menu">
			<div class="navbar-end"> <a class="navbar-item" href="index.php">Home</a> <a class="navbar-item">About</a>
				<div class="navbar-item">
					<?php
                    if(false) {
                        echo('
                        <div class="buttons">
                            <a class="button is-primary is-rounded is-outlined" id="register"><b>Sign up</b></a>
                            <a class="button is-danger is-rounded is-outlined" id="login">Log in</a>
                        </div>
                        ');
                    } else {
                        echo('
                        <div class="navbar-item">Welcome back, '.$uname. ' <strong class="ml-1">'.$_SESSION["username"].'</strong>!</div>
                        <div class="buttons">
                            <form class="field" method="POST" action="index.php">
                                <input type="submit" name="logout" class="button is-danger is-rounded is-outlined" value="Logout">
                            </form>
                        </div>
                        ');
                    }
                ?> </div>
			</div>
		</div>
	</nav>



	<body>

		<section class="section" id="body">
			<div class="container">
				<h1 class="title">Your Page</h1>

                <h2 class="subtitle">Your cart</h2>
				<div class="columns">
					<?php 
                        foreach($cart as &$item) {
                            $title = $item[1];
                            $image_url = $item[2];
                            $seller = $item[5];

                            echo('
                            <div class="column is-2">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-256x256"><img src="'.$image_url.'"></figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4">'.$title.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ');
                        }
                    ?> </div>

				<h2 class="subtitle">Items you are selling</h2>
				<div class="columns">
					<?php 
                        foreach($selling as &$item) {
                            $title = $item[1];
                            $image_url = $item[2];
                            $seller = $item[5];

                            echo('
                            <div class="column is-2">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-256x256"><img src="'.$image_url.'"></figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4">'.$title.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ');
                        }
                    ?> </div>
			</div>
		</section>
		<?php
            include("vars/footer.php");
        ?>
	</body>





</html>