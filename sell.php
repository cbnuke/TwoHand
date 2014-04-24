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
		$ilat = $_POST['ilat'];
		$ilong = $_POST['ilong'];
		$iuser = $_SESSION['user'];
		
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
                    <input type="hidden" name="ilat" id="ilat" />
                    <input type="hidden" name="ilong" id="ilong" />
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
 					<div id="map_canvas"></div>
  				</div>
            </div>
		</div>
        
	</div>
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
	function myMaps() {
		var mapsGoo=google.maps;
		var Position=new mapsGoo.LatLng(14.075866, 100.617064);//ละติจูด,ลองติจูด เริ่มต้น
		var myOptions = {
							center:Position,//ตำแหน่งแสดงแผนที่เริ่มต้น
							zoom:14,//ซูมเริ่มต้น คือ 8
							mapTypeId: mapsGoo.MapTypeId.ROADMAP //ชนิดของแผนที่
						};
		var map = new mapsGoo.Map(document.getElementById("map_canvas"),myOptions);
		var infowindow = new mapsGoo.InfoWindow();
		var marker = new mapsGoo.Marker({//เรียกเมธอดMarker(ปักหมุด)และกำหนดออปชั่น
											position: Position,
											draggable:true
										});
		var Posi=marker.getPosition();//เลือกเมธอดแสดงตำแหน่งของตัวปักหมุด
		$('#ilat').val(Posi.lat());//ละติจูดของMarker
		$('#ilong').val(Posi.lng());//ลองติจูดของMarker
		marker.setMap(map);//แสดงตัวปักหมุดโลด!!
		//ตรวจจับเหตุการณ์ต่างๆ ที่เกิดใน google maps
		mapsGoo.event.addListener(marker, 'dragend', function(ev) {//ย้ายหมุด
		var location =ev.latLng;
		$('#ilat').val(location.lat());//เอาค่าละติจูดไปแสดงที่ Tag HTML ที่มีแอตทริบิวต์ id ชื่อ mapsLat
		$('#ilong').val(location.lng());//เอาค่าลองติจูดไปแสดงที่ Tag HTML ที่มีแอตทริบิวต์ id ชื่อ mapsLng
		});
		mapsGoo.event.addListener(marker, 'click', function(ev) {//คลิกที่หมุด
		var location =ev.latLng;
		$('#ilat').val(location.lat());//เอาค่าละติจูดไปแสดงที่ Tag HTML ที่มีแอตทริบิวต์ id ชื่อ mapsLat
		$('#ilong').val(location.lng());//เอาค่าลองติจูดไปแสดงที่ Tag HTML ที่มีแอตทริบิวต์ id ชื่อ mapsLng
		infowindow.setContent('Meeting location');
		infowindow.open(map, marker);
		});
	}
	$(document).ready(function(){
		myMaps();
	});
	</script>

<?php
	include('include/footer.inc.php');
?>