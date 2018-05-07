<?php require_once('inc/top.php');?>
<?php
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
    header('Location: index.php');
}

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    $del_check_query = "SELECT * FROM feed WHERE id = $del_id";
    $del_check_run = mysqli_query($con, $del_check_query);
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `feed` WHERE `feed`.`id` = $del_id";
        if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
            if(mysqli_query($con, $del_query)){
                $msg = "User Has been Deleted";
            }
            else{
                $error = "User has not been deleted";
            }
        }
    }
    else{
        header('location: index.php');
    }
}

if(isset($_POST['checkboxes'])){

    foreach($_POST['checkboxes'] as $user_id){

        $bulk_option = $_POST['bulk-options'];

        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `feed` WHERE `feed`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }/*
        else if($bulk_option == 'author'){
            $bulk_author_query = "UPDATE `feed` SET `role` = 'author' WHERE `feed`.`id` = $user_id";
            mysqli_query($con, $bulk_author_query);
        }
        else if($bulk_option == 'admin'){
            $bulk_admin_query = "UPDATE `feed` SET `role` = 'admin' WHERE `feed`.`id` = $user_id";
            mysqli_query($con, $bulk_admin_query);
        }*/
    }
}
?>
    </head>
    <body>
<div id="wrapper">
<?php require_once('inc/header.php');?>

    <div class="container-fluid body-section">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('inc/sidebar.php');?>
            </div>
            <div class="col-md-9">
                <h1><i class="fa fa-feed"></i> Feedbacks <small>View All Feedbacks</small></h1><hr>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-feed"></i> FeedBack</li>
                </ol>
                <?php
                $query = "SELECT * FROM feed ORDER BY id DESC";
                $run = mysqli_query($con, $query);
                if(mysqli_num_rows($run) > 0){
                ?>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <select name="bulk-options" id="" class="form-control">
                                            <option value="delete">Delete</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <input type="submit" class="btn btn-success" value="Apply">
                                    <a href="add-user.php" class="btn btn-primary">Add New</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(isset($error)){
                        echo "<span style='color:red;' class='pull-right'>$error</span>";
                    }
                    else if(isset($msg)){
                        echo "<span style='color:green;' class='pull-right'>$msg</span>";
                    }
                    ?>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="selectallboxes"></th>
                            <th>ID #</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Telephone number</th>
                            <th>Content</th>
                            <!-- Actions  -->
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($run)){
                            $id = $row['id'];
                            $full_name = ucfirst($row['name']);
                            $email = $row['email'];
                            $phone = $row['phone_number'];
                            $content = $row['content'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'],0,3);
                            $year = $date['year'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id;?></td>
                                <td><?php echo "$day $month $year";?></td>
                                <td><?php echo "$full_name";?></td>
                                <td><?php echo "$email";?></td>
                                <td><?php echo $phone;?></td>
                                <td><?php echo $content;?></td>
                                <td><a href="feed.php?del=<?php echo $id;?>"><i class="btn btn-warning fa fa-trash"></i></a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php
                    }
                    else{
                        echo "<center><h2>No Users Availabe Now</h2></center>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

<?php require_once('inc/footer.php');?>