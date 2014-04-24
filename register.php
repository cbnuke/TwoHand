<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('register');
	
	if(isset($_POST['submit'])&&$_POST['submit']=='submit'){
		$iname = $_POST['iname'];
		$itel = $_POST['itel'];
		$iaddress = $_POST['iaddress'];
		$iemail = $_POST['iemail'];
		$iusername = $_POST['iusername'];
		$ipassword = $_POST['ipassword'];
	
		if($iname!=NULL&&$itel!=NULL&&$iaddress!=NULL&&$iemail!=NULL&&$iusername!=NULL&&$ipassword!=NULL){
			$sql = 'INSERT INTO `member`(`m_user`, `m_pass`, `m_name`, `m_tel`, `m_email`, `m_address`) VALUES (\''.$iusername.'\',\''.$ipassword.'\',\''.$iname.'\',\''.$itel.'\',\''.$iemail.'\',\''.$iaddress.'\')';
			$flag = (mysqli_query($objConnect,$sql))?TRUE:FALSE;
			
			if($flag){
				//Register complete
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> Your account has create now.</div>';
			}else{
				//Register not complete
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Fail!</strong> Username is duplicate to another account.</div>';
			}
			
		}else{
			//Not fill all of information
			echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Warning!</strong> Please fill all of your information.</div>';
		}
	}
	
?>

     <div class="row">
      <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-info">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>Please sign in</strong></h3>
  		</div>
  		<div class="panel-body">
 			<form class="form-horizontal" role="form" method="post">
        		<div class="form-group"><label for="iname" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
    			<input type="text" id="iname" name="iname" class="form-control" required autofocus>
                </div>
                </div>
                <div class="form-group"><label for="itel" class="col-sm-2 control-label">Tel.</label>
                <div class="col-sm-10">
    			<input type="text" id="itel" name="itel" class="form-control" required>
                </div>
                </div>
                <div class="form-group"><label for="iaddress" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                <textarea id="iaddress" name="iaddress" class="form-control" required></textarea>
                </div>
                </div>
                <div class="form-group"><label for="iemail" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
    			<input type="email" id="iemail" name="iemail" class="form-control" required>
                </div>
                </div>
                <div class="form-group"><label for="iusername" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
    			<input type="text" id="iusername" name="iusername" class="form-control" required>
                </div>
                </div>
                <div class="form-group"><label for="ipassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
    			<input type="password" id="ipassword" name="ipassword" class="form-control" required>
                </div>
                </div>
        		<div class="clearfix col-md-offset-2">
        		<button class="btn btn-primary col-md-4" style="margin-left:14px;" type="submit" name="submit" value="submit">Register</button>
                <button class="btn btn-danger col-md-4" style="margin-left:14px;" type="reset">Reset</button>
        		</div>
     		 </form>
  		</div>
	</div>
	</div>
    </div>
    
    <div class="alert alert-warning"><strong>Notice:</strong> Please fill all of information to the reliability of your product.</div>
    
<?php
	include('include/footer.inc.php');
?>