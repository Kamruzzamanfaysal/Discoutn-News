<nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Discount News</a>
    </div>
    <div class="pull-right">
    <form class="navbar-form navbar-left" action="search.php" method = "GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
           <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
     <ul class="nav navbar-nav navbar-right">
      <?php 
        if (isset($_SESSION['username'])) {
          ?>
          <li><a href="upload.php"> Upload</a></li>
          <li><a ><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username']; ?> </a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        <?php
        }
        else{
          ?>
          <li><a href="registation.php"><span class="glyphicon glyphicon-user"></span> Registration </a></li>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php
        }
       ?>
    </ul>
    </div>
    
  </div>
</nav>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cateroy <span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li><a href="view.php?cat=furniture">Furniture</a></li>
            <li><a href="view.php?cat=health">Health</a></li>
            <li><a href="view.php?cat=eduction">Book</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="view.php?cat=food">Food & Drink</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Computer <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="view.php?cat=harddisk">Hard disk</a></li>
            <li><a href="view.php?cat=keyboard">Keyboard</a></li>
            <li><a href="view.php?cat=mouse">Mouse</a></li>
            <li><a href="view.php?cat=ram">RAM</a></li>
          </ul>
        </li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>