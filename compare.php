<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Compare | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link href="Bazzar-CSS/bootstrap.min.css" rel="stylesheet"/>
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/custom-BAZzAR.css" rel="stylesheet" type="text/css"/>
    
    <script src="Bazzar-JQuery/jquery.min.js"></script>
    <script src="Bazzar-JQuery/bootstrap.min.js"></script>
	<script src="Bazzar-JQuery/custom-js.js"></script>
    
</head>

<body>
    
	<div class="container-fluid nopadding">
    	
        <!--Start Header-->
        <?php
			include('db_session.php');
			include('header.php');
		?>
        <!--END Header-->
    
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!------------- PHP for Compare Product Starts ------------->
<?php
if(isset($_GET['compare_id']))
{
	$q_compare = "SELECT * FROM product WHERE id='".$_GET['compare_id']."'";
	$q_compare_exe = mysql_query($q_compare);
	if($q_compare_exe)
	{
		$data_compare = mysql_fetch_array($q_compare_exe);
		$prod_name_1 = $data_compare['product_name'];
		$sale_price_1='$'.$data_compare['sale_price'];
		$shipping_cost_1 = '$'.$data_compare['shipping_cost'];
		$prod_discount_1 = $data_compare['product_discount'].'%';
		$product_tax_1 = $data_compare['product_tax'].'%';
		$product_color_1 = $data_compare['product_color'];
		$prod_desc_1 = $data_compare['product_description'];
	}
}
else
{
	$prod_name_1='N/A';
	$sale_price_1='N/A';
	$shipping_cost_1='N/A';
	$prod_discount_1='N/A';
	$product_tax_1='N/A';
	$product_color_1='N/A';
	$prod_desc_1='N/A';
}

if(isset($_GET['compare_id_2']))
{
	$q_compare_2 = "SELECT * FROM product WHERE id='".$_GET['compare_id_2']."'";
	$q_compare_exe_2 = mysql_query($q_compare_2);
	if($q_compare_exe_2)
	{
		$data_compare_2 = mysql_fetch_array($q_compare_exe_2);
		$prod_name_2 = $data_compare_2['product_name'];
		$sale_price_2 = '$'.$data_compare_2['sale_price'];
		$shipping_cost_2 = '$'.$data_compare_2['shipping_cost'];
		$prod_discount_2 = $data_compare_2['product_discount'].'%';
		$product_tax_2 = $data_compare_2['product_tax'].'%';
		$product_color_2 = $data_compare_2['product_color'];
		$prod_desc_2 = $data_compare_2['product_description'];
	}
}
else
{
	$prod_name_2='N/A';
	$sale_price_2='N/A';
	$shipping_cost_2='N/A';
	$prod_discount_2='N/A';
	$product_tax_2='N/A';
	$product_color_2='N/A';
	$prod_desc_2='N/A';
}

