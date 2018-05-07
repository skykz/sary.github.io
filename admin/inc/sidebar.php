<?php
$session_role1 = $_SESSION['role'];
//$session_role2 = $_SESSION['role_u'];

$get_comment = "SELECT * FROM comments WHERE status = 'pending'";
$get_feed = "SELECT * FROM feed WHERE status = 'new'";
$get_email = "SELECT * FROM email_send WHERE status = 'new'";

$get_comment_run = mysqli_query($con, $get_comment);
$get_feed_run = mysqli_query($con,$get_feed);
$get_email_run = mysqli_query($con,$get_email);


$num_of_rows = mysqli_num_rows($get_comment_run);
$num_of_feed_rows = mysqli_num_rows($get_feed_run);
$num_of_email_rows = mysqli_num_rows($get_email_run);
?>
                     <div class="list-group">
                      <a href="index.php" class="list-group-item active">
                        <i class="fa fa-tachometer"></i> Dashboard
                      </a>
                      <a href="posts.php" class="list-group-item">
                          <i class="fa fa-file-text"></i> All Posts
                      </a>
                      <a href="media.php" class="list-group-item">
                          <i class="fa fa-database"></i> Media
                      </a>
                      <?php
                        if($session_role1 == 'admin'){
                        ?>
                      <a href="comments.php" class="list-group-item">
                          <?php
                          if($num_of_rows > 0){
                              echo "<span class='badge'>$num_of_rows</span>";
                          }
                          ?>
                          <i class="fa fa-comment"></i> Comments  
                      </a>
                      <a href="categories.php" class="list-group-item">
                          <i class="fa fa-folder-open"></i> Categories
                      </a>
                      <a href="users.php" class="list-group-item">
                          <i class="fa fa-users"></i> Users
                      </a>
                      <a href="feed.php" class="list-group-item">
                          <?php
                          if($num_of_feed_rows > 0){
                              echo "<span class='badge'>$num_of_feed_rows</span>";
                          }
                          ?>
                        <i class="fa fa-feed"></i> Feedback
                      </a>
                            <a href="email_send.php" class="list-group-item">
                                <?php
                                if($num_of_email_rows > 0){
                                    echo "<span class='badge'>$num_of_email_rows</span>";
                                }
                                ?>
                                <i class="fa fa-inbox"></i> Subscribes
                            </a>
                      <?php }?>
                    </div>