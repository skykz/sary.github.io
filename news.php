
<?php require_once('inc/top.php');?>
<body>
<?php require_once('inc/header.php');

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


if(isset($_POST['search'])){
    $search = $_POST['search-title'];
    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    $all_posts_query .= " and tags LIKE '%$search%'";

    $all_posts_run = mysqli_query($con, $all_posts_query);
    $all_posts = mysqli_num_rows($all_posts_run);
    $total_pages = ceil($all_posts / $number_of_posts);
    $posts_start_from = ($page_id - 1) * $number_of_posts;
}
else{
    $all_posts_query = "SELECT * FROM posts WHERE status = 'publish'";
    if(isset($cat_name)){
        $all_posts_query .= " and categories = '$cat_name'";
    }
    $all_posts_run = mysqli_query($con, $all_posts_query);
    $all_posts = mysqli_num_rows($all_posts_run);
    $total_pages = ceil($all_posts / $number_of_posts);
    $posts_start_from = ($page_id - 1) * $number_of_posts;
}?>

<div id="page-content" class="archive-page container">
    <div class="">
        <div class="row">
            <div id="main-content" class="col-md-8">
                <?php

                if(isset($_POST['search'])){

                }
                else
                    {
                $query = "SELECT * FROM yerassyl WHERE status = 'publish'";

                //$comment = "SELECT COUNT(*) FROM comments AS c, posts as p WHERE p.id = c.post_id AND p.id = "{.0.}" GROUP BY p.id";

                if(isset($cat_name)){
                $query .= " and categories = '$cat_name'";
                }
                $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
                }

                $run = mysqli_query($con,$query);

                if(mysqli_num_rows($run) > 0){
                while($row = mysqli_fetch_array($run)){

                    $id = $row['id'];
                    $com = $row['q'];
                    $date = getdate($row['date']);

                $day = $date['mday'];
                $month = $date['month'];
                $year = $date['year'];
                $title = $row['title'];
                $author = $row['author'];
                $author_image = $row['author_image'];
                $categories = $row['categories'];
                $tags = $row['tags'];
                $post_data = $row['post_data'];
                $views = $row['views'];
                $status = $row['status'];
                $image = $row['image'];
                ?>
                <div class="box">
                    <a href="#"><h4 class="vid-name"><?php echo $title;?></h4></a>
                    <div class="info">
                        <h5>By <a href="#"><?php echo ucfirst($author);?></a></h5>
                        <span><i class="fa fa-calendar"></i> <?php echo $day; ?> / <?php echo $month; ?> / <?php echo $year; ?></span>
                        <span><i class="fa fa-eye"></i><?php echo $views;?></span>

                                <span><i class="fa fa-comment"></i><?php echo $com; ?></span>

                    </div>
                    <div class="wrap-vid">
                        <div class="zoom-container">
                            <div class="zoom-caption">
                            </div>
                            <img src="img/<?php echo $image;?>"/>
                        </div>
                        <p> <?php echo substr($post_data,0,250)." ....";?></p>

                        <a href="post.php?post_id=<?php echo $id;?>" class="btn btn-primary"> Read More... </a>


                    </div>
                </div>
                <hr class="line">
                    <?php
                }
                }
                else{
                    echo "<center><h2>No Posts Available</h2></center>";
                }
                ?>

                <div class="box">
                    <center>
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($i = 1; $i <= $total_pages; $i++){
                                echo "<li class='".($page_id == $i ? 'active': ' ')."'>
                                <a href='news.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":" ")."'>$i</a></li>";
                            }
                            ?>

                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </center>
                </div>
            </div>

            <div id="sidebar" class="col-md-4">
                <div class="widget wid-tags">
                    <div class="heading"><h4>Search</h4></div>
                    <div class="content">
                        <form role="form" class="form-horizontal" method="post" action="">
                            <input type="text" placeholder="Enter title to find post" value="" name="v_search" id="v_search" class="form-control">
                        </form>
                    </div>
                </div>

                <div class="widget wid-follow">
                    <div class="heading"><h4>Subscribe to Us</h4></div>
                    <div class="content">
                        <ul class="list-inline">

                            <div id="vk_groups"></div>
                            <script type="text/javascript">
                                VK.Widgets.Group("vk_groups", {mode: 0, width: "320", height: "320"}, 63546578);
                            </script>
                        </ul>
                    </div>
                </div>
                <!-- Start Widget-->
            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php';?>