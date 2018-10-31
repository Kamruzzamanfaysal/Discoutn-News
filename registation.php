<?php 
  session_start();

  $nameError = $mailError = $passError = $error = $checkError = $agree = "";


  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['agree'])) {
      $agree = $_POST['agree'];
    }

    if ($agree == 'yes') {
    
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


    $mail = test_input($_POST['email']);
    if(!empty($mail)){
      if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mail'] = 1;
      }
      else{
        $mailError = "Email address is invalid.";
      }
    }
    else{
      $mailError = "Email is empty.";
    }


    $pass = $_POST['password'];
    $repass = $_POST['repassword'];
    if(!empty($pass) && !empty($repass)){
      if ($pass == $repass) {

        if (strlen($pass)>6) {
            $_SESSION['pass'] = 1;
        } else {
          $passError = "Password must be grater than 6 character.";
        }
        
      }
      else{
        $passError = "Password did not match.";
      }
    }
    else{
      $passError = "Password is empty.";
    }
  

   

    if (isset($_SESSION['name']) == 1 && isset($_SESSION['mail']) == 1 && isset($_SESSION['pass']) == 1) {
      unset($_SESSION['name']);
      unset($_SESSION['mail']);
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

      $sql = "INSERT INTO `user_tbl`(`id`, `password`, `email`, `username`) 
      VALUES (Null,'$pass','$mail','$name')";
      
      if ($conn->query($sql) == TRUE) {
         $_SESSION['username'] = $name;
         $uri .="/DiscountNews";
         header('Location: '.$uri.'/index.php'); 
      } else {
          $error = "Registrarion failed.";
      }

      $conn->close();

    }    
  }
  else{
    $checkError = "Please clcik checkbox to conform.";
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
<head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/regi.css">
    <style type="text/css">

      #error{
        color: red;
      }

    </style>
</head>
<body>
    <div class="header">
      <h2> Registrarion From </h2>
       <p><a href="index.php">Home </a> </p>
    </div>
       <form method="POST" action=""> 
        <span id="error"><?php echo $error; ?> </span> 
           <div class="input-group"> 
                <span id="error"><?php echo $nameError; ?> </span> 
               <label>User Name</label>
               <input type="text" name="username" placeholder="username.......">
           </div>
           <div class="input-group">
            <span id="error"><?php echo $mailError; ?> </span> 
               <label>Email</label>
               <input type="Email" name="email" placeholder="Email....">
           </div>

           <div class="input-group">
            <span id="error"><?php echo $passError; ?> </span> 
               <label>Password</label>
               <input type="password" name="password" placeholder="password...">
           </div>

           <div class="input-group">
               <label>Re-type Password</label>
               <input type="password" name="repassword" placeholder="Re-type Password....">
           </div>

           <div class="checkbox-inline">
            <span id="error"><?php echo $checkError; ?> </span><br>
             <label><input type="checkbox" name="agree" value="yes">Yes</label>
           </div>
           <div class="input-group">
           <button type="submit" name="Registrar" class="btn">Registrar</button>
            </div>
           <p>
              Already a register? <a href="login.php">Sign in</a>
           </p>
       </form>
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/main.js"></script>
    
</body>
</html>
