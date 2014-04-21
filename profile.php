<?php
	//Check Hacking
	if($_GET['user']==NULL)
		header("location:feedback.php");
		
	include('include/connection.inc.php');
	
	//Read information from database
	$sql = 'SELECT * FROM `member` WHERE `m_user` = \''.$_GET['user'].'\'';
	$query = mysqli_query($objConnect,$sql);
	if(mysqli_num_rows($query)==0)
		header("location:feedback.php");
	$data = mysqli_fetch_array($query);
		
	include('include/header.inc.php');
	showHeader('feedback');
	
	
?>
	<h3>Profile</h3>
    
    <div class="row">
    
    	<div class="col-md-5">
    		<div class="panel panel-default">
  				<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Information of seller</div>
  				<div class="panel-body">Name: <?=$data['m_name']?><br>Tel: <?=$data['m_tel']?><br>
                E-mail: <?=$data['m_email']?><br>Address: <?=$data['m_address']?></div>
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
                            	<td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    	<?php
							$sql = 'SELECT * FROM `product` WHERE `p_status` = 0 AND `m_user` = \''.$_GET['user'].'\'';
							$query = mysqli_query($objConnect,$sql);
							foreach($query as $row)
						?>
                    	Panel content
                    </div>
           		</div>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-md-12">
    			<div class="panel panel-info">
  					<div class="panel-heading"><span class="glyphicon glyphicon-briefcase"></span> List of sell item</div>
  					<div class="panel-body">Panel content</div>
           		</div>
        		</div>  
            </div>
            
        </div>
        
    </div>
    

<?php
	include('include/footer.inc.php');
?>