
<?php
session_start();

?>
    <body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <header>
        <br>
        <br>
        <!--Navigation-->
        <header class="site-header">
            <nav id="menu" class="navbar container">
                <div class="navbar-header">
                    <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
                    <a class="navbar-brand" href="#">
                        <div class="logo"><span> <b><i>SaryAgash</i> </b></span></div>
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>

                        <li><a href="news.php"><i class="fa fa-cubes"></i> News</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Category <i class="fa fa-arrow-circle-o-down"></i></a>
                            <div class="dropdown-menu" style="margin-left:0;">
                                <div class="dropdown-inner">
                                    <ul class="list-unstyled">
                                        <?php
                                        $query = "SELECT * FROM categories ORDER BY id DESC";
                                        $run = mysqli_query($con,$query);
                                        if(mysqli_num_rows($run) > 0){
                                            while($row = mysqli_fetch_array($run)){
                                                $category = ucfirst($row['category']);
                                                $id = $row['id'];
                                                echo "<li><a href='news.php?cat=".$id."'>$category</a></li>";
                                            }
                                        }
                                        else{
                                            echo "<li><a href='#'>No Categories Yet</a></li>";
                                        }
                                        ?>
                                       <!-- <li><a href="products.html">auto News</a></li>
                                        <li><a href="itech.html">Technologies</a></li>
                                        <li><a href="archive.html">Service</a></li>
                                        <li><a href="jobs.html">Jobs</a></li>-->
                                    </ul>
                                </div>
                            </div>
                    </ul>
                    <ul class="nav navbar-nav" style="float: right;">

                    <?php
                    if (isset($_SESSION['username'])){
                    $author = $_SESSION['username'];

                    ?>
                        <li><a href="login.php"><?php echo ucfirst($author) ?></a></li>
                        <li><a href="contact-us.php"> Contact <i class="fa fa-envelope"></i></a></li>
                        <li><a href="/admin/index.php"> Go to Panel <i class="fa fa-dashboard"></i></a></li>

                        <?php

                    }
                    else {
                        ?>
                        <li><a href="login.php">Sign In </a></li>
                        <li><a href="registration.php">Sign Up </a></li>
                        <li><a href="contact-us.php"> Contact <i class="fa fa-envelope"></i></a></li>
                        <?php

                    }
                    ?>
                    </ul>
                </div>
            </nav>
        </header>
    </header>