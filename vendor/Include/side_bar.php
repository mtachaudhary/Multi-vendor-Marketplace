<?php
function side_bar()
{?>
<div class="cmn-t-shake logo"> 
	<a href="../index.php"><img src="images/logo-2.png" alt="logo" /></a> 
</div>
  <!------------------Profile-Info Start----------------------->
<div class="profile">
    <div class="profile_pic col-sm-3">
    	<img  src="images/profile_pics/vendor_profile_pic(<?php echo $_SESSION['v_id'];?>).<?php echo $_SESSION['profile_pic'];?>" alt="profile_image" class="img-circle img-thumbnail img-responsive" />
    </div>
    <div class="profile_info col-sm-9">
    	<span>Welcome</span>
    	<h2><?php echo $_SESSION['business_name']; ?></h2>
    </div>
</div>
  <!------------------Profile-Info End----------------------->
  
  <!------------------Left-Menu-Starts----------------------->
<div class="left-menu">
    <div class="panel-group" id="accordion">
    
    	<!------------------Dashboard----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <a href="#collapse0" data-toggle="collapse" data-parent="#accordion" class="dashboard" onClick="getpage('dashboard','Pages/function.php?dashboard=dashboard','dashboard');"><i class="fa fa-tachometer"></i>Dashboard</a>
                </h5>
            </div>
            <div id="collapse0" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------ MyProducts ----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    	<i class="fa fa-shopping-cart"></i>My Products
                        <span class="text-right pull-right"><img src="images/51.png" width="15px" /><img src="images/37.gif" width="15px" /></span>
                    </a>
                </h3>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="product_list" onClick="getpage('product_list','Pages/function.php?myproduct=product_list','products');" >Product List</a>
                        </li>
                        <li class="list-group-item"><a class="product_stock" onClick="getpage('product_stock','Pages/function.php?myproduct=product_stock','products');" >Product Stock</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------ Reports ----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    	<i class="fa fa-file-text"></i>Reports
                        <span class="text-right pull-right"><img src="images/51.png" width="15px" /><img src="images/37.gif" width="15px" /></span>
                    </a>
                </h3>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="product_compare" onClick="getpage('product_compare','Pages/function.php?reports=product_compare','reports');" >Product Compare</a>
                        </li>
                        <li class="list-group-item"><a class="product_stock_report" onClick="getpage('product_stock_report','Pages/function.php?reports=product_stock_report','reports');">Product Stock</a>
                        </li>
                        <li class="list-group-item"><a class="product_wishes" onClick="getpage('product_wishes','Pages/function.php?reports=product_wishes','reports');">Product Wishes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------ Sale ----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse3" data-toggle="collapse" data-parent="#accordion" class="sale" onClick="getpage('sale','Pages/function.php?sales=sales_report','sale');"><i class="fa fa-usd"></i>Sale</a>
                </h3>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------ Payment Settings ----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse4" data-toggle="collapse" data-parent="#accordion" class="payment_settings" onClick="getpage('payment_settings','Pages/function.php?payment_settings=detail','payment_settings');"><i class="fa fa-usd"></i>Payment Settings</a>
                </h3>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Manage Vendor Profile----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse5" data-toggle="collapse" data-parent="#accordion" class="vendor_profile" onClick="getpage('vendor_profile','Pages/function.php?vendor_profile=edit','vendor_profile');"><i class="fa fa-lock"></i>Manage Vendor Profile</a>
                </h3>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
            </div>
        </div>
    </div>
</div>
<!------------------Left-Menu-End----------------------->
<?php
}
?>
