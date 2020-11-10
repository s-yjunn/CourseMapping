<!DOCTYPE html>
<html>

    <?php 
        include("vars/header.php");
        include("vars/navbar.php");
        include("src/search.php");

        if($_GET['desc']) {
            $results = (search_store($_GET['desc']));
        } else {
            header("Location: index.php");
        }
    ?>

    <body>

        <section class="section" id="body">
            <div class="container">
                <h1 class="title">Searching for "<?php echo $_GET['desc']; ?>"...</h1>
                <form class="field" action="search.php" method="GET">
                    <div class="control">
                        <input class="input is-rounded" type="text" name="desc" value="<?php echo $_GET['desc']; ?>">
                    </div>
                </form>
                <br/>
                <div class="columns is-multiline">
                    
                        <?php 
                            if($results) {
                                foreach($results as &$item) {
                                    $title = $item[1];
                                    $image_url = $item[2];
                                    $tags = explode(", ",$item[3]);
                                    $desc = $item[4];
                                    $seller = $item[5];
                                    $price = $item[6];

                                    echo('
                                    <div class="column is-full-mobile is-half">
                                        <div class="box">
                                            <article class="media">
                                                <div class="media-left">
                                                    <figure class="image is-64x64">
                                                        <img src="'.$image_url.'" alt="'.$title.'">
                                                    </figure>
                                                </div>
                                                <div class="media-content">
                                                    <div class="content">
                                                        <p>
                                                            <strong>@'.$seller.'</strong> is selling <strong>'.$title.'</strong> for <span class="tag is-success">$'.$price.'</span>
                                                            <br/>
                                                            <div class="notification is-light">'.$desc.'</div>
                                                            
                                    ');
                
                                                        foreach($tags as &$tag) {
                                                            echo(' <a href="search.php?desc='.$tag.'"><div class="tag is-danger">'.$tag.'</div></a> ');
                                                        }

                                    echo('
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    ');
                                }
                            } else {
                                echo('<h2 class=subtitle>No results. Please try again.</h1>');
                            }

                        ?>
                    
                </div>
            </div>
        </section>

        <?php
            include("vars/footer.php");
        ?>

    </body>

</html>