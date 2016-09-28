<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact | BAZzAR</title>
<link rel="icon" href="images/fav-icon.png" />

<link rel="stylesheet" type="text/css" href="Bazzar-CSS/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="Bazzar-CSS/custom-BAZzAR.css" />

<script type="text/javascript" src="Bazzar-JQuery/jquery.min.js"></script>
<script type="text/javascript" src="Bazzar-JQuery/bootstrap.min.js"></script>
<script type="text/javascript" src="Bazzar-JQuery/custom-js.js"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>
</head>

<body>
	<div class="container-fluid no-padding">
    
     	<!--Start Header-->
        <?php
            include('db_session.php');
			include('header.php');
        ?>
        <!--END Footer-->
    
    	<div class="container contact-us main-container">
        	<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 feat-prod">
                    <h3>Contact Us</h3>
                </div>
            </div>
        	<div class="row">
                
                <!--Start Store Information-->
                <div class="col-sm-5 col-xs-12">
                	<h2>Store Information</h2>
                    <p>We deal with any type of product in the world.</p>
                    <ul class="list-unstyled cnt-ico">
                    	<li>
                        	<div>
                            	<i class="ico fa fa-map-marker"></i>
                                <span class="adre">
                                	<strong>Address:</strong> 
                                	Haq Bahoo Hostle, Jhang Road Faisalabad.
                                </span>
                            </div>
                        </li>
                        <li>
                        	<div>
                            	<i class="ico fa fa-phone"></i>
                                <span>
                                    <strong>Phone:</strong>
                                    +92 3216097060 | +92 3347754775
                                </span>
                            </div>
                        </li>
                        <li>
                        	<div>
                                <i class="ico fa fa-envelope"></i>
                                <span>
                                	<strong>E-mail:</strong>
                                	<span class="email">usman2329@outlook.com</span>
                                    |
                                    <span class="email">tayyab.chaudhary786@gmail.com</span>
                                </span>
                            </div>   	
                        </li>
                    </ul>
                </div>
                <!--END Store Information-->
                
                <!--Start Google-Map-->
                <div class="col-sm-7 col-xs-12" style="padding-top:20px">
                	<script>
						var myCenter=new google.maps.LatLng(31.42, 73.08);
						var marker;
						
						function initialize() {
						  var mapProp = {
							center:myCenter,
							zoom:10,
							mapTypeId:google.maps.MapTypeId.ROADMAP
						  };
						  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
						  var marker=new google.maps.Marker({
							  position:myCenter,
							  animation:google.maps.Animation.BOUNCE
							  });
						marker.setMap(map);
						
						var infowindow = new google.maps.InfoWindow({
						  content:"BaZzar Is Here"
						  });
						
						google.maps.event.addListener(marker, 'click', function() {
						  infowindow.open(map,marker);
						  });
						
						google.maps.event.addListener(map,'center_changed',function() {
						// 3 seconds after the center of the map has changed, pan back to the marker
						  window.setTimeout(function() {
							map.panTo(marker.getPosition());
						  },3000);
						  });
						}
						google.maps.event.addDomListener(window, 'load', initialize);
					</script>
                	<div id="googleMap" style="width:100%; height:250px;"></div>
                </div>
                <!--END Google-Map-->
                
            </div>
            
            <!--Start Contact Form-->
            <div class="row">
                <div class="col-md-12">
                	<h3>Contact Form</h3>
                    <form action="" method="post" class="contact-form">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control input-lg" required/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">E-mail</label>
                                    <input type="email" name="name" id="name" placeholder="Enter Email" class="form-control input-lg" required/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Subject</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Subject" class="form-control input-lg" required/>
                                </div>  
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="control-label" for="">Message</label>
                                    <textarea cols="10" rows="9" class="form-control" style="resize:vertical; margin-left:0"></textarea>
                                </div>
                                <button type="submit" value="" class="btn pull-right">Send mail <i class="fa fa-angle-double-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--END Contact Form-->
            
        </div>
    </div>
    
    <!--Start Footer-->
    <?php
    	include('footer.php');
    ?>
    <!--END Footer-->
    
</body>
</html>
