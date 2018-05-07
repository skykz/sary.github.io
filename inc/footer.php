
</body>
<footer>
        <div class="wrap-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-footer footer-1">
                        <?php

                        session_start();
                        //require_once 'inc/db.php';
                        if (!empty($_POST["submit"])) {
                            $_SESSION["email"] = $_POST["email"];
                            header("Location: " . $_SERVER["REQUEST_URI"]);
                            exit;
                        }
                        if (isset($_SESSION['email']))
                        {
                            $date = time();
                            $email = mysqli_real_escape_string($con, strtolower($_SESSION['email']));
                            $insert_query = "INSERT INTO `email_send` (`id`,`email`,`date`) VALUES (NULL,'$email','$date')";

                            if (mysqli_query($con, $insert_query)) {
                                $msg = "Successfully Sent!";
                            }
                            else{
                                $error = "<h2 style='color: red'>Error during the Sending E-mail !!!</h2>";

                            }
                        }
                        ?>
                        <div class="footer-heading"><h1><span style="color: #fff;">NewsPaper</span></h1></div>
                        <div class="content">
                            <p>Subscribing on the News everyday here : </p>
                            <strong>Email address:</strong>

                            <form action="" method="post">
                                <input type="text" name="email" size="50" placeholder="Your Email..." />
                                <input type="submit" value="Subscribe" name="submit" class="btn btn-3" />
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-footer footer-2">
                        <div class="footer-heading">
                            <h4>Categories</h4>
                        </div>
                        <?php
                        $c_query = "SELECT * FROM categories";
                        $c_run = mysqli_query($con,$c_query);
                        if(mysqli_num_rows($c_run) > 0){
                            $count = 1;
                            while($c_row = mysqli_fetch_array($c_run)){
                                $c_id = $c_row['id'];
                                $c_category = $c_row['category'];
                                $count = $count + 1;

                                if(!empty($c_id)){

                                    ?>
                                    <div class="content">
                                        <a href="news.php?cat=<?php echo $c_id;?>"><?php echo ucfirst($c_category)?></a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                            echo "<p>No Category</p>";
                        }
                        ?>
                    </div>
                    <div class="col-md-4 col-footer footer-3">
                        <div class="footer-heading"><h4>Contacts</h4></div>
                        <div class="content">
                            <ul>
                                <li><a href="#">Telephone number: 8(778)-446-78-34</a></li>
                                <!--<li><a href="#"></a></li>-->
                                <li><a href="https://vk.com/skyyera">E-mail: erasylgeso@gmail.com</a></li>
                                <li><a href="#">Address: Street Manasa - Zhandosova Street., 34 "A"/8</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            Copyright &copy; Creted by <a href="https://vk.com/skyyera">Yerassyl</a>. All Right Reserved from 2017 - <?php echo date('Y');?>.
        </div>
    <br>
    <br>

    </footer>
    <script src="owl-carousel/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo-1").owlCarousel({
                autoPlay: 3000,
                items : 1,
                itemsDesktop : [1199,1],
                itemsDesktopSmall : [400,1]
            });
            $("#owl-demo-2").owlCarousel({
                autoPlay: 3000,
                items : 3,

            });
        });
    </script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $('.form_date').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $('.form_time').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0
        });
    </script>
    </body>
    </html>
