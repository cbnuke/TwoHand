<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('search');
	
	if(isset($_GET['pid'])){
		$sql = 'SELECT * FROM `product` WHERE `p_id` = \''.$_GET['pid'].'\'';
		$query = mysqli_query($objConnect,$sql);
		if(mysqli_num_rows($query)==1){
			$rowM = mysqli_fetch_array($query);
		}else{
			header("location:search.php");
		}
		
		//Read information from database
		$sql = 'SELECT * FROM `member` WHERE `m_user` = \''.$rowM['m_user'].'\'';
		$query = mysqli_query($objConnect,$sql);
		$data = mysqli_fetch_array($query);
		//Count rate	
		$sql = 'SELECT * FROM `feedback` WHERE `m_user` = \''.$rowM['m_user'].'\'';
		$query = mysqli_query($objConnect,$sql);
		$sum = 0;
		foreach($query as $row){
			$sum += $row['f_rate'];
		}
		$sum = number_format($sum / mysqli_num_rows($query), 2);
		
	}else{
		header("location:search.php");
	}
?>
	<h3>Detail of product <?php if($rowM['p_status']==1)echo '<span class="label label-danger">Sold</span>'; ?></h3>
 	<div class="row">
    	<div class="col-md-6">
      		<div class="panel panel-success">
  				<div class="panel-heading">
    				<h3 class="panel-title"><strong>Information of product</strong></h3>
  				</div>
  				<div class="panel-body">
 					<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
                    <fieldset disabled>
        			<div class="form-group"><label for="iname" class="col-sm-4 control-label">Name of product</label>
                	<div class="col-sm-8">
    				<input type="text" id="iname" name="iname" class="form-control" value="<?=$rowM['p_name']?>">
                	</div>
                	</div>
                	<div class="form-group"><label for="icatalog" class="col-sm-4 control-label">Catalog</label>
               	 	<div class="col-sm-8">
                    <select class="form-control" name="icatalog">
                    <?php
					$sql = 'SELECT * FROM `catalog` ORDER BY `c_id` ASC';
					$query = mysqli_query($objConnect,$sql);
					foreach($query as $row){
						if($rowM['c_id']==$row['c_id'])
							echo '<option value="'.$row['c_id'].'" selected>'.$row['c_name'].'</option>';
					}
					?>
                    </select>    				
                	</div>
                	</div>
                	<div class="form-group"><label for="iquality" class="col-sm-4 control-label">Quality</label>
                	<div class="col-sm-8">
                    <input type="number" id="iquality" name="iquality" class="form-control"  value="<?=$rowM['p_quality']?>">
                	</div>
                	</div>
                	<div class="form-group"><label for="iprice" class="col-sm-4 control-label">Price</label>
                	<div class="col-sm-8">
    				<input type="number" id="iprice" name="iprice" class="form-control"  value="<?=$rowM['p_price']?>">
                	</div>
               	 	</div>                	
                	<div class="form-group"><label for="iother" class="col-sm-4 control-label">Other infomation</label>
                	<div class="col-sm-8">
                    <textarea id="iother" name="iother" class="form-control"><?=$rowM['p_otherinfo']?></textarea>
                	</div>
                	</div>
                    </fieldset>                       		
     		 		</form>
			  </div>
            </div>
		</div>
        
        <div class="col-md-6">
      		<div class="panel panel-warning">
  				<div class="panel-heading">
    				<h3 class="panel-title"><strong>Seller profile</strong></h3>
  				</div>
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
    
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
   
   
   <div class="row"> 
      <div class="col-md-12">
      <div class="panel panel-primary">
  		<div class="panel-heading">
    		<h3 class="panel-title"><strong>Location</strong></h3>
  		</div>
  		<div class="panel-body">
        	<div id="map-canvas"></div>
  		</div>
	  </div>
	  </div>
    </div>
   

<?php
	include('include/footer.inc.php');
?>