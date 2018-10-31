<?php 
    session_start();
    $catagory = $_GET["cat"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "faysal";

    $conn = new  mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT * FROM `product` WHERE `catagory` = '$catagory'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
       $row = $result->fetch_all();
    }

    $conn->close();

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Discount News</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>

        <?php 
            include 'navbar.php';
         ?>

         <div id="product_area" class="section_padding"> 
             <div class="container"> 
              <div clas="row" > 

                <?php 
                    if (isset($row)) {
                        foreach ($row as $result) {
                ?>

                <div class="col-md-3">
                    <a href="details.php?pdid=<?php echo urlencode($result[0]); ?>&n=<?php echo urlencode($result[1]); ?>">
                    <div class="product">
                        <img class="img-responsive" src="img/<?php echo $result[10]; ?>" alt="">
                        <div class="product_text clearfix">
                            <div class="product_p pull-left">
                                <p><?php echo $result[1]; ?></p>
                            </div> 
                            <div class="product_p pull-right">
                                <p><?php echo $result[8]; ?>%</p>
                            </div> 
                        </div> 
                    </div>
                    </a>
                </div>

                <?php

                        }
                    }
                    else{
                        ?>
                        <h5 style="text-align:center">Nothing to Display.</h5>
                        <?php
                    }
                 ?>

        </div>
    </div>
</div>




 <div id="footer_area" class="section_padding">
            <div class="container">
                <div class="row">
                    <div class="footer">
                        <div class="col-md-4">
                            <div class="about_us">
                                <div class="footer_logo">
                                    <!-- <img src="img/logo.png" alt="footer_logo"> -->
                                    <h4>Discount News </h4>
                                </div>
                                <div class="about_us_txt">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam tempore quidem omnis nemo temporibus libero deserunt distinctio, error reprehenderit vel.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="social_links">
                                <h4>Social Links</h4>
                                <div class="fb pull-left">
                                    <a href="https://www.facebook.com/faysal.kabir.581" target="_blink"><i class="fa fa-facebook"></i></a>
                                </div> 
                                <div class="tw pull-left">
                                    <a href="https://twitter.com/Kamruzzaman1087" target="_blink"><i class="fa fa-twitter"></i></a>
                                </div> 
                                <div class="ln pull-left">
                                    <a href="http://linkedin.com"><i class="fa fa-linkedin"></i></a>
                                </div> 
                                <div class="dbb pull-left">
                                    <a href="http://dribbble.com"><i class="fa fa-dribbble"></i></a>
                                </div>   
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="address">
                                <h4>Our Address</h4>
                                <p>43/2,shukrabad</p>
                                <p>Dhaka,1207</p>
                                <p><span>Hotline : </span>+8801773-770080</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


     <!-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
        
</body>