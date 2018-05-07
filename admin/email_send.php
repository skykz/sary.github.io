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
    $del_check_query = "SELECT * FROM email_send WHERE id = $del_id";
    $del_check_run = mysqli_query($con, $del_check_query);
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `email_send` WHERE `email_send`.`id` = $del_id";
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
            $bulk_del_query = "DELETE FROM `email_send` WHERE `email_send`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
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
                <h1><i class="fa fa-inbox"></i> Subscribes <small>View All Subscribes</small></h1><hr>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                    <li class="active"><i class="fa fa-inbox"></i> Subscribes</li>
                </ol>
                <?php
                $query = "SELECT * FROM email_send ORDER BY id DESC";
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
                            <th>Email</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($run)){
                            $id = $row['id'];
                            $email = $row['email'];
                            $date = getdate($row['date']);
                            $day = $date['mday'];
                            $month = substr($date['month'],0,3);
                            $year = $date['year'];
                            $status = $row['status'];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id;?>"></td>
                                <td><?php echo $id;?></td>
                                <td><?php echo "$day $month $year";?></td>
                                <td><?php echo "$email";?></td>
                                <td><a class="btn btn-info"><?php echo "$status";?></td>

                                <td><a href="email_send.php?del=<?php echo $id;?>"><i class="btn btn-warning fa fa-trash"></i></a></td>
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