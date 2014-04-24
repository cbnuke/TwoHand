<?php
	session_start();
	//Check Hacking
	if($_GET['user']==NULL)
		header("location:feedback.php");
		
	include('include/connection.inc.php');
	
	//Feedback
	if(isset($_POST['star'])){
		$istar = $_POST['star'];
		$icomment = $_POST['comment'];
		$iuser = $_GET['user'];
		$sql = 'INSERT INTO `feedback`(`m_user`, `f_ment`, `f_rate`) VALUES (\''.$iuser.'\',\''.$icomment.'\',\''.$istar.'\')';
		$query = mysqli_query($objConnect,$sql);
		if($query)
			$flag = TRUE;
		else
			$flag = FALSE;
	}
	
	//Read information from database
	$sql = 'SELECT * FROM `member` WHERE `m_user` = \''.$_GET['user'].'\'';
	$query = mysqli_query($objConnect,$sql);
	if(mysqli_num_rows($query)==0)
		header("location:feedback.php");
	$data = mysqli_fetch_array($query);
	
	//Count rate	
	$sql = 'SELECT * FROM `feedback` WHERE `m_user` = \''.$_GET['user'].'\'';
	$query = mysqli_query($objConnect,$sql);
	$sum = 0;
	foreach($query as $row){
		$sum += $row['f_rate'];
	}
	$sum = number_format($sum / mysqli_num_rows($query), 2);
	
		
	include('include/header.inc.php');
	showHeader('feedback');
	
	//Alert Feedback
	if(isset($flag)&&$flag)
		echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> Thank you for your comment.</div>';
?>
	<h3>Profile</h3>
    
    <div class="row">
    
    	<div class="col-md-5">
        	<div class="row">
            	<div class="col-md-12">
    				<div class="panel panel-default">
  						<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Information of seller</div>
  						<div class="panel-body">
                        	<div class="row">
                            	<div class="col-md-8">Name: <?=$data['m_name']?><br>Tel: <?=$data['m_tel']?><br>E-mail: <?=$data['m_email']?><br>Address: <?=$data['m_address']?></div>
                                <div class="col-md-4">
									<div class="panel panel-info"><div class="panel-body text-center" style="padding:0px;">Rating<h2><strong><?=$sum?></strong></h2></div></div>
                                </div>
                            </div>
                        </div>
           			</div>
        		</div>
        	</div>
            
            <div class="row">
            	<div class="col-md-12">
    				<div class="panel panel-default">
  						<div class="panel-heading"><span class="glyphicon glyphicon-comment"></span> Feedback</div>
  						<div class="panel-body">
                        	<form method="post" role="form">
                            <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment"></textarea></div>
                            <div class="form-group">
                            <button type="submit" name="star" value="5" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 5</button>
                            <button type="submit" name="star" value="4" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 4</button>
                            <button type="submit" name="star" value="3" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 3</button>
                            <button type="submit" name="star" value="2" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 2</button>
                            <button type="submit" name="star" value="1" class="btn btn-default"><span class="glyphicon glyphicon-star"></span> 1</button>
                            </div>
                            	
                            </form>
                      </div>
           			</div>
        		</div>
        	</div>
            
      	</div>  
             
        <div class="col-md-7">
        	<div class="row">
            	<div class="col-md-12">
    			<div class="panel panel-success">
  					<div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> List of sold item</div>
  					<div class="panel-body">
                    	<table class="table table-hover">
                        	<tr>
                           		<th width="100">Image</th>
                            	<th>Name of product</th>
                                <th>Detail of product</th>                           
                            </tr>
                            <?php
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 1 AND `m_user` = \''.$_GET['user'].'\'';
							$query = mysqli_query($objConnect,$sql);
							foreach($query as $row){
							?>
                        	<tr>
                            	<td><a href="product.php?pid=<?=$row['p_id']?>" class="thumbnail"><img height="100" src="<?=$row['p_pic1']?>"></a></td>
                                <td><strong><?=$row['p_name']?></strong><br />Quality: <?=$row['p_quality']?>%<br />Price: <?=$row['p_price']?>baht</td>
                                <td align="center"><a href="product.php?pid=<?=$row['p_id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a></td>
                            </tr>
                            <?php }?>
                        </table>                    	
                    </div>
           		</div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-12">
    			<div class="panel panel-info">
  					<div class="panel-heading"><span class="glyphicon glyphicon-briefcase"></span> List of sell item</div>
  					<div class="panel-body">
                    	<table class="table table-hover">
                        	<tr>
                           		<th width="100">Image</th>
                            	<th>Name of product</th>
                                <th>Detail of product</th>                                
                            </tr>
                            <?php
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 0 AND `m_user` = \''.$_GET['user'].'\'';
							$query = mysqli_query($objConnect,$sql);
							foreach($query as $row){
							?>
                        	<tr>
                            	<td><a href="product.php?pid=<?=$row['p_id']?>" class="thumbnail"><img height="100" src="<?=$row['p_pic1']?>"></a></td>
                                <td><strong><?=$row['p_name']?></strong><br />Quality: <?=$row['p_quality']?>%<br />Price: <?=$row['p_price']?>baht</td>
                                <td align="center"><a href="product.php?pid=<?=$row['p_id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a></td>
                            </tr>
                            <?php }?>
                      	</table>    
                    </div>
           		</div>
        		</div>  
            </div>
            
        </div>
        
    </div>
    

<?php
	include('include/footer.inc.php');
?>