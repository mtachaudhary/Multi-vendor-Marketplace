<?php session_start(); ?>
<?php include('Include/check.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<!----------------css------------->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="css/dashboard.css" rel="stylesheet" />
<!----------------Jquery------------->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>

</head>

<!------------------PHP Included Files---------------->
<?php include('Include/home.php'); ?>
<?php include('Include/header.php'); ?>
<?php include('Include/side_bar.php'); ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 sidebar nopadding">
            	<?php side_bar(); ?>
            </div>
            <div  class="col-sm-9 pages pull-right">
                <div id="load">
                	<img src="images/loader.gif" />
                </div>
                <?php admin_header(); ?>
                <div id="admin_content">
                	<?php home(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>