if(isset($_GET['compare_id_3']))
{
	$q_compare_3 = "SELECT * FROM product WHERE id='".$_GET['compare_id_3']."'";
	$q_compare_exe_3 = mysql_query($q_compare_3);
	if($q_compare_exe_3)
	{
		$data_compare_3 = mysql_fetch_array($q_compare_exe_3);
		$prod_name_3 = $data_compare_3['product_name'];
		$sale_price_3 = '$'.$data_compare_3['sale_price'];
		$shipping_cost_3 = '$'.$data_compare_3['shipping_cost'];
		$prod_discount_3 = $data_compare_3['product_discount'].'%';
		$product_tax_3 = $data_compare_3['product_tax'].'%';
		$product_color_3 = $data_compare_3['product_color'];
		$prod_desc_3 = $data_compare_3['product_description'];
	}
}
else
{
	$prod_name_3='N/A';
	$sale_price_3='N/A';
	$shipping_cost_3='N/A';
	$prod_discount_3='N/A';
	$product_tax_3='N/A';
	$product_color_3='N/A';
	$prod_desc_3='N/A';
}
?>
<!------------- PHP for Compare Product ENDs ------------->
		<div class="container main-container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                    <h3>Product Comparison</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                        	<table class="table compare">
                            	<tbody class="compare-detail">
                                	<tr class="first-row">
                                    	<td>Select Product</td>
                                        <td>
                                        	<form action="compare.php" method="get">
                                            <?php
											if(isset($_GET['compare_id_2'])){?>
                                            <input type="hidden" name="compare_id_2" value="<?php echo $_GET['compare_id_2'];?>">
											<?php 
												}
											?>
                                            <?php
											if(isset($_GET['compare_id_3'])){?>
                                            <input type="hidden" name="compare_id_3" value="<?php echo $_GET['compare_id_3'];?>">
											<?php
												}
												
											?>
                                        	<select name="compare_id" class="form-control" onChange="this.form.submit()">
                                            	<option selected disabled>-- Select an option --</option>
                                                <?php 
												$q_compare2 = "SELECT * FROM product WHERE sub_cat_id='".$data_compare['sub_cat_id']."'";
												$all_compare_exe = mysql_query($q_compare2);
												while($all_product = mysql_fetch_array($all_compare_exe)): ?>
                                                	<?php
														if($all_product['id']==$data_compare['id']){
															$select="selected";
														}
														else{
															$select="";
															}
													 ?>
                                        		<option value="<?php echo $all_product['id']; ?>" <?php echo $select; ?>><?php echo $all_product['product_name']; ?></option>
                                            
                                           <?php endwhile;?>
                                            </select>
                                            </form>
                                            <img src="vendor/images/product_pics/item_pic(<?php echo $data_compare['id']; ?>).<?php echo $data_compare['product_image']; ?>"/>
                                        </td>
                                        <td>
                                        	<form action="compare.php" method="get">
                                            <input type="hidden" name="compare_id" value="<?php echo $_GET['compare_id'];?>">
                                            <?php
											if(isset($_GET['compare_id_3'])){?>
                                            <input type="hidden" name="compare_id_3" value="<?php echo $_GET['compare_id_3'];?>">
											<?php
												$name="compare_id_2";$select2="";
												}
												else{$name="compare_id_2";$select2="";}
											?>
                                        	<select name="<?php echo $name; ?>" class="form-control" onChange="this.form.submit()">
                                            	<option selected disabled>-- Select an option --</option>
                                        <?php 
										$q_compare2 = "SELECT * FROM product WHERE sub_cat_id='".$data_compare['sub_cat_id']."'";
										$all_compare_exe = mysql_query($q_compare2);
										while($all_product = mysql_fetch_array($all_compare_exe)): ?>
                                        <?php
										if(isset($_GET['compare_id_2'])){
											
                                        if($all_product['id']==$data_compare_2['id']){
															$select2="selected";
														}
														else{$select2="";}
														
										}
										
                                        ?>
                                        <option value="<?php echo $all_product['id']; ?>" <?php echo $select2; ?>><?php echo $all_product['product_name']; ?></option>
                                            
                                           <?php endwhile;?>
                                           </select>
                                           </form>
                                           <?php 
                                           if(isset($_GET['compare_id_2'])){
											   ?>
                                            <img src="vendor/images/product_pics/item_pic(<?php echo $data_compare_2['id']; ?>).<?php echo $data_compare_2['product_image']; ?>"/>
                                            <?php }?>
                                        </td>
                                        <td>
                                        	<form action="compare.php" method="get">
                                            <input type="hidden" name="compare_id" value="<?php echo $_GET['compare_id'];?>">
                                            <?php
											if(isset($_GET['compare_id_2'])){?>
                                            <input type="hidden" name="compare_id_2" value="<?php echo $_GET['compare_id_2'];?>">
											<?php 
														
												$name="compare_id_3";$select3="";
												}
												else{$name="compare_id_3";$select3="";}
												
												
											?>
                                        	<select name="<?php echo $name; ?>" class="form-control" onChange="this.form.submit()">
                                            	<option selected disabled>-- Select an option --</option>
                                                <?php 
												$q_compare2 = "SELECT * FROM product WHERE sub_cat_id='".$data_compare['sub_cat_id']."'";
												$all_compare_exe = mysql_query($q_compare2);
												while($all_product = mysql_fetch_array($all_compare_exe)): ?>
                                                <?php 
												
												if(isset($_GET['compare_id_3'])){
														if($all_product['id']==$data_compare_3['id']){
															$select3="selected";
														}
														else{$select3="";}
													}
												?>
                                        		<option value="<?php echo $all_product['id']; ?>" <?php echo $select3; ?> ><?php echo $all_product['product_name']; ?></option>
                                           <?php endwhile;?>
                                            </select>
                                            </form>
                                            <?php 
                                            if(isset($_GET['compare_id_3'])){
												?>
                                            <img src="vendor/images/product_pics/item_pic(<?php echo $data_compare_3['id']; ?>).<?php echo $data_compare_3['product_image']; ?>"/>
                                            <?php }?>
                                        </td>
                                    </tr>
                                    <tr class="second-row">
                                    	<th>Product Name</th>
                                        <th><?php echo $prod_name_1;?></th>
                                        <th><?php echo $prod_name_2;?></th>
                                        <th><?php echo $prod_name_3;?></th>
                                    </tr>
                                    <tr class="heading-cell">
                                    	<th class="h4" colspan="4">Features</th>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Price</td>
                                        <td><?php echo $sale_price_1;?></td>
                                        <td><?php echo $sale_price_2;?></td>
                                        <td><?php echo $sale_price_3;?></td>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Shipping Cost</td>
                                        <td><?php echo $shipping_cost_1;?></td>
                                        <td><?php echo $shipping_cost_2;?></td>
                                        <td><?php echo $shipping_cost_3;?></td>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Product Discount</td>
                                        <td><?php echo $prod_discount_1;?></td>
                                        <td><?php echo $prod_discount_2;?></td>
                                        <td><?php echo $prod_discount_3;?></td>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Product Tax</td>
                                        <td><?php echo $product_tax_1;?></td>
                                        <td><?php echo $product_tax_2;?></td>
                                        <td><?php echo $product_tax_3;?></td>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Product Color</td>
                                        <td><?php echo $product_color_1;?></td>
                                        <td><?php echo $product_color_2;?></td>
                                        <td><?php echo $product_color_3;?></td>
                                    </tr>
                                    <tr class="detail-cell">
                                    	<td>Product Color</td>
                                        <td><?php echo $prod_desc_1;?></td>
                                        <td><?php echo $prod_desc_2;?></td>
                                        <td><?php echo $prod_desc_3;?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

        <!--Start Footer-->
		<?php
			include('footer.php');
		?>
        <!--END Footer-->
        
    </div>

</body>
</html>