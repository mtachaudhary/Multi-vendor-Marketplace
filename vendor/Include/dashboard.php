<?php
function dashboard()
{?>
	<div class="page-title">
		<h1 class="text-overflow">Dashboard</h1>
    </div>
    
    <div class="row">
    	<div class="col-md-5">
        	<div class="dash-box vnd-type">
            	<h3>Vendorship Type</h3>
                <div class="inner text-center">
                	<img src="images/vendorship-type.png" class="img-circle" width="125px" />
                	<h4>Default</h4>
                </div>
            </div>
        </div>
        <div class="col-md-7">
        	<div class="dash-box vnd-detail">
            	<h3>Vendorship Details</h3>
                <?php
				db();
				$query = "SELECT * FROM product WHERE vendor_id='".$_SESSION['v_id']."'";
				$query_exe = mysql_query($query);
				if($query_exe)
				{
					$num = mysql_num_rows($query_exe);
				}
				else echo mysql_error();
				?>
                <div class="inner">
                    <table class="table table-striped text-capitalize">
                        <tr>
                            <td>Display Name</td>
                            <td><?php echo $_SESSION['business_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Vendorship Expiration</td>
                            <td>Lifetime</td>
                        </tr>
                        <tr>
                            <td>Maximum Products</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Total Uploaded Products</td>
                            <td><?php echo $num; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-4">
        	<div class="dash-box total-sold">
            	<h3>Total Sold</h3>
                <div class="inner text-center">
                	<img src="images/canvas.png" width="100%" />
                    <p class="h4">
                    	<span class="label label-purple">PKR</span>
                        <span class="label label-purple">0</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="dash-box paid-cust">
            	<h3>Paid By Customers</h3>
                <div class="inner text-center">
                	<img src="images/canvas.png" width="100%" />
                    <p class="h4">
                    	<span class="label label-green">PKR</span>
                        <span class="label label-green">0</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="dash-box due-admin">
            	<h3>Due From Admin</h3>
                <div class="inner text-center">
                	<img src="images/canvas.png" width="100%" />
                    <p class="h4">
                    	<span class="label label-black">PKR</span>
                        <span class="label label-black">0</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>