    <!--Start black-header-->
        <div id="scrolling" class="black-header">
            <div class="container">
                <div class="row">
                    <div class=" col-md-5 col-sm-4 col-xs-12 currency">
                        <a href="#" class="active">USD</a>
                        <a href="#">PKR</a>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-12">
                        <ul class="list-inline nomargin">
                            <li id="account">
                            	<?php
									if(isset($_SESSION['id']) || isset($_SESSION['v_id']))
									{
										echo '<a style="cursor:pointer;">Hello! '.$_SESSION['first_name'].'</a>';
									?>
                                        <ul class="dropdown list-unstyled">
                                            <?php
                                                if(isset($_SESSION['type_vd']))
                                                {
                                                    echo '<li><a href="vendor/index.php">Profile</a></li>';
                                                }
                                                else
                                                {
                                                    echo '<li><a href="user_profile.php">Profile</a></li>';
                                                }
                                            ?>
                                            <li><a href="login-form.php?user=logout">Logout</a></li>
                                            <hr>
                                            <?php
                                                if(isset($_SESSION['type_vd']))
                                                {
                                                    echo '<li><a href="login-form.php">Sign In / Register</a></li>';
                                                }
                                                else
                                                {
                                                    echo '<li><a href="signup-form.php">Business Account</a></li>';
                                                }
                                            ?>
                                        </ul>
                                    <?php
									}
									else
									{
									?>
										<a style="cursor:pointer">CREATE ACCOUNT</a>
                                        <ul class="dropdown list-unstyled">
                                            <li><a href="login-form.php">Sign In / Register</a></li>
                                            <li><a href="signup-form.php">Business Account</a></li>
                                        </ul>
									<?php
                                    }
								?>
                            </li>
                            <li><a href="compare.php">COMPARE</a></li>
                            <li><a href="#">CART</a></li>
                            <li><a href="#">CHECKOUT</a></li>
                            <?php
                            	if(!isset($_SESSION['id']) && !isset($_SESSION['v_id']))
								{
									echo '<li><a href="login-form.php">LOG IN</a></li>';
								}
							?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <!--END black-header-->
    
    <!--Start header-->
        <div class="container ht">
            <div class="row head">
                <div class="col-md-5 col-sm-12 col-xs-12 logo">
                    <a href="index.php" title="BAZzAR">
                    	<img src="images/logo-2.png" height="80px"/>
                    </a>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12" style="margin-top:17px">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 search-prod nopadding">
                            <div>
                                <form>
                                    <div class="input-group input-group-lg">
                                        <input type="search" class="form-control" placeholder="Find a product...">
                                        <span class="input-group-btn">
                                        	<button type="submit" class="btn btn-default submit-btn"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
								<?php 
                                if(isset($_SESSION["products"])){
                                    $pro=count($_SESSION["products"]); 
                                }else{
                                    $pro=0; 
                                }
                                ?>
                            <a href="#/" class="shopping-cart cart-box">
                            	<i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOPPING CART<span class="badge cart-box" id="cart-info"><?php echo $pro; ?></span>
                            </a>
                                
                                </div>
                            <div class="shopping-content shopping-cart-box">
                                <a href="#" class="close-shopping-cart-box" >Close</a>
                                <h3>Your Shopping Cart</h3>
                                    <div id="shopping-cart-results">
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--END header-->
    
    <!--Start Navbar-->
        <nav class="navbar navbar-default nomargin" id="nav">
            <div class="container">
                
                <!--Start menu button-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#btn-navbar-dropdown" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!--END menu button-->
                
                <div class="navbar-collapse collapse" id="btn-navbar-dropdown">
                    <ul class="nav navbar-nav">
                        <li class="<?php if(!isset($_GET['main_cat_id'])){echo 'active';} ?>"><a href="index.php">HOME</a></li>
                        <!------------------------ PHP Category Loading Start  ------------------------>
                        <?php
                        db();
						$query = "SELECT id, main_cat_name FROM main_category LIMIT 5";
						$exe = mysql_query($query);
						if($exe)
						{
							while($row = mysql_fetch_array($exe))
							{?>
								<li class="<?php if(isset($_GET['main_cat_id']) && $_GET['main_cat_id']==$row['id']){echo 'active';} ?>">
                                	<a href="index.php?main_cat_id=<?php echo $row["id"]; ?>">
										<?php echo $row['main_cat_name']; ?> <span class="caret"></span>
                                    </a>
                                    <div class="dropdown main-drop">
                                        <ul class="list-unstyled">
                                        <?php
                                        $cat_q = "SELECT * FROM category WHERE main_cat_id='".$row["id"]."'";
										$cat_exe = mysql_query($cat_q);
										if($cat_exe)
										{
											while($cat_row = mysql_fetch_array($cat_exe))
											{?>
												<li><a href="index.php?cat_id=<?php echo $cat_row["id"]; ?>"><?php echo $cat_row["cat_name"]; ?></a></li>
											<?php
                                            }
										}
										else
										{
											echo mysql_error();
										}
										?>
                                        </ul>
                                    </div>
                                </li>
							<?php
                            }
						}
						else
						{
							echo mysql_error();
						}
						?>
                        <!------------------------ PHP Category Loading END  ------------------------>
                       
                        <li id="categories" class="<?php  ?>"><a href="#">All Categories <span class="caret"></span></a>
                            <!--Start CATEGORIES dropdown-->
                            <div class="dropdown categories-dropdown main-drop">
                                <ul class="list-unstyled">
                                    <?php
                                    $all_q = "SELECT * FROM main_category";
									$all_exe = mysql_query($all_q);
									if($all_exe)
									{
										while($all_row = mysql_fetch_array($all_exe))
										{?>
											<li>
                                            	<a href="index.php?main_cat_id=<?php echo $all_row["id"]; ?>"><?php echo $all_row["main_cat_name"]; ?></a>
                                                <div class="dropdown subdrop">
                                                    <ul class="list-unstyled">
                                                        <?php
														$allsub_q = "SELECT * FROM category WHERE main_cat_id='".$all_row["id"]."'";
														$allsub_exe = mysql_query($allsub_q);
														if($allsub_exe)
														{
															while($allsub_row = mysql_fetch_array($allsub_exe))
															{?>
																<li><a href="index.php?cat_id=<?php echo $allsub_row["id"]; ?>"><?php echo $allsub_row["cat_name"]; ?></a></li>
															<?php
															}
														}
														else
														{
															echo mysql_error();
														}
														?>
                                                    </ul>
                                                </div>
                                            </li>
										<?php
                                        }
									}
									else
									{
										echo mysql_error();
									}
									?>
                                </ul>
                            </div>
                            <!--END CATEGORIES dropdown-->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!--END Navbar-->