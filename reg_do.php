<?php

if (isset($_POST['submit']))
{

    if (!empty($_POST['full_name']) && !empty($_POST['email']) &&
        !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password1'])){

        if ($_POST['password'] != $_POST['password1'])
        {
            $error_password = 'passwords are not matched';
        }

        $full_name = trim(htmlspecialchars($_POST['full_name']));
        $full_name = trim(htmlspecialchars($_POST['email']));
        $full_name = trim(htmlspecialchars($_POST['username']));
        $full_name = $_POST['full_name'];



    }

}