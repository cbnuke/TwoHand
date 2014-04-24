<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('search');
?>
	<h3>Search product</h3>
    <div class="row"> 
      <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-info">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>Detail to search</strong></h3>
  		</div>
  		<div class="panel-body">
        	<form class="form-inline" role="form">
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
				<div class="form-group">
			    <input type="text" name="itext" class="form-control" placeholder="Product name" <?php if(isset($_GET['itext']))echo 'value="'.$_GET['itext'].'"';?>>
			  	</div>
  				<button type="submit" class="btn btn-primary">Search</button>
			</form>
  		</div>
	  </div>
	  </div>
    </div>
        
    <?php
		if(isset($_GET['catalog'])&&isset($_GET['itext'])){
			if($_GET['catalog']=='all'){
				$sql = 'SELECT * FROM `product` WHERE `p_name` LIKE \'%'.$_GET['itext'].'%\'';
			}else{
				$sql = 'SELECT * FROM `product` WHERE `c_id` = \''.$_GET['catalog'].'\' AND`p_name` LIKE \'%'.$_GET['itext'].'%\'';
			}
			$query = mysqli_query($objConnect,$sql);
	?>
    <div class="row"> 
      <div class="col-md-12">
      <div class="panel panel-default">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>Result</strong></h3>
  		</div>
  		<div class="panel-body">
        	<?php
				$i = 3;
				foreach($query as $row){
					if($i==3){
						echo '<div class="row">';
					}
					
					
					echo '<div class="col-md-4"><div class="thumbnail"><img src="'.$row['p_pic1'].'"><div class="caption">';
					if($row['p_status']==1)
						echo '<h3>'.$row['p_name'].' <span class="label label-danger">Sold</span></h3>';
					else
						echo '<h3>'.$row['p_name'].'</h3>';        		
					echo '<p><strong>Price:</strong> '.$row['p_price'].'baht <strong>Quality:</strong> '.$row['p_quality'].'%</p>
        		<p><a href="product.php?pid='.$row['p_id'].'" class="btn btn-success" role="button">Detail of product</a></p>
      			</div>
    		</div>
            </div>';
					
					$i--;
					if($i==0){
						echo '</div>';
						$i=3;
					}
				}
				if($i!=0){
					echo '</div>';
				}
			?>
  
  		</div>
	  </div>
	  </div>
    </div>
    <?php
		}
	?>

<?php
	include('include/footer.inc.php');
?>