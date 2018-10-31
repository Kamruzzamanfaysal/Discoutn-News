<?php 
    session_start();

    $id = $_GET["pdid"];
    $pname = $_GET["n"];

if (!empty($id) && !empty($pname)) {

  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "faysal";

  $conn = new  mysqli($servername, $username, $password, $db);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 

  $sql = "SELECT * FROM `product` WHERE `productId` = '$id' AND `title` = '$pname'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
     $row = $result->fetch_all();
  } else {
      $error = "Nothing to Display.";
  }

  $conn->close();
}

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Discount News</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

        <style type="text/css">
          p span{
            text-decoration-line: line-through;
                text-decoration-style: double;
          }
        </style>
        
    </head>
    <body>
      
      <?php 
          include 'navbar.php';
       ?>

    <!-- product description area -->


    <section id="pro_dsc_area" class="section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-md-offset-3">
                    <?php if(isset($row)){ foreach ($row as $key => $value) { ?>

                        <div class="product">
                            <img src="img/<?php echo $value[10]; ?>" alt="">
                            <div class="pro_dsc">
                                <h3><?php echo $value[1]; ?></h3>
                                <p><?php echo $value[2]; ?></p>
                            </div>
                            <div class="price">
                                <p>Price : <span><?php echo $value[6] ?>tk</span>&nbsp;&nbsp;<?php echo $value[7]; ?>tk</p>
                                <p>Discount : <?php echo $value[8] ?>%</p>
                            </div>
                            <div class="st_date">
                                <p class="s_date">Start : <?php echo $value[3]; ?></p>
                                <p class="e_date">End : <?php echo $value[4]; ?></p>
                            </div>
                        </div>
                        <?php } 
                      } 
                      else{
                        echo "<h1>".$error."</h1>";
                      }
                      ?>
                    </div>
                </div>
            </div>
    </section>


    <!-- product description -->

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
    </html>