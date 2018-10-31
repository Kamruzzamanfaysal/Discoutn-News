<?php 
    session_start();

    if ($_SERVER["REQUEST_METHOD"]  == "POST") {


    $title = test_input( $_POST['title']);
    $des = test_input( $_POST['dsc']);
    $s_date = dateValidate(test_input( $_POST['s_date']));
    $e_date = dateValidate(test_input( $_POST['e_date']));
    $price = validatePriceandOffer(test_input( $_POST['price']));
    $offer = validatePriceandOffer(test_input( $_POST['offer']));
    $catagory = test_input( $_POST['catagory']);
    $pro_img = $_FILES['pro_img'];


    if (!empty($title) && !empty($des) && !empty($s_date) && !empty($e_date) && !empty($price) && !empty($offer) && !empty($catagory) && !empty($pro_img)) {
        

        if ($s_date < $e_date) {

            $image_name = $pro_img['name'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "faysal";

            $conn = new  mysqli($servername, $username, $password, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $tm = ($price * $offer)/100;
            $less_price = $price - $tm;

            $sql = "INSERT INTO `product`(`productId`, `title`, `dsc`, `s_date`, `e_date`, `upload_date`, `price`, `less_price`, `discount`, `catagory`, `pro_img`) 
            VALUES (Null,'$title','$des','$s_date','$e_date',CURRENT_TIMESTAMP,'$price','$less_price','$offer','$catagory','$image_name')";

            if ($conn->query($sql) == TRUE) {

                $target_dir = "img/";
                $target_file = $target_dir . basename($_FILES["pro_img"]["name"]);

                move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file);

                $success = " Product added succesfully. ";

            } else {
                $error = "Sorry, product can not add. Error occur.";
            }

            $conn->close();
        }

    }

    }

    function validatePriceandOffer($value)
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
                'max_range' => 9999999999999,
            )
        );
        if (filter_var($value, FILTER_VALIDATE_INT, $options) !== FALSE) {
            return $value;
        }
    }

    function dateValidate($value)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value)) {

            $today = date("Y-m-d");

            if ($value > $today) {
                return $value;
            }
            else{
                $value ="";
                return $value;
            }

        } else {
            $value ="";
            return $value;
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

 ?>


<?php 

    if (!isset($_SESSION['username'])) {
        $_SESSION['username'] = $name;
        $uri .="/DiscountNews";
        header('Location: '.$uri.'/login.php');
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
        
    </head>
    <body>
 
    <?php 
        include 'navbar.php';
     ?>
	
	<!-- upload area -->

	<section id="upload_area" class="section_padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                    <?php 
                        if (isset($success)) {
                            ?>
                            <div class="alert alert-success">
                                <?php echo "<p>".$success."</p>"; ?>
                            </div>
                            <?php
                        }
                        if (isset($error)) {
                            ?>
                            <div class="alert alert-danger">
                                echo "<p>".$error."</p>";
                            </div>
                            <?php
                        }
                     ?>
				<div class="upload">

					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" role="form" id="upload_form" enctype="multipart/form-data">
                       
						<div class="col-md-4 pull-left">
							  <div class="form-group">
							    <label for="title">Title:</label>
							    <input type="text" name="title" class="form-control" id="title">
							  </div>
							  <div class="form-group">
							    <label for="discription">Discription:</label>
							    <textarea name="dsc" class="form-control" rows="5" id="discription"></textarea>
							  </div>
							  <div class="form-group">
							    <label for="s_date">Starting date:</label>
							    <input type="date" name="s_date" class="form-control" id="datepicker">
							  </div>
							  <div class="form-group">
							    <label for="e_date">Ending date:</label>
							    <input type="date" name="e_date" class="form-control" id="e_datepicker">
							  </div>
							<button type="submit" class="btn btn-info">Submit</button>
						</div>

						<div class="col-md-4 pull-left">
							  <div class="form-group">
							    <label for="title">Regular price:</label>
							    <input type="text" name="price" class="form-control" id="title">
							  </div>
							  <div class="form-group">
							    <label for="discription">Discount:</label>
								<label class="radio-inline"><input type="radio" name="offer" value="25" required>25%</label>
								<label class="radio-inline"><input type="radio" name="offer" value="35">35%</label>
								<label class="radio-inline"><input type="radio" name="offer" value="50">50%</label>
								<label class="radio-inline"><input type="radio" name="offer" value="75">75%</label>
							  </div>
							  <div class="form-group">
							     <label for="sel1">Select Catagory:</label>
							     <select name="catagory" class="form-control" id="add_cat">
							  		<option>Select</option>
									<option value="furniture">Furniture</option>
									<option value="health">Health</option>
									<option value="eduction">Book</option>
									<option value="food">Food & Drink</option>
                                    <option value="electron">Electronics</option>
							     </select>
							  </div> 	
							  <div class="form-group">
							    <label for="offer_img">Promo Image:</label>
							    <input class="input-group" type="file" name="pro_img" class="" id="offer_img" required>
							  </div>
						</div>
						<div class="clearfix"></div>
					 </form>
				</div>					
				</div>
			</div>
		</div>
	</section>

	<!-- upload area -->



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