<?php require_once 'inc/top.php';?>
<?php
header('Content-Type: text/html; charset=utf8');
        require_once 'inc/header.php';

        if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];

        // update view's counter

        $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id";
        mysqli_query($con, $views_query);

        $query = "SELECT * FROM posts WHERE status = 'publish' and id = $post_id";

        $run = mysqli_query($con, $query);
        if (mysqli_num_rows($run) > 0){
            $row = mysqli_fetch_array($run);


        $id = $row['id'];
        //$comment = $row['q'];
        $date = getdate($row['date']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];
        $title = $row['title'];
        $image = $row['image'];
        $views = $row['views'];
        $tag  = $row['tags'];
        $author_image = $row['author_image'];
        $author = $row['author'];
        $categories = $row['categories'];
        $post_data = $row['post_data'];

?>
<div id="page-content" class="single-page container">
    <div class="row">
        <div id="main-content" class="col-md-8">
            <div class="box">
                <div class="wrap-vid">
                    <!--                    <iframe width="100%" height="400" src="https://www.youtube.com/Xm2KPBH3Djs" frameborder="0" allowfullscreen></iframe>-->
                    <a href="#"><img src="img/<?php echo $image; ?>" alt="Post Image"></a>
                </div>
                <br>
                <div class="share">
                    <ul class="list-inline center">
                        <!--<li><a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Share </a></li>-->
                        <script type="text/javascript">
                            document.write(VK.Share.button({
                                url: 'http://localhost:8080',
                                title: '<?php echo $title;?>',
                                text: 'Share',
                                image: 'http://localhost:8080/img/<?php echo $image;?>',
                                noparse: false,
                            },
                                {type: 'custom', text: '<li><i class="btn btn-facebook fa fa-vk"> Поделиться</i></li>'}
                            ));
                        </script>
                        <div class="fb-share-button" data-href="https://localhost:8080"
                             data-layout="button_count" data-size="large"
                             data-mobile-iframe="true">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Flocalhost%3A8080%2F&amp;src=sdkpreparse"
                               class="fb-xfbml-parse-ignore">Поделиться</a></div>
                    </ul>

                </div>
                <div class="line"></div>
                <h1 class="vid-name"><a href="post.php?post_id=<?php echo $id; ?>"><?php echo $title; ?></a></h1>
                <div class="info">
                    <h5> Written by <a href="#"><?php echo ucfirst($author); ?></a></h5>
                    <span><i class="fa fa-calendar"></i><?php echo $day; ?> / <?php echo $month; ?> / <?php echo $year; ?></span>
                    <span><i class="fa fa-eye"></i><?php echo $views;?></span>



                </div>
                <p style="margin-top: 20px"><?php echo $post_data; ?></p>

                <h5>Tags</h5>
                <p style="margin-top: 20px"></p>
                <div class="vid-tags">
                    <a href="#"><?php echo $tag?></a>
                </div>
            <?php
        }
        else {
            header('Location: index.php');
        }
        }
