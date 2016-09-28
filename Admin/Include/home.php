<?php
function home()
{?>
	<div class="page-title">
		<h1 class="text-overflow">Dashboard</h1>
    </div>
    
    <!--------------------------24 Hour State---------------------------->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4 ">
            	<div class="info-box1">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <p>24 Hour Stock</p>
                            </div>
                        </div>
                         <div class="panel-body">
                        	<div class="text-center">
                                <img src="images/download.png" height="62" width="269" style="width: 300px; height: 70px;" />
                                <p class="h4">
                                    <span class="label label-red">$</span>
                                    <span id="gauge1-txt" class="label label-red">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="info-box2">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <p>24 Hour Sale</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        	<div class="text-center">
                                <img src="images/download.png" height="62" width="269" style="width: 300px; height: 70px;" />
                                <p class="h4">
                                    <span class="label label-black">$</span>
                                    <span id="gauge1-txt" class="label label-black">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            	<div class="info-box3">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <p>24 Hour Destroy</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        	<div class="text-center">
                                <img src="images/download.png" height="62" width="269" style="width: 300px; height: 70px;" />
                                <p class="h4">
                                    <span class="label label-black">$</span>
                                    <span id="gauge1-txt" class="label label-black">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
    
    <!--------------------------Vendor State---------------------------->
    <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-4">
            	<div class="info-box2">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Total Vendors</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
                <div class="info-box2">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Pending Vendors</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
            	<div class="info-box-big">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Vendor Statistics</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--------------------------Map State---------------------------->
    <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-6">
            	<div class="info-box3">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Pending Order Map</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        	<div>
                        	<!--Start Google-Map-->
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
                			<!--END Google-Map-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            	<div class="info-box2">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Present customer Live On Your Store</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--------------------------Category Wise State---------------------------->
     <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-6">
            	<div class="info-box1">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Category Wise Monthly Stock</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            	<div class="info-box2">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Category wise Monthly Sale</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
        	<div class="col-sm-6">
            	<div class="info-box2">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Category Wise Monthly Destroy</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            	<div class="info-box1">
                	<div class="panel">
                    	<div class="panel-heading">
                        	<div class="panel-title">
                            	<p>Category Wise Monthly Grand Profit</p>
                            </div>
                        </div>
                        <div class="panel-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>