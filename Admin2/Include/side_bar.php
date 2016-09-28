<?php
function side_bar()
{?>
<div class="cmn-t-shake logo"> 
	<a href="index.php"><img src="images/logo-2.png" alt="logo" /></a> 
</div>
  <!------------------Profile-Info Start----------------------->
<div class="profile">
    <div class="profile_pic col-sm-3">
    	<img  src="images/admin.png" alt="profile_image" class="image-circle img-circle img-thumbnail img-responsive" />
    </div>
    <div class="profile_info col-sm-9">
    	<span>Welcome</span>
    	<h2><?php echo $_SESSION['name'] ?></h2>
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
                    <a href="#collapse0" data-toggle="collapse" data-parent="#accordion" class="home" onClick="getpage('home','Pages/function.php?home=home','Home');"><i class="icon-dashboard"></i>Dashboard</a>
                </h5>
            </div>
            <div id="collapse0" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Products----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="icon-shopping-cart"></i>Products</a>
                </h3>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                    	<li class="list-group-item"><a class="add_main_item" onClick="getpage('add_main_item','Pages/function.php?mycat=add_main_cat','Category');" >Add Main Category</a>
                        </li>
                        <li class="list-group-item"><a class="add_item" onClick="getpage('add_item','Pages/function.php?mycat=add_cat','Category');" >Add Category</a>
                        </li>
                        <li class="list-group-item"><a class="add_sub_item" onClick="getpage('add_sub_item','Pages/function.php?mycat=add_sub_cat','Category');" >Add Sub Category</a>
                        </li>
                        <li class="list-group-item"><a class="add_brand" onClick="getpage('add_brand','Pages/function.php?mycat=add_brand','Category');">Add Brand</a>
                        </li>
                        <li class="list-group-item"><a class="add_product" onClick="getpage('add_product','Pages/function.php?mycat=add_product','Category');">Add Product</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------Vendors----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i class="icon-bullhorn"></i>Vendors</a>
                </h3>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="vendor_list" onClick="getpage('vendor_list','Pages/function.php?vendor=vendor_list','Vendor');" >Vendor List</a>
                        </li>
                        <li class="list-group-item"><a class="vendorship_payment" onClick="getpage('vendorship_payment','Pages/function.php?vendor=vendorship_payment','Vendor');">Vendorship Payment</a>
                        </li>
                        <li class="list-group-item"><a class="vendorship_type" onClick="getpage('vendorship_type','Pages/function.php?vendor=vendorship_type','Vendor');">Vendorship Type</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------Sale----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse3" data-toggle="collapse" data-parent="#accordion" class="sale" onClick="getpage('sale','Pages/function.php?sales=sales_report','Sales_Report');"><i class="icon-usd"></i>Sale</a>
                </h3>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Customers----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse4" data-toggle="collapse" data-parent="#accordion" class="customers" onClick="getpage('customers','Pages/function.php?customers=detail','User_Detail');"><i class="icon-group"></i>Customers</a>
                </h3>
            </div>
            <div id="collapse4" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Messaging----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse5" data-toggle="collapse" data-parent="#accordion"><i class="icon-inbox"></i>Messaging</a>
                </h3>
            </div>
            <div id="collapse5" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="newsletter" onClick="getpage('newsletter','Pages/function.php?messaging=newsletter','News_Letter');">Newsletter</a>
                        </li><li class="list-group-item"><a class="contact_messages" onClick="getpage('contact_messages','Pages/function.php?messaging=contact_messages','Contact_Messages');">Contact Messages List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------Create New Page----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse6" data-toggle="collapse" data-parent="#accordion" class="create_page" onClick="getpage('create_page','Pages/function.php?create_page=new','Create_Page');"><i class="icon-file-text"></i>Create New Page</a>
                </h3>
            </div>
            <div id="collapse6" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Front Settings----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse7" data-toggle="collapse" data-parent="#accordion"><i class="icon-desktop"></i>Front Settings</a>
                </h3>
            </div>
            <div id="collapse7" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="banner_setting" onClick="getpage('banner_setting','Pages/function.php?front_setting=banner_setting','Banner');">Banner Settings List</a>
                        </li><li class="list-group-item"><a class="site_setting" onClick="getpage('site_seting','Pages/function.php?front_setting=site_setting','Site_Setting');">Site Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------Staff----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse8" data-toggle="collapse" data-parent="#accordion"><i class="icon-user"></i>Staff</a>
                </h3>
            </div>
            <div id="collapse8" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a class="all_staff" onClick="getpage('all_staff','Pages/function.php?staff=all_staff','All_Staff');">All Staff</a>
                        </li><li class="list-group-item"><a class="staff_permission" onClick="getpage('staff_permission','Pages/function.php?staff=staff_permission','Staff_Permission');">Staff Permissions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!------------------Bussiness Settings----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse9" data-toggle="collapse" data-parent="#accordion" class="bussiness_seting" onClick="getpage('bussiness_setting','Pages/function.php?bussiness_setting=detail','Bussiness_Detail');"><i class="icon-briefcase"></i>Bussiness Settings</a>
                </h3>
            </div>
            <div id="collapse9" class="panel-collapse collapse">
            </div>
        </div>
        
        <!------------------Manage Admin Profile----------------------->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#collapse10" data-toggle="collapse" data-parent="#accordion" class="admin_profile" onClick="getpage('admin_prfile','Pages/function.php?admin_profile=edit','Admin_Profile');"><i class="icon-lock"></i>Manage Admin Profile</a>
                </h3>
            </div>
            <div id="collapse10" class="panel-collapse collapse">
            </div>
        </div>
    </div>
</div>
<!------------------Left-Menu-End----------------------->
<?php
}
?>