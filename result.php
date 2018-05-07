<?php
/**
 * Created by PhpStorm.
 * User: Yerassyl
 * Date: 06.05.2018
 * Time: 0:56
 */

require_once 'inc/db.php';
$number_of_posts = 3;

if(isset($_GET['page'])){
    $page_id = $_GET['page'];
}
else{
    $page_id = 1;
}

if (isset($_POST['v_search'])) {

    $search = $_POST['v_search'];

   // $search = preg_match("#[^0-9a-z]#i", "", $search);

    $query = "SELECT * FROM posts WHERE status = 'publish'";
    $query .= " and title LIKE '%$search%'";
    //$query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";

    $all_posts_run = mysqli_query($con, $query);
    $all_posts = mysqli_num_rows($all_posts_run);

    //$total_pages = ceil($all_posts / $number_of_posts);
    //$posts_start_from = ($page_id - 1) * $number_of_posts;

    if ($all_posts == 0) {
        $out = "There are no results";
    } else {
        while ($row = mysqli_fetch_array($all_posts_run)) {

            $res = $row['title'];

            var_dump($res);
            echo "<h2>" . $res . "</h2>";
        }
    }


}