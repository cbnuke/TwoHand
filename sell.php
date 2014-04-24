<?php
	session_start();
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('sell');
	
	if(isset($_POST['submit'])&&$_POST['submit']=='submit'){
		$iname = $_POST['iname'];
		$icatalog = $_POST['icatalog'];
		$iquality = $_POST['iquality'];
		$iprice = $_POST['iprice'];
		$iother = $_POST['iother'];
		$iuser = $_SESSION['user'];
		$ilat = '';
		$ilong = '';
		
		$name='file_'.date('Y-m-dHis');
		if(isset($_FILES["pic1"]["tmp_name"])){
			$pic1 = (move_uploaded_file($_FILES["pic1"]["tmp_name"],"images/product/".$name.'p1.'.end(explode(".",$_FILES["pic1"]["name"]))));
			$ipic1= "images/product/".$name.'p1.'.end(explode(".",$_FILES["pic1"]["name"]));
		}
		if(isset($_FILES["pic1"]["tmp_name"])){
			$pic2 = (move_uploaded_file($_FILES["pic2"]["tmp_name"],"images/product/".$name.'p2.'.end(explode(".",$_FILES["pic2"]["name"]))));
			$ipic2= "images/product/".$name.'p2.'.end(explode(".",$_FILES["pic2"]["name"]));
		}
		if(isset($_FILES["pic1"]["tmp_name"])){
			$pic3 = (move_uploaded_file($_FILES["pic3"]["tmp_name"],"images/product/".$name.'p3.'.end(explode(".",$_FILES["pic3"]["name"]))));
			$ipic3= "images/product/".$name.'p3.'.end(explode(".",$_FILES["pic3"]["name"]));
		}
		if(isset($_FILES["pic1"]["tmp_name"])){
			$pic4 = (move_uploaded_file($_FILES["pic4"]["tmp_name"],"images/product/".$name.'p4.'.end(explode(".",$_FILES["pic4"]["name"]))));
			$ipic4= "images/product/".$name.'p4.'.end(explode(".",$_FILES["pic4"]["name"]));
		}
		
		$sql = 'INSERT INTO `product`(`m_user`, `p_name`, `c_id`,`p_price`, `p_quality`, `p_otherinfo`, `p_lat`, `p_long`, `p_pic1`, `p_pic2`, `p_pic3`, `p_pic4`, `p_status`) VALUES (\''.$iuser.'\',\''.$iname.'\',\''.$icatalog.'\',\''.$iprice.'\',\''.$iquality.'\',\''.$iother.'\',\''.$ilat.'\',\''.$ilong.'\',\''.$ipic1.'\',\''.$ipic2.'\',\''.$ipic3.'\',\''.$ipic4.'\',\'0\')';
		$flag =(mysqli_query($objConnect,$sql))?TRUE:FALSE;	
		if($flag){
			echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> Your product are ready to sell.</div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Fail!</strong> Please try again later.</div>';
		}
	}
?>

	<h3>Sell item</h3>
 	<div class="row">
    	<div class="col-md-6">
      		<div class="panel panel-info">
  				<div class="panel-heading">
    				<h3 class="panel-title"><strong>Information of product</strong></h3>
  				</div>
  				<div class="panel-body">
 					<form method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        			<div class="form-group"><label for="iname" class="col-sm-4 control-label">Name of product</label>
                	<div class="col-sm-8">
    				<input type="text" id="iname" name="iname" class="form-control" required autofocus>
                	</div>
                	</div>
                	<div class="form-group"><label for="icatalog" class="col-sm-4 control-label">Catalog</label>
               	 	<div class="col-sm-8">
                    <select class="form-control" name="icatalog">
                    <?php
					$sql = 'SELECT * FROM `catalog` ORDER BY `c_id` ASC';
					$query = mysqli_query($objConnect,$sql);
					foreach($query as $row){
						echo '<option value="'.$row['c_id'].'">'.$row['c_name'].'</option>';
					}
					?>
                    </select>    				
                	</div>
                	</div>
                	<div class="form-group"><label for="iquality" class="col-sm-4 control-label">Quality</label>
                	<div class="col-sm-8">
                    <input type="number" id="iquality" name="iquality" class="form-control" required min="1" max="100">
                	</div>
                	</div>
                	<div class="form-group"><label for="iprice" class="col-sm-4 control-label">Price</label>
                	<div class="col-sm-8">
    				<input type="number" id="iprice" name="iprice" class="form-control" required>
                	</div>
               	 	</div>             
                	<div class="form-group"><label for="iother" class="col-sm-4 control-label">Other infomation</label>
                	<div class="col-sm-8">
                    <textarea id="iother" name="iother" class="form-control"></textarea>
                	</div>
                	</div>
                    <div class="form-group"><label for="pic1" class="col-sm-4 control-label">Picture 1</label>
                	<div class="col-sm-8">
                    <input type="file" id="pic1" name="pic1" class="form-control" />
                	</div>
                	</div>
                    <div class="form-group"><label for="pic2" class="col-sm-4 control-label">Picture 2</label>
                	<div class="col-sm-8">
                    <input type="file" id="pic2" name="pic2" class="form-control" />
                	</div>
                	</div>
                    <div class="form-group"><label for="pic3" class="col-sm-4 control-label">Picture 3</label>
                	<div class="col-sm-8">
                    <input type="file" id="pic3" name="pic3" class="form-control" />
                	</div>
                	</div>
                    <div class="form-group"><label for="pic4" class="col-sm-4 control-label">Picture 4</label>
                	<div class="col-sm-8">
                    <input type="file" id="pic4" name="pic4" class="form-control" />
                	</div>
                	</div>
        			<div class="clearfix col-md-offset-2">
        			<button class="btn btn-primary col-md-4" style="margin-left:14px;" type="submit" name="submit" value="submit">Submit</button>
                	<button class="btn btn-danger col-md-4" style="margin-left:14px;" type="reset">Reset</button>
        			</div>
     		 		</form>
			  </div>
            </div>
		</div>
        
        <div class="col-md-6">
      		<div class="panel panel-info">
  				<div class="panel-heading">
    				<h3 class="panel-title"><strong>Location</strong></h3>
  				</div>
  				<div class="panel-body">
 					<div id="map-canvas"></div>
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
    	
	</div>
<?php
	include('include/footer.inc.php');
?>