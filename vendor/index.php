<?php
	session_start();
	function db()
	{
		$connect=@mysql_connect('localhost','root','');
		mysql_select_db('bazzar');
	}
	include('Include/check.php');
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vendor | BAZzAR</title>
    <link rel="icon" href="../images/fav-icon.png" />
    
    <!----------------css------------->
    <link href="../Bazzar-CSS/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../Bazzar-CSS/jquery-ui.min.css" rel="stylesheet" />
    <link href="../Bazzar-CSS/vendor-dashboard.css" rel="stylesheet" />
    
    <!----------------Jquery------------->
    <script src="../Bazzar-JQuery/jquery.min.js" type="text/javascript"></script>
    <script src="../Bazzar-JQuery/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/ajax.js" type="text/javascript"></script>

</head>

<!------------------PHP Included Files---------------->
<?php include('Include/dashboard.php'); ?>
<?php include('Include/header.php'); ?>
<?php include('Include/side_bar.php'); ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 sidebar nopadding">
            	<?php side_bar(); ?>
            </div>
            <div  class="col-sm-9 pages">
                <div id="load">
                	<img src="images/loader.gif" />
                </div>
                <?php vendor_header(); ?>
                <div id="admin_content">
                	<?php dashboard(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
