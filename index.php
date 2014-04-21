<?php
	include('include/connection.inc.php');
	include('include/header.inc.php');
	showHeader('index');
?>
		<div class="row" style="margin: 30px 0px;">
        	<div class="col-md-12">
       			<h2>All the things you want, we have! All the things you have, we want!</h2>
        	</div>
        </div>
        
<div class="row" style="margin: 80px 0px;">
        	<div class="col-md-3 col-md-offset-2">
        		<a class="btn btn-lg btn-warning" href="search.php" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> I want to Buy.</a>
</div>
            <div class="col-md-3 col-md-offset-2">
        	    <a class="btn btn-lg btn-primary" href="" role="button"><span class="glyphicon glyphicon-usd"></span> I want ot Sell.</a>
	        </div>
        </div>
        
        <div class="row">
        	<div class="col-md-12">
        	<blockquote>
        	<p>We are a website that allows students and staff of Thammasat University and AIT can post for sell and find the second-hand product.</p>
        	</blockquote>
        	</div>
        </div>

<?php
	include('include/footer.inc.php');
?>