<?php
	function showNav($page){
		if(isset($_SESSION['login'])&&$_SESSION['login']==TRUE){
			$flag = TRUE;
		}else{
			if($page=='sell'||$page=='manage')
				header("location:signin.php");
		}
		
		$index = ($page=='index')?'class="active"':'';
		$search = ($page=='search')?'class="active"':'';
		$sell = ($page=='sell')?'class="active"':'';
		$feedback = ($page=='feedback')?'class="active"':'';
		$register = ($page=='register')?'class="active"':'';
		$manage = ($page=='manage')?'class="active"':'';
		$signin = ($page=='signin')?'class="active"':'';	
		echo '<li '.$index.'><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
              <li '.$search.'><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>';

		if(isset($flag)&&$flag==TRUE){
			echo '<li '.$sell.'><a href="sell.php"><span class="glyphicon glyphicon-usd"></span> Sell</a></li>
				  <li '.$feedback.'><a href="feedback.php"><span class="glyphicon glyphicon-comment"></span> Feedback</a></li>
				  <li '.$manage.'><a href="manage.php"><span class="glyphicon glyphicon-th-list"></span> Management</a></li>
				  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
		}else{
			echo '<li '.$feedback.'><a href="feedback.php"><span class="glyphicon glyphicon-comment"></span> Feedback</a></li>
				  <li '.$register.'><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
				  <li '.$signin.'><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Sign in</a></li>';
		}
	}
	function showHeader($page){
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2 Hand Shop</title
    ><!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
	html {
  		position: relative;
  		min-height: 100%;
	}
	body {
  		padding-top: 20px;
  		padding-bottom: 20px;
		margin-bottom: 60px;
	}
	.navbar {
  		margin-bottom: 20px;
	}
	#footer {
 		position: absolute;
 		bottom: 0;
 		 width: 100%;
  		height: 60px;
  		background-color: #f5f5f5;
	}
	.container .text-muted {
		margin: 20px 0;
	}
	#footer > .container {
  		padding-right: 15px;
  		padding-left: 15px;
	}
	#map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
    }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">2 Hand Shop</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <?php echo showNav($page);//showNav bar?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
<?php }//End function showHeader?>