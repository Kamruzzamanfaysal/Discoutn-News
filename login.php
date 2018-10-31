<?php 
  session_start();

  $error = "";


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $name = test_input($_POST['username']);
    if(!empty($name)){
      if (preg_match('/^[a-zA-Z]+$/', $name)) {
        $_SESSION['name'] = 1;
      }
      else{
        $nameError = "Username can contain only letters.";
      }
    }
    else{
      $nameError = "Username is empty.";
    }


    // $mail = test_input($_POST['email']);
    // if(!empty($mail)){
    //   if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    //     $_SESSION['mail'] = 1;
    //   }
    //   else{
    //     $mailError = "Email address is invalid.";
    //   }
    // }
    // else{
    //   $mailError = "Email is empty.";
    // }


    $pass = $_POST['password'];
    if(!empty($pass)){

        $_SESSION['pass'] = 1;
        
      }
      else{
        $passError = "Password is empty.";
      }   

    

    if (isset($_SESSION['name']) == 1 && isset($_SESSION['pass']) == 1) {
      unset($_SESSION['name']);
      unset($_SESSION['pass']);

      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "faysal";

      $conn = new  mysqli($servername, $username, $password, $db);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      $pass = md5($pass);

      $sql = "SELECT `password`,`username` FROM `user_tbl` WHERE `password` ='$pass' AND `username` = '$name'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
         $_SESSION['username'] = $name;
         $uri .="/DiscountNews";
         header('Location: '.$uri.'/index.php'); 
      } else {
          $error = "Username or Password is incorrect.";
      }

      $conn->close();

    }   

  }

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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/regi.css">
</head>
<body>
    <div class="header">
      <h2>Login</h2>
      <p><a href="index.php">Home </a> </p>
    </div>
       <form method="post" action="login.php"> 
        <span id="error"><?php echo $error; ?> </span> 
           <div class="input-group">  
               <label>Your User Name</label>
               <input type="text" name="username" placeholder="user-name..." >
           </div>
           <div class="input-group">
               <label>Your Password</label>
               <input type="password" name="password" placeholder="password...">
           </div class="input-group">
           <button type="submit" name="login" class="btn">Login</button>
           <p>
              Not yet a register? <a href="registation.php">Sign up</a>
           </p>
       </form>
   </div>
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/main.js"></script>
    
</body>
</html>