?>

                <?php
                $c_query = "SELECT * FROM comments WHERE status = 'approve' and post_id = $post_id ORDER BY id DESC";
                $c_run = mysqli_query($con,$c_query);
                if(mysqli_num_rows($c_run) > 0){
                ?>
                <div class="comment">
                    <h5>Comments</h5>
                    <?php
                    while($c_row = mysqli_fetch_array($c_run)){
                        $c_id = $c_row['id'];
                        $c_name = $c_row['name'];
                        $c_username = $c_row['username'];
                        $c_image = $c_row['image'];
                        $c_comment = $c_row['comment'];
                        ?>
                        <hr>
                        <div class="row single-comment">
                            <div class="col-sm-2">
                                <img src="img/<?php echo $c_image;?>" alt="Profile Picture" class="img-circle">
                            </div>
                            <div class="col-sm-10">
                                <p><b><?php echo ucfirst($c_name);?></b></p>
                                <p><?php echo $c_comment;?></p>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <?php } ?>

                <?php
                    if(isset($_POST['submit'])){
                        $cs_name = $_POST['name'];
                        $cs_email = $_POST['email'];
                        $cs_website = $_POST['website'];
                        $cs_comment = $_POST['comment'];
                        $cs_date = time();
                        if(empty($cs_name) or empty($cs_email) or empty($cs_comment)){
                          $error_msg = "All (*) feilds are Required";
                        }
                        else{
                            $cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'unknown-picture.png', '$cs_comment', 'pending')";
                            if(mysqli_query($con, $cs_query)){
                                $msg = "Comment Submited and waiting for Approval";
                                $cs_name = "";
                                $cs_email = "";
                                $cs_website = "";
                                $cs_comment = "";
                            }
                            else{
                                $error_msg = "Comment has not be sumited";
                            }
                        }
                    }
                    ?>
                <div class="line"></div>
                <div class="comment">
                    <h5>Leave a comment</h5>
                    <form name="form1" method="post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="name" value="<?php if(isset($cs_name)){echo $cs_name;}?>" id="name" placeholder="Name" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control input-lg" name="email"  value="<?php if(isset($cs_email)){echo $cs_email;}?>" id="email" placeholder="Email" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="website" value="<?php if(isset($cs_website)){echo $cs_website;}?>" id="name" placeholder="Your Website" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
										<textarea name="comment" id="message" class="form-control" rows="4" cols="25" required="required"
                                                  placeholder="Your comment..."><?php if(isset($cs_comment)){echo $cs_comment;}?></textarea>
                                </div>
                                <button type="submit" class="btn btn-4 btn-block" name="submit" id="btnBooking">
                                    Post Comment         </button>
                            </div>
                        </div>
                        <?php
                        if(isset($error_msg)){
                            echo "<span style='color:red;' class='pull-right'>$error_msg</span>";
                        }
                        else if(isset($msg)){
                            echo "<span style='color:green;' class='pull-right'>$msg</span>";
                        }
                        ?>
                    </form>
                </div>
            </div>

            <div class="box">
                <div class="box-header header-natural">
                    <h2>Related Posts</h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <?php
                            $r_query = "SELECT * FROM yerassyl WHERE status = 'publish' AND title LIKE '%$title%' LIMIT 3";
                            $r_run = mysqli_query($con,$r_query);
                            while($r_row = mysqli_fetch_array($r_run)){

                            $r_comment = $r_row['q'];
                            $r_id = $r_row['id'];
                            $r_title = $r_row['title'];
                            $r_image = $r_row['image'];

                        $r_date = getdate($r_row['date']);
                        $r_day = $r_date['mday'];
                        $r_month = $r_date['month'];
                        $r_year = $r_date['year'];
                        $r_author = $r_row['author'];
                        $r_post_data = $r_row['post_data'];
                        $r_views = $r_row['views'];
                        ?>
                        <div class="col-md-4">
                            <div class="wrap-vid">
                                <div class="zoom-container">
                                    <div class="zoom-caption">
                                        <span>News</span>

                                        <p><?php echo $r_title;?></p>
                                    </div>
                                    <img src="img/<?php echo $r_image;?>">
                                </div>

                                <h3 class="vid-name"><a href="news.php?post_id=<?php echo $r_id;?>"><?php echo $r_title;?></a></h3>
                                <div class="info">
                                    <h5>By <a href="#"><?php echo ucfirst($r_author);?></a></h5>
                                    <span><i class="fa fa-calendar"></i> <?php echo $r_day;?>/<?php echo $r_month;?>/<?php echo $r_year;?></span>
                                    <span><i class="fa fa-eye"></i><?php echo $r_views;?></span>
                                    <span><i class="fa fa-comments"></i><?php echo $r_comment;?></span>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar" class="col-md-4">
            <!---- Start Widget ---->
            <div class="widget wid-follow">
                <div class="heading"><h4>Подпишитесь на Нас</h4></div>
                <div class="content">
                    <ul class="list-inline">

                        <div id="vk_groups"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 0, width: "320", height: "320"}, 63546578);
                        </script>
                    </ul>
                </div>
            </div>
            <!---- Start Widget ---->
            <div class="widget ">
                <div class="heading"><h4>Popular Posts</h4></div>
                <div class="content">
                    <?php
                    $p_query = "SELECT * FROM yerassyl WHERE status = 'publish' ORDER BY views DESC LIMIT 5";
                    $p_run = mysqli_query($con,$p_query);

                    if(mysqli_num_rows($p_run) > 0){
                        while($p_row = mysqli_fetch_array($p_run)){
                            $p_id = $p_row['id'];
                            $p_comment = $p_row['q'];
                            $p_date = getdate($p_row['date']);
                            $p_day = $p_date['mday'];
                            $p_month = $p_date['month'];
                            $p_year = $p_date['year'];
                            $p_title = $p_row['title'];
                            $p_author = $p_row['author'];
                            $p_views = $p_row['views'];
                            $p_image = $p_row['image'];
                            ?>
                    <div class="wrap-vid">
                        <div class="zoom-container">
                            <div class="zoom-caption">
                                <p><?php echo $p_title;?></p>
                            </div>
                            <img src="img/<?php echo $p_image;?>" alt="Image 1">
                        </div>
                        <h3 class="vid-name"><a href="post.php?post_id=<?php echo $p_id;?>"><?php echo $p_title;?></a></h3>
                        <div class="info">
                            <h5>By <a href="#"><?php echo ucfirst($p_author);?></a></h5>
                            <span><i class="fa fa-calendar"></i><?php echo $p_day;?> / <?php echo $p_month;?> / <?php echo $p_year;?></span>
                            <span><i class="fa fa-eye"></i><?php echo $p_views;?></span>
                            <span><i class="fa fa-comment-o"></i><?php echo $p_comment;?></span>

                        </div>
                    </div>
                            <hr style="color:darkslateblue;">
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
  <?php require_once 'inc/footer.php' ?>