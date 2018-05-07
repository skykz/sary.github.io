<?php
require_once 'inc/db.php';

if(isset($_POST['send'])) {

    $date = time();
    $full_name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, strtolower($_POST['email']));
    $phone = mysqli_real_escape_string($con,$_POST['number']);
    $content = mysqli_real_escape_string($con, $_POST['message']);

    $insert_query = "INSERT INTO `feed` (`id`, `name`, `email`, `phone_number`, `content`, `date`) VALUES (NULL, '$full_name','$email','$phone','$content','$date')";

    if (mysqli_query($con, $insert_query)) {
        $msg = "Successfully Sent!";

    header('Location:contact-us.php');
    }
    else{
        $error = "<h2 style='color: red'>Error during the Sending feedback !!!</h2>";
    }

}
?>