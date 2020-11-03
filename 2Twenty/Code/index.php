<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test</title>
        <link rel="stylesheet" href="css/bulma.css">
        <link rel="stylesheet" href="css/twenty.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".navbar-burger").click(function() {
                    $(".navbar-burger").toggleClass("is-active");
                    $(".navbar-menu").toggleClass("is-active");
                });

                $("#more").click(function() {
                    $("body,html").animate({
                        scrollTop: $("#body").offset().top
                    }, 300);
                });
            });
        </script>
    </head>

    <body>

        <nav class="navbar is-white" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item">
                    <span class='twenty-title'>2Twenty</span>
                </a>
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item">Home</a>
                    <a class="navbar-item">About</a>
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-rounded is-outlined"><b>Sign up</b></a>
                            <a class="button is-danger is-rounded is-outlined">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <section class="hero is-primary is-fullheight is-bold">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Welcome to <span class='twenty-title'>2Twenty</span> Marketplace!
                    </h1>
                    <h2 class="subtitle">
                        Find things you love. Become an independent seller. All right here.
                    </h2>
                    <form class="field">
                        <div class="control">
                            <input class="input is-rounded" type="text" placeholder="Search for sellers and items">
                        </div>
                    </form>
                    <button class="button mt-4 is-rounded is-primary is-outlined is-inverted" id="more">
                        <span class="icon">
                            <i class="fas fa-arrow-down"></i>
                        </span>
                        <span>See More</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="section" id="body">
            <div class="container">
                <h1 class="title">Featured Items</h1>
                <h2 class="subtitle">Our top items, from our top sellers!</h2>
                <div class="columns">
                    <div class="column">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image"><img src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-2_large.png?format=jpg&quality=90&v=1530129318"></figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Sample Shoes</p>
                                        <p class="subtitle is-6">by @sampleshop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image"><img src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-5_large.png?format=jpg&quality=90&v=1530129458"></figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Sample Wrist Watch</p>
                                        <p class="subtitle is-6">by @sampleshop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image"><img src="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-product-4_large.png?format=jpg&quality=90&v=1530129360"></figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Sample Hat</p>
                                        <p class="subtitle is-6">by @sampleshop</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="content has-text-centered">
                <p>
                    <br/>
                    <span class='twenty-title'>2Twenty Marketplace</span><br/>
                    Powered by <a href="https://bulma.io"><img src="https://bulma.io/images/bulma-logo.png" width="56"></a> and a lot of ☕.<br/>
                    The source code is licensed <a href="http://opensource.org/licenses/mit-license.php">MIT</a>.
                </p>   
            </div>
        </footer>

    </body>

</html>