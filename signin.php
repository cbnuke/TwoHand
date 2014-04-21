<?php
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('signin');
?>
    
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-info">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>Please sign in</strong></h3>
  		</div>
  		<div class="panel-body">
 			<form role="form">
        		<div class="form-group">
    			<input type="text" class="form-control" placeholder="Username" required autofocus>
        		</div>
       		 	<div class="form-group">
        		<input type="password" class="form-control" placeholder="Password" required>
        		</div>
        		<div class="form-group col-md-offset-2">
        		<button class="btn btn-primary col-md-4" style="margin-left:14px;" type="submit">Sign in</button>
        		<a href="register.php" class="btn btn-warning col-md-4" style="margin-left:14px;">Register</a>
        		</div>
     		 </form>
  		</div>
	</div>
	</div>
    </div>
    
    <div class="alert alert-warning"><strong>Notice:</strong> If you did not create the account then you can not sell everything on system and the buyer cannot give the rate point for you.</div>
    
    
<?php
	include('include/footer.inc.php');
?>