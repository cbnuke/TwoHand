<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('manage');
	
	$iuser = $_SESSION['user'];
	
	//Change status to sold
	if(isset($_GET['pid'])&&$_GET['pid']!=NULL){
		$sql = 'SELECT * FROM `product` WHERE `m_user` = \''.$iuser.'\' AND `p_id` = \''.$_GET['pid'].'\'';
		$query = mysqli_query($objConnect,$sql);
		if(mysqli_num_rows($query)==1){
			$sql = 'UPDATE `product` SET `p_status`=\'1\' WHERE `p_id` = \''.$_GET['pid'].'\'';
			$query = mysqli_query($objConnect,$sql);
			if($query)
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> Update product to sold.</div>';
		}else{
			header("location:manage.php");
		}
	}
?>
	<h3>Management your product</h3>
    	<div class="row">
            	<div class="col-md-6">
    			<div class="panel panel-info">
  					<div class="panel-heading"><span class="glyphicon glyphicon-briefcase"></span> List of sell item</div>
  					<div class="panel-body">
                    	<table class="table table-hover">
                        	<tr>
                           		<th width="100">Image</th>
                            	<th>Name of product</th>
                                <th>Detail of product</th>
                                <th>Sold out</th>                                
                            </tr>
                            <?php
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 0 AND `m_user` = \''.$iuser.'\'';
							$query = mysqli_query($objConnect,$sql);
							foreach($query as $row){
							?>
                        	<tr>
                            	<td><a href="product.php?pid=<?=$row['p_id']?>" class="thumbnail"><img height="100" src="<?=$row['p_pic1']?>"></a></td>
                                <td><strong><?=$row['p_name']?></strong><br />Quality: <?=$row['p_quality']?>%<br />Price: <?=$row['p_price']?>baht</td>
                                <td align="center"><a href="product.php?pid=<?=$row['p_id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a></td>
                                <td align="center"><a href="?pid=<?=$row['p_id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-export"></span></a></td>
                            </tr>
                            <?php }?>
                      	</table>    
                    </div>
           		</div>
        		</div>  
                
                
                <div class="col-md-6">
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
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 1 AND `m_user` = \''.$iuser.'\'';
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

<?php
	include('include/footer.inc.php');
?>