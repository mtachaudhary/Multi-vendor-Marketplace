<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign-Up | BAZzAR</title>
    <link rel="icon" href="images/fav-icon.png" />
    
    <link rel="stylesheet" href="Bazzar-CSS/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="Bazzar-CSS/jquery-ui.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="Bazzar-CSS/custom-BAZzAR.css" type="text/css"/>
    <link rel="stylesheet" href="Bazzar-CSS/signup-form.css" type="text/css"/>
    
    <script src="Bazzar-JQuery/jquery.min.js" type="text/javascript"></script>
    <script src="Bazzar-JQuery/bootstrap.min.js" type="text/javascript"></script>
    <script src="Bazzar-JQuery/jquery-ui.min.js" type="text/javascript"></script>
    <script src="Bazzar-JQuery/signup-form.js" type="text/javascript"></script>
    <script src="Bazzar-JQuery/custom-js.js" type="text/javascript"></script>
    
    <style>
    	.first-footer { display:none;}
		footer { border-top:none;}
    </style>
</head>

<body>
	<div class="container-fluid nopadding">
        
        <!--Start PHP-->
        <?php
			include('db_session.php');
			db();
			if(isset($_GET['vendor']))
			{
				if($_GET['vendor']=='register')
				{
					register();
				}
			}
			
			function register()
			{
				db();
				$country = $_POST['country'];
				$b_name = $_POST['bname'];
				$b_addr = $_POST['baddress'];
				$b_city = $_POST['bcity'];
				$b_state = $_POST['bstate'];
				$b_phone = $_POST['bphone'];
				$b_zip = $_POST['bzip'];
				
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$email = $_POST['email'];
				$pswd = $_POST['password'];
				$p_addr = $_POST['paddress'];
				$p_city = $_POST['pcity'];
				$p_state = $_POST['pstate'];
				$p_phone = $_POST['pphone'];
				$p_zip = $_POST['pzip'];
				
				$payment = $_POST['payment-type'];
				$card_nmbr = $_POST['card_number'];
				$security_number = $_POST['security_number'];
				$exp_date = $_POST['exp-date'];
				$type_vd = $_POST['vendor'];
				
				$query = "INSERT INTO register_vendor (country, business_name, business_address, business_city, business_state, business_phone, business_zip, f_name, l_name, email, password, personal_address, personal_city, personal_state, personal_phone, personal_zip, payment_type, card_number, security_code, expiration_date, type) VALUES('$country','$b_name','$b_addr','$b_city','$b_state','$b_phone','$b_zip','$fname','$lname','$email','$pswd','$p_addr','$p_city','$p_state','$p_phone','$p_zip','$payment','$card_nmbr','$security_number','$exp_date','$type_vd')";
				$exe = mysql_query($query);
				if($exe)
				{
					echo '<script>alert("Vendor registered succseefully!");</script>';
					echo'<script>window.location="login-form.php";</script>';
				}
				else
				{
					echo mysql_error();
				}
			}
			
			//Start Header
			include('header.php');
			//END Header
        ?>
        <!--END PHP-->
        
        <div class="sign-up-bg">
            <div class="container">
            	<!---------------------- Steps-Wizard Header Start ---------------------->
            	<div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-6 col-sm-offset-4 stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                <p>Basic Account Info</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                <p>Personal Detail</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                <p>Payment Method</p>
                            </div>
                        </div>
                    </div>
                </div>
            	<!---------------------- Steps-Wizard Header End ---------------------->
            
            	<!---------------------- Form Starts Here ---------------------->   
				<form role="form" action="signup-form.php?vendor=register" method="post">
              
              		<!---------------------- First Step Starts Here ---------------------->
                	<div class="row setup-content" id="step-1">
                    	<div class="form-box-sign-up gradient col-md-6 col-sm-8 col-xs-12 col-md-offset-6 col-sm-offset-4">
                        	<div class="col-md-12">
                            	<h3>Account</h3>
                            	<h5>Basic Account Info</h5>
                            	<div class="form-group">
                                	<label class="control-label">Country</label>
                                	<select class="form-control custom" name="country" id="country">
                                        <option value="AFG">Afghanistan</option>
                                        <option value="ALA">Åland Islands</option>
                                        <option value="ALB">Albania</option>
                                        <option value="DZA">Algeria</option>
                                        <option value="ASM">American Samoa</option>
                                        <option value="AND">Andorra</option>
                                        <option value="AGO">Angola</option>
                                        <option value="AIA">Anguilla</option>
                                        <option value="ATA">Antarctica</option>
                                        <option value="ATG">Antigua and Barbuda</option>
                                        <option value="ARG">Argentina</option>
                                        <option value="ARM">Armenia</option>
                                        <option value="ABW">Aruba</option>
                                        <option value="AUS">Australia</option>
                                        <option value="AUT">Austria</option>
                                        <option value="AZE">Azerbaijan</option>
                                        <option value="BHS">Bahamas</option>
                                        <option value="BHR">Bahrain</option>
                                        <option value="BGD">Bangladesh</option>
                                        <option value="BRB">Barbados</option>
                                        <option value="BLR">Belarus</option>
                                        <option value="BEL">Belgium</option>
                                        <option value="BLZ">Belize</option>
                                        <option value="BEN">Benin</option>
                                        <option value="BMU">Bermuda</option>
                                        <option value="BTN">Bhutan</option>
                                        <option value="BOL">Bolivia, Plurinational State of</option>
                                        <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="BIH">Bosnia and Herzegovina</option>
                                        <option value="BWA">Botswana</option>
                                        <option value="BVT">Bouvet Island</option>
                                        <option value="BRA">Brazil</option>
                                        <option value="IOT">British Indian Ocean Territory</option>
                                        <option value="BRN">Brunei Darussalam</option>
                                        <option value="BGR">Bulgaria</option>
                                        <option value="BFA">Burkina Faso</option>
                                        <option value="BDI">Burundi</option>
                                        <option value="KHM">Cambodia</option>
                                        <option value="CMR">Cameroon</option>
                                        <option value="CAN">Canada</option>
                                        <option value="CPV">Cape Verde</option>
                                        <option value="CYM">Cayman Islands</option>
                                        <option value="CAF">Central African Republic</option>
                                        <option value="TCD">Chad</option>
                                        <option value="CHL">Chile</option>
                                        <option value="CHN">China</option>
                                        <option value="CXR">Christmas Island</option>
                                        <option value="CCK">Cocos (Keeling) Islands</option>
                                        <option value="COL">Colombia</option>
                                        <option value="COM">Comoros</option>
                                        <option value="COG">Congo</option>
                                        <option value="COD">Congo, the Democratic Republic of the</option>
                                        <option value="COK">Cook Islands</option>
                                        <option value="CRI">Costa Rica</option>
                                        <option value="CIV">Côte d'Ivoire</option>
                                        <option value="HRV">Croatia</option>
                                        <option value="CUB">Cuba</option>
                                        <option value="CUW">Curaçao</option>
                                        <option value="CYP">Cyprus</option>
                                        <option value="CZE">Czech Republic</option>
                                        <option value="DNK">Denmark</option>
                                        <option value="DJI">Djibouti</option>
                                        <option value="DMA">Dominica</option>
                                        <option value="DOM">Dominican Republic</option>
                                        <option value="ECU">Ecuador</option>
                                        <option value="EGY">Egypt</option>
                                        <option value="SLV">El Salvador</option>
                                        <option value="GNQ">Equatorial Guinea</option>
                                        <option value="ERI">Eritrea</option>
                                        <option value="EST">Estonia</option>
                                        <option value="ETH">Ethiopia</option>
                                        <option value="FLK">Falkland Islands (Malvinas)</option>
                                        <option value="FRO">Faroe Islands</option>
                                        <option value="FJI">Fiji</option>
                                        <option value="FIN">Finland</option>
                                        <option value="FRA">France</option>
                                        <option value="GUF">French Guiana</option>
                                        <option value="PYF">French Polynesia</option>
                                        <option value="ATF">French Southern Territories</option>
                                        <option value="GAB">Gabon</option>
                                        <option value="GMB">Gambia</option>
                                        <option value="GEO">Georgia</option>
                                        <option value="DEU">Germany</option>
                                        <option value="GHA">Ghana</option>
                                        <option value="GIB">Gibraltar</option>
                                        <option value="GRC">Greece</option>
                                        <option value="GRL">Greenland</option>
                                        <option value="GRD">Grenada</option>
                                        <option value="GLP">Guadeloupe</option>
                                        <option value="GUM">Guam</option>
                                        <option value="GTM">Guatemala</option>
                                        <option value="GGY">Guernsey</option>
                                        <option value="GIN">Guinea</option>
                                        <option value="GNB">Guinea-Bissau</option>
                                        <option value="GUY">Guyana</option>
                                        <option value="HTI">Haiti</option>
                                        <option value="HMD">Heard Island and McDonald Islands</option>
                                        <option value="VAT">Holy See (Vatican City State)</option>
                                        <option value="HND">Honduras</option>
                                        <option value="HKG">Hong Kong</option>
                                        <option value="HUN">Hungary</option>
                                        <option value="ISL">Iceland</option>
                                        <option value="IND">India</option>
                                        <option value="IDN">Indonesia</option>
                                        <option value="IRN">Iran, Islamic Republic of</option>
                                        <option value="IRQ">Iraq</option>
                                        <option value="IRL">Ireland</option>
                                        <option value="IMN">Isle of Man</option>
                                        <option value="ISR">Israel</option>
                                        <option value="ITA">Italy</option>
                                        <option value="JAM">Jamaica</option>
                                        <option value="JPN">Japan</option>
                                        <option value="JEY">Jersey</option>
                                        <option value="JOR">Jordan</option>
                                        <option value="KAZ">Kazakhstan</option>
                                        <option value="KEN">Kenya</option>
                                        <option value="KIR">Kiribati</option>
                                        <option value="PRK">Korea, Democratic People's Republic of</option>
                                        <option value="KOR">Korea, Republic of</option>
                                        <option value="KWT">Kuwait</option>
                                        <option value="KGZ">Kyrgyzstan</option>
                                        <option value="LAO">Lao People's Democratic Republic</option>
                                        <option value="LVA">Latvia</option>
                                        <option value="LBN">Lebanon</option>
                                        <option value="LSO">Lesotho</option>
                                        <option value="LBR">Liberia</option>
                                        <option value="LBY">Libya</option>
                                        <option value="LIE">Liechtenstein</option>
                                        <option value="LTU">Lithuania</option>
                                        <option value="LUX">Luxembourg</option>
                                        <option value="MAC">Macao</option>
                                        <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                                        <option value="MDG">Madagascar</option>
                                        <option value="MWI">Malawi</option>
                                        <option value="MYS">Malaysia</option>
                                        <option value="MDV">Maldives</option>
                                        <option value="MLI">Mali</option>
                                        <option value="MLT">Malta</option>
                                        <option value="MHL">Marshall Islands</option>
                                        <option value="MTQ">Martinique</option>
                                        <option value="MRT">Mauritania</option>
                                        <option value="MUS">Mauritius</option>
                                        <option value="MYT">Mayotte</option>
                                        <option value="MEX">Mexico</option>
                                        <option value="FSM">Micronesia, Federated States of</option>
                                        <option value="MDA">Moldova, Republic of</option>
                                        <option value="MCO">Monaco</option>
                                        <option value="MNG">Mongolia</option>
                                        <option value="MNE">Montenegro</option>
                                        <option value="MSR">Montserrat</option>
                                        <option value="MAR">Morocco</option>
                                        <option value="MOZ">Mozambique</option>
                                        <option value="MMR">Myanmar</option>
                                        <option value="NAM">Namibia</option>
                                        <option value="NRU">Nauru</option>
                                        <option value="NPL">Nepal</option>
                                        <option value="NLD">Netherlands</option>
                                        <option value="NCL">New Caledonia</option>
                                        <option value="NZL">New Zealand</option>
                                        <option value="NIC">Nicaragua</option>
                                        <option value="NER">Niger</option>
                                        <option value="NGA">Nigeria</option>
                                        <option value="NIU">Niue</option>
                                        <option value="NFK">Norfolk Island</option>
                                        <option value="MNP">Northern Mariana Islands</option>
                                        <option value="NOR">Norway</option>
                                        <option value="OMN">Oman</option>
                                        <option value="PAK" selected>Pakistan</option>
                                        <option value="PLW">Palau</option>
                                        <option value="PSE">Palestinian Territory, Occupied</option>
                                        <option value="PAN">Panama</option>
                                        <option value="PNG">Papua New Guinea</option>
                                        <option value="PRY">Paraguay</option>
                                        <option value="PER">Peru</option>
                                        <option value="PHL">Philippines</option>
                                        <option value="PCN">Pitcairn</option>
                                        <option value="POL">Poland</option>
                                        <option value="PRT">Portugal</option>
                                        <option value="PRI">Puerto Rico</option>
                                        <option value="QAT">Qatar</option>
                                        <option value="REU">Réunion</option>
                                        <option value="ROU">Romania</option>
                                        <option value="RUS">Russian Federation</option>
                                        <option value="RWA">Rwanda</option>
                                        <option value="BLM">Saint Barthélemy</option>
                                        <option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="KNA">Saint Kitts and Nevis</option>
                                        <option value="LCA">Saint Lucia</option>
                                        <option value="MAF">Saint Martin (French part)</option>
                                        <option value="SPM">Saint Pierre and Miquelon</option>
                                        <option value="VCT">Saint Vincent and the Grenadines</option>
                                        <option value="WSM">Samoa</option>
                                        <option value="SMR">San Marino</option>
                                        <option value="STP">Sao Tome and Principe</option>
                                        <option value="SAU">Saudi Arabia</option>
                                        <option value="SEN">Senegal</option>
                                        <option value="SRB">Serbia</option>
                                        <option value="SYC">Seychelles</option>
                                        <option value="SLE">Sierra Leone</option>
                                        <option value="SGP">Singapore</option>
                                        <option value="SXM">Sint Maarten (Dutch part)</option>
                                        <option value="SVK">Slovakia</option>
                                        <option value="SVN">Slovenia</option>
                                        <option value="SLB">Solomon Islands</option>
                                        <option value="SOM">Somalia</option>
                                        <option value="ZAF">South Africa</option>
                                        <option value="SGS">South Georgia and the South Sandwich Islands</option>
                                        <option value="SSD">South Sudan</option>
                                        <option value="ESP">Spain</option>
                                        <option value="LKA">Sri Lanka</option>
                                        <option value="SDN">Sudan</option>
                                        <option value="SUR">Suriname</option>
                                        <option value="SJM">Svalbard and Jan Mayen</option>
                                        <option value="SWZ">Swaziland</option>
                                        <option value="SWE">Sweden</option>
                                        <option value="CHE">Switzerland</option>
                                        <option value="SYR">Syrian Arab Republic</option>
                                        <option value="TWN">Taiwan, Province of China</option>
                                        <option value="TJK">Tajikistan</option>
                                        <option value="TZA">Tanzania, United Republic of</option>
                                        <option value="THA">Thailand</option>
                                        <option value="TLS">Timor-Leste</option>
                                        <option value="TGO">Togo</option>
                                        <option value="TKL">Tokelau</option>
                                        <option value="TON">Tonga</option>
                                        <option value="TTO">Trinidad and Tobago</option>
                                        <option value="TUN">Tunisia</option>
                                        <option value="TUR">Turkey</option>
                                        <option value="TKM">Turkmenistan</option>
                                        <option value="TCA">Turks and Caicos Islands</option>
                                        <option value="TUV">Tuvalu</option>
                                        <option value="UGA">Uganda</option>
                                        <option value="UKR">Ukraine</option>
                                        <option value="ARE">United Arab Emirates</option>
                                        <option value="GBR">United Kingdom</option>
                                        <option value="USA">United States</option>
                                        <option value="UMI">United States Minor Outlying Islands</option>
                                        <option value="URY">Uruguay</option>
                                        <option value="UZB">Uzbekistan</option>
                                        <option value="VUT">Vanuatu</option>
                                        <option value="VEN">Venezuela, Bolivarian Republic of</option>
                                        <option value="VNM">Viet Nam</option>
                                        <option value="VGB">Virgin Islands, British</option>
                                        <option value="VIR">Virgin Islands, U.S.</option>
                                        <option value="WLF">Wallis and Futuna</option>
                                        <option value="ESH">Western Sahara</option>
                                        <option value="YEM">Yemen</option>
                                        <option value="ZMB">Zambia</option>
                                        <option value="ZWE">Zimbabwe</option>
                                </select>
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Business Name</label>
                                	<input name="bname" type="text" required class="form-control" placeholder="Enter Business Name" />
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Business Address</label>
                                	<input maxlength="100" name="baddress" type="text" required class="form-control" placeholder="Enter Business Address" />
                            	</div>
                            	<div class="form-group col-sm-5 col-xs-12 no-padding">
                                	<label class="control-label">City</label>
                                	<input maxlength="100" name="bcity" type="text" required class="form-control" placeholder="Business City" />
                            	</div>
                            	<div class="form-group col-sm-5 col-sm-offset-2 col-xs-12 pull-right no-padding">
                                	<label class="control-label">State</label>
                                	<input maxlength="100" name="bstate" type="text" required class="form-control" placeholder="Business State" />
                            	</div>
                            	<div class="form-group col-sm-5 col-xs-12 no-padding">
                                	<label class="control-label">Phone Number</label>
                                	<input maxlength="100" name="bphone" type="tel" required class="form-control" placeholder="Business Phone Number" />
                            	</div>
                            	<div class="form-group col-sm-5 col-sm-offset-2 col-xs-12 pull-right no-padding">
                                	<label class="control-label">Zip</label>
                                	<input maxlength="100" name="bzip" type="text" required class="form-control" placeholder="Postal Code" />
                            	</div>
                            	<button class="btn btn-primary nextBtn btn-lg pull-right" name="next" type="button">Next</button>
                            </div>
                        </div>
                	</div>
              		<!----------------------First Step Ends Here---------------------->
              
              		<!----------------------2nd Step Starts Here---------------------->  
                	<div class="row setup-content" id="step-2">
                    	<div class="form-box-sign-up gradient col-md-6 col-sm-8 col-xs-12 col-md-offset-6 col-sm-offset-4">
                    		<div class="col-md-12">
                        		<h3>Personal</h3>
                        		<h5>Personal Details</h5>
                        		<div class="form-group">
                                	<label class="control-label">First Name</label>
                                	<input  maxlength="100" type="text" name="fname" required class="form-control" placeholder="Enter First Name" />
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Last Name</label>
                                	<input maxlength="100" type="text" name="lname" required class="form-control" placeholder="Enter Last Name" />
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">E-mail</label>
                                	<input maxlength="100" type="email" name="email" required class="form-control" placeholder="Enter E-Mail"/>
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Password</label>
                                	<input maxlength="100" type="password" name="password" required class="form-control" placeholder="Enter Password" />
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Confirm Password</label>
                                	<input maxlength="100" type="password" name="password" required class="form-control" placeholder="Confirm Password" />
                            	</div>
                            	<div class="form-group">
                                	<label class="control-label">Personal Address</label>
                                	<input maxlength="100" type="text" name="paddress" required class="form-control" placeholder="Your Personal Address" />
                            	</div>
                            	<div class="form-group col-sm-5 col-xs-12 no-padding">
                                	<label class="control-label">City</label>
                                	<input maxlength="100" type="text" name="pcity" required class="form-control" placeholder="Your City" />
                            	</div>
                            	<div class="form-group col-sm-5 col-sm-offset-2 col-xs-12 pull-right no-padding">
                                	<label class="control-label">State</label>
                                	<input maxlength="100" type="text" name="pstate" required class="form-control" placeholder="Your State" />
                            	</div>
                            	<div class="form-group col-sm-5 col-xs-12 no-padding">
                                	<label class="control-label">Phone Number</label>
                                	<input maxlength="100" type="tel" name="pphone" required class="form-control" placeholder="Personal Phone Number" />
                            	</div>
                            	<div class="form-group col-sm-5 col-xs-12 col-sm-offset-2 pull-right no-padding">
                                	<label class="control-label">Zip</label>
                                	<input maxlength="100" type="text" name="pzip" required class="form-control" placeholder="Postal Code" />
                            	</div>
                        		<button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    		</div>
              			</div>
                	</div>
              		<!----------------------2nd Step Ends Starts Here---------------------->
              
              		<!----------------------3rd Step Starts Here---------------------->      
                	<div class="row setup-content" id="step-3">
                    	<div class="form-box-sign-up gradient col-md-6 col-sm-8 col-xs-12 col-md-offset-6 col-sm-offset-4">
                        	<div class="col-md-12">
                                <h3>Payment Method</h3>
                                <div class="form-group">
                                    <label class="control-label">Select Payment Type</label>
                                    <select name="payment-type" class="form-control">
                                        <option value="skrill">Skrill</option>
                                        <option value="stripe" selected>Stripe</option>
                                        <option value="credit or debit card">Credit or Debit card</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="float:left">Card Number</label>
                                    <i class="card" style="float:left">
                                        <ul class="list-inline">
                                            <li><img src="images/Form/Visa.png" width="40" /></li>
                                            <li><img src="images/Form/Mastercard.png" width="40" /></li>
                                        </ul>
                                    </i>
                                    <input type="text" name="card_number" placeholder="Card Number" class="form-control" />
                                </div>
                                <div class="form-group col-sm-12 no-padding">
                                    <label class="control-label" style="float:left">Security Code</label>
                                    <i class="card" style="float:left">
                                        <ul class="list-inline">
                                            <li><img src="images/Form/security.png" width="40" /></li>
                                            <li><img src="images/Form/security1.png" width="40" /></li>
                                        </ul>
                                    </i>
                                    <input type="text" name="security_number" placeholder="Security Code" class="form-control" style="clear:right" />
                                </div>
                                <div class="col-sm-12 no-padding form-group">
                                	<script>
										$(function() {
											$("#datepicker").datepicker();
										});
									</script>
                                	<label class="control-label col-sm-12 no-padding pull-left">Expiration Date</label>
                                    <input type="text" id="datepicker" name="exp-date" placeholder="Expiration Date" class="form-control" />
                                </div>
                                <input type="hidden" name="vendor" value="vendor"/>
                            	<button class="btn btn-success btn-lg pull-right" type="submit" style="clear:both">Submit</button>
                        	</div>
                    	</div>
                	</div>
              		<!----------------------3rd Step Starts Here----------------------> 
                 
          		</form>
            	<!----------------------Form Ends Here---------------------->
            </div>
        </div>
	</div>
    
  	<!--Start Footer-->
	<?php
        include('footer.php');
    ?>
    <!--END Footer-->
</body>
</html>
