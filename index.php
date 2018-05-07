<?php require_once('inc/top.php');?>

<?php

require_once('inc/header.php');


$number_of_posts = 3;

if(isset($_GET['page'])){
    $page_id = $_GET['page'];
}
else{
    $page_id = 1;
}

if(isset($_GET['cat'])){
    $cat_id = $_GET['cat'];
    $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
    $cat_run = mysqli_query($con, $cat_query);
    $cat_row = mysqli_fetch_array($cat_run);
    $cat_name = $cat_row['category'];
}


?>
<br>
        <div class="featured container">
            <div class="row">
                <div class="col-sm-8">
                    <!-- Carousel -->
                    <?php
                    $slider_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5";
                    $slider_run = mysqli_query($con, $slider_query);
                    if(mysqli_num_rows($slider_run) > 0){
                    $count = mysqli_num_rows($slider_run);
                    ?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            for($i = 0; $i < $count; $i++){
                                if($i == 0){
                                    echo "<li data-target='#carousel-example-generic' data-slide-to='".$i."' class='active'></li>";
                                }
                                else{
                                    echo "<li data-target='#carousel-example-generic' data-slide-to='".$i."'></li>";
                                }
                            }
                            ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <?php
                            $check = 0;
                            while($slider_row = mysqli_fetch_array($slider_run)){
                            $slider_id = $slider_row['id'];
                            $slider_image = $slider_row['image'];
                            //$slider_title = $slider_row['title'];
                            $check = $check + 1;
                            if($check == 1){
                                echo "<div class='item active'>";
                            }
                            else{
                                echo "<div class='item'>";
                            }
                            ?>
                            <!--<div class="item active">-->

                            <a href="post.php?post_id=<?php echo $slider_id;?>"><img src="img/<?php echo $slider_image;?>" alt="First slide"></a>
                            <div class="carousel-caption">

                            </div>

                            <!-- Static Header -->

                        </div>
                        <?php } ?>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div><!-- /carousel -->
            </div>
        <?php } ?>
            <div class="col-sm-4" >
                <div class="heading" >
                    <h3>
                        Who we are
                    </h3>
                    <p>
                        The World Food Initiative (WFD is a non-profit charity, established in 1993, with the mission of eliminating hunger in the world. The WF envisions a world where all people have access to the food they need to lead active, healthy, and productive lives.
                    </p>
                    <p>
                        To help realize that vision, we solicit and coordinate donations, grants, fundraising, food drives, food rescue. harvesting and volunteers to supply food, education and advocacy for the hungry through non-profit partne ships and direct feeding programs
                    </p>
                </div>
            </div>
        </div>

    <div id="page-content" class="index-page container">
        <div class="row">

            <div id="main-content"><!-- background not working -->

                <div class="col-md-8">

                    <div class="box wrap-vid">
                        <div class="box-header header-natural">
                            <h2>Recently News</h2>
                        </div>
                        <?php

                        $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 1";
                        $p_run = mysqli_query($con,$p_query);
                        if(mysqli_num_rows($p_run) > 0){
                        while($p_row = mysqli_fetch_array($p_run)){
                        $p_id = $p_row['id'];
                        $p_date = getdate($p_row['date']);
                        $p_day = $p_date['mday'];
                        $p_month = $p_date['month'];
                        $p_year = $p_date['year'];
                        $p_title = $p_row['title'];
                        $p_image = $p_row['image'];
                        $p_author = $p_row['author'];
                        $p_post_data = $p_row['post_data'];

                        ?>
                        <div class="zoom-container">
                            <div class="zoom-caption">
                                <span class="youtube">Fresh</span>
                                <!--<a href="single.html">
                                    <i class="fa fa-play icon-play" style="color: #fff"></i>
                                </a>-->
                                <a href="post.php?post_id=<?php echo $p_id;?>"><p><?php echo $p_title;?></p></a>
                            </div>
                           <img src="img/<?php echo $p_image;?>" />
                        </div>
                        <h3 class="vid-name"><a href="post.php?post_id=<?php echo $p_id;?>"><?php echo $p_title;?></a></h3>
                        <div class="info">
                            <h5>By <a href="#"> <?php echo ucfirst($p_author);?></a></h5>
                            <span><i class="fa fa-calendar"></i><?php echo $p_day;?>/<?php echo $p_month;?>/<?php echo $p_year;?></span>
                            <!--<span><i class="fa fa-heart"></i>1,200</span>-->
                        </div>
                            <p><?php echo substr($p_post_data,0,425)." ....";?></p>
                    <?php

                     }
                    }
                    else{
                        echo "<h3>No Post Available</h3>";
                    }
                    ?>
                    </div>
                    <div class="box">
                        <div class="box-header header-natural">
                            <h2>Popular News</h2>
                        </div>
						<div class="box-content">
							<div class="row">
                                <?php
                                $q_query = "SELECT * FROM yerassyl WHERE status = 'publish' ORDER BY views DESC LIMIT 2";
                                $q_run = mysqli_query($con,$q_query);
                                if(mysqli_num_rows($q_run) > 0){
                                    while($q_row = mysqli_fetch_array($q_run)){
                                        $q_comment = $q_row['q'];
                                        $q_id = $q_row['id'];
                                        $q_date = getdate($q_row['date']);
                                        $q_day = $q_date['mday'];
                                        $q_month = $q_date['month'];
                                        $q_year = $q_date['year'];
                                        $q_title = $q_row['title'];
                                        $q_image = $q_row['image'];
                                        $q_views = $q_row['views'];
                                        ?>
								<div class="col-md-6">
									<img src="img/<?php echo $q_image;?>"/>
									<h3><a href="post.php?post_id=<?php echo $q_id;?>"><?php echo $q_title;?></a></h3>
                                    <span><i class="fa fa-calendar"></i> <?php echo $q_day;?>/<?php echo $q_month;?>/<?php echo $q_year;?> </span>

                                    <span> <i class="fa fa-eye"></i> <?php echo $q_views;?> </span>

                                    <span><i class="fa fa-commenting-o"></i> <?php echo $q_comment;?></span>

                                    <!--                                <sp
                                    <span class="rating">

										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
									</span>-->

								</div>
                                        <?php
                                    }
                                }
                                else{
                                    echo "<h3>No Post Available</h3>";
                                }
                                ?>

                            </div>
					</div>
                    </div>
                </div>
            </div>
            <div id="sidebar">

                <div class="col-md-4">
                    <!---- Start Widget ---->
                    <div class="widget wid-tags">
                        <div class="heading"><h4>Search</h4></div>
                        <div class="content">
                            <form role="form" class="form-horizontal" method="post" action="result.php">
                                <input type="text" placeholder="title" value="" name="v_search" id="v_search" class="form-control">
                                <input type="submit" value="Go" class="btn btn-default" name="search">
                            </form>
                    </div>
                    </form>
                    <div class="widget wid-calendar">
                        <div class="heading"><h4>Календарь</h4></div>
                        <div class="content">
                            <center><form action="" role="form">
                                    <div class="">
                                        <div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">                </div>
                                        <input type="hidden" id="dtp_input2" value="" /><br/>
                                    </div>
                                </form></center>
                        </div>
                        <!-- VK Widget -->
                       <!-- <div id="vk_groups"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 0, width: "280", height: "400"}, 63546578);
                        </script>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'inc/footer.php'?>