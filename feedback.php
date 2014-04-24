<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('feedback');
?>
	<h3>Feed back</h3>
 	<div class="row">
    
      <div class="col-md-3">
      <div class="panel panel-info">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>1. Choose catalog</strong></h3>
  		</div>
  		<div class="panel-body">
 			<form role="form">
        		<div class="form-group">
                <select class="form-control" name="catalog">
                <option value="all">All seller</option>
                <?php
					$sql = 'SELECT * FROM `catalog` ORDER BY `c_id` ASC';
					$query = mysqli_query($objConnect,$sql);
					foreach($query as $row){
						echo '<option value="'.$row['c_id'].'" ';
						if(isset($_GET['catalog'])&&$_GET['catalog']==$row['c_id'])
							echo 'selected="selected"';
						echo '>'.$row['c_name'].'</option>';
					}
				?>
                </select>
        		</div>
        		<div class="form-group col-md-offset-2">
        		<button class="btn btn-primary col-md-6" style="margin-left:30px;" type="submit">Choose</button>
        		</div>
     		 </form>
  		</div>
	</div>
	</div>
    
    <div class="col-md-9">
    	<div class="panel panel-info">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>2. Choose seller</strong></h3>
  		</div>
  		<div class="panel-body">
 			<table class="table table-hover">
            	<tr>
            		<th>Information</th>
                    <th>Sell item</th>
                    <th>Sold item</th>
                    <th></th>
                </tr>
                <?php 
					if(isset($_GET['catalog'])){
						if($_GET['catalog']=='all')
							$sql = 'SELECT * FROM `member`';
						else
							$sql = 'SELECT * FROM `product` 
									LEFT JOIN `catalog` ON `catalog`.`c_id` = `product`.`c_id`
									LEFT JOIN `member` ON `member`.`m_user` = `product`.`m_user`
									WHERE `product`.`c_id` = \''.$_GET['catalog'].'\' GROUP BY `product`.`m_user`';
							
						$query = mysqli_query($objConnect,$sql);
						if(mysqli_num_rows($query)==0)
							echo '<tr><td colspan="4" align="center">Not have seller in catalog</td>';
						foreach($query as $row){
							//Check sell item of user
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 0 AND `m_user` = \''.$row['m_user'].'\'';
							$query2 = mysqli_query($objConnect,$sql);
							$numsell = mysqli_num_rows($query2);
							//Check sold item of user
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 1 AND `m_user` = \''.$row['m_user'].'\'';
							$query2 = mysqli_query($objConnect,$sql);
							$numsold = mysqli_num_rows($query2);
				?>
				<tr>
                	<td><?=$row['m_name']?><br />E-mail: <?=$row['m_email']?></td>
                    <td><span class="glyphicon glyphicon-briefcase"></span> <?=$numsell?></td>
                    <td><span class="glyphicon glyphicon-shopping-cart"></span> <?=$numsold?></td>
                    <td><a href="profile.php?user=<?=$row['m_user']?>" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
               	</tr>	
				<?php
						}//End foreach
					}else{
				?>
                	<tr><td colspan="4" align="center">Please  choose catalog for search seller.</td>
                <?php } ?>            	
            </table>
  		</div>
        </div>
    </div>
    
    </div>
<?php
	include('include/footer.inc.php');
?>