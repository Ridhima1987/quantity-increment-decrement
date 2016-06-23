<?php include_once'inc/autoload.php'; if(isset($_GET['view'])){ $PageView = $paopack->GetPageView($_GET['view']); if($PageView=="PaopackSearchProduct"){ $Key = $paopack->GetPageView($_GET['key']); $Products = json_decode($paopack->PaopackFoundProducts($Key));} }   ?>

<!doctype html>
<html class="no-js" lang="">
<title>cheapest grocery website</title>
    <head>
<meta name="description" content="all your monthely kitchen needs">
<meta name="description" content="cheep women cosmetic products">

<link rel="shortcut icon" type="image/png" href="images/p_paopack.png"/>
    	<title>Paopack - Fresh Market</title>
    	
        <?php $layout->HeaderFiles(); ?>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('#MessageTxt').delay(2000).fadeOut('slow');
                $(".hamburger i").click(function(){
                    $(".sub_nav_bar").slideToggle(700);
                    return false;
                });
               $("#show_location_popup").click(function(){
                    $("#loaction_popup").show();
                });
                $(".fa-times,#skip_popup").click(function(){
                    $("#loaction_popup").hide();
               });
               $("#load").click(function(){
                    $("#loading").show();
                });
            });

        </script>
<script>
        $(document).ready(function () {
            var parentDivs = $('#nestedAccordion div'),
                childDivs = $('#nestedAccordion h3').siblings('div');

            $('#nestedAccordion h2').click(function () {
                parentDivs.slideUp();
                if ($(this).next().is(':hidden')) {
                    $(this).next().slideDown();
                } else {
                    $(this).next().slideUp();
                }
            });

            $('#nestedAccordion a').click(function () {
                childDivs.slideUp();
                if ($(this).next().is(':hidden')) {
                    $(this).next().slideDown();
                } else {
                    $(this).next().slideUp();
                }
            });
        });
        </script>
 <script>
        $(document).ready(function () {
  var $nav = $('.t_header,.nav_bar,.cart,.logo a h1 img,.nav_bar ul li a,.nav_bar ul li,.cart a,.hamburger,.logo'),
      posTop = $nav.position().top;
  $(window).scroll(function () {
    var y = $(this).scrollTop();
    if (y > posTop) { $nav.addClass('fixed'); }
    else { $nav.removeClass('fixed'); }
  });
});
</script>
        <style>
		.dropbtn {
		    cursor: pointer;
		    background: transparent;
		    border: none;
		}
		
		.dropdown {
		    position: relative;
		    display: inline-block;
		}
		
		.dropdown-content {
		    display: none;
		    position: absolute;
		    z-index: 999;
		    right: 0;
		    min-width: 240px;
		}
		
		.dropdown-content a {
		    display: block;
		}
		
		
		.dropdown:hover .dropdown-content {
		    display: block;
		}
		.form-control{
			border-radius: 0px;
			box-shadow: none;
			border-color: #dc1e28;
		}
		.form-group{
			margin-bottom: 10px;
		}
		.form-group label{
			margin-bottom: 5px;
			font-weight: bold;
		}
.box h4{
    font-size: 16px;
    border-bottom: 1px solid #dc1e28;
    padding-bottom: 3px;
    font-weight: 600;
margin:10px 0px 5px 0px;
}
		</style>

    </head>
<body>
<?php $layout->ShowHeader(); ?>
    <div class="container">


       
       
        <section class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 section_one">
            	
                <?php if($PageView!="ContactUs"){ $layout->LeftSidebarMenu(); }else{ ?>
                    <div class='col-lg-3 col-md-3 col-sm-3 sidebanner'>
                    	<h3 style="font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-bottom: 10px;">Contact Us Form Here!</h3>
                    	<form role='form' method='post'>
						  <div class='form-group'>
						    <label for='email'>Email Address</label>
						    <input type='text' class='form-control' name='email' required pattern='[a-zA-Z0-9_]+@[a-zA-Z0-9_]+.[a-zA-Z0-9_]+'>
						  </div>
						  <div class='form-group'>
						    <label for='email'>Subject</label>
						    <input type='text' class='form-control' name='subject' required>
						  </div>
						  <div class='form-group'>
						    <label for='email'>Message</label>
						    <input type='text' class='form-control' name='message' required>
						  </div>
						  
						  <button style='    display: inline-block;
    color: #fff;
    background: #dc1e28;
    padding: 5px 10px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 3px;
    text-decoration: none;
    border: 1px solid #dc1e28;
    text-shadow:none;' type='submit' class='btn btn-default' name='btnSendMessage'>Submit</button>
						   <br/>
			                      <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $MessageStatus; ?></span>
					  </form>
                	</div> 
                <?php }?>
                
                <?php /*Paopack Login Page*/ if($PageView=="PaopackLogin"){ ?>
                  	 
                  	 <div class="col-lg-9 col-md-9 col-sm-9 login_section">
                  	 	
                  	 	   <h2>Authentication</h2>
                  	 	   
		                   <div class="col-lg-6 col-md-6 create_accuont">
		                      <form method="post">
		                      	  <h3>CREATE AN ACCOUNT</h3>
			                      <p>Please enter your email address to create an account.</p>
			                      <label>Email address</label><br>
			                      <input type="email" required="" name="email"><br>
			                      <button id="btn" type="submit" name="btnCheckEmail"><i class="fa fa-user"></i>Create an account</button>
			                      <br/>
			                      <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $EmailExists; ?></span>
		                       </form>
		                   </div>
		                   <div class="col-lg-6 col-md-6 create_accuont">
		                   	<form method="post">
		                      <h3>ALREADY REGISTERED?</h3>
		                      <label>Email address</label><br>
		                      <input type="email" name="email" required=""><br>
		                      <label>Password</label><br>
		                      <input type="password" name="pwd" required><br>
		                      <p><a href="#">Forgot your password?</a> <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $MessageStatus; ?></span></p>
		                      <button id="btn" type="submit" name="btnLogin"><i class="fa fa-lock"></i>Sign in</button>
		                   </form>
		                   </div>
                  	 	
	                </div>
                  	 
                  	 <?php }/*Paopack Registration Page*/ else if($PageView=="PaopackRegistration"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 section_products">
			                    <form method="post">
			                    	<h2 style="color: #dc1e28;font-size: 24px;font-weight: bold;margin-bottom: 30px;padding-bottom: 7px;border-bottom: 2px solid #dc1e28;">Create An Account</h2> 
				                    <div class="col-lg-12 col-md-12 col-sm-12 login_section">
				                       <h2 style="font-size:18px;margin-bottom: 20px;">YOUR PERSONAL INFORMATION</h2>
				                       <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $MessageStatus; ?></span>
				                       
				                       <div class="col-lg-12 col-md-12 create_accuont" style="padding: 0px;">
				                          
				                          <label>Name</label><br>
				                          <input type="text" name="fN" required=""><br>
				                          
				                          <label>Email address</label><br>
				                          <input type="email" name="email" value="<?php if(isset($_GET['email'])){  echo $paopack->GetPageView($_GET['email']); } ?>" required><br>
				                          <label>Password</label><br>
				                          <input type="password" name="pwd" required><br>
				                          <label>Mobile Number</label><br>
				                          <input type="telephone" name="dob" required><br>
				                          <button id="btn" type="submit" name="btnRegister">Register</button>
				                       </div>
				                    </div>    
			                    </form>    
		                </div>
                  	 <?php }/*Paopack Quick View Page*/ else if($PageView=="PaopackQuickView"){ $ProductId = $_GET['pid'];$ProductDetails = json_decode($paopack->PaopackQuickViewProduct($ProductId)); foreach($ProductDetails as $Prod){ $ProductName=$Prod->ProductName;$ProductPrice=$Prod->ProductPrice;$ProductDiscount=$Prod->ProductDiscount;$CategoryId=$Prod->CategoryId;$ProductImage = $Prod->ProductImage;$ProductDescription=$Prod->ProductDescription;$ProductCondition=$Prod->ProductCondition; } ?>	
                  	 <div class="col-lg-9 col-md-9 col-sm-9 section_products">
	                  <div class="col-lg-6 col-md-6 pic_view" style="margin-top: 10px;">
	                    <center><img class="img-responsive" src="<?php echo $ProductImage; ?>" alt=""></center>
	                    <!--div class="row sub_view">
	                        <div class="col-lg-3 col-md-3 col-xs-3">
	                           <img class="img-responsive" src="images/blouse.jpg" alt="">
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-xs-3">
	                           <img class="img-responsive" src="images/blouse.jpg" alt="">
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-xs-3">
	                           <img class="img-responsive" src="images/blouse.jpg" alt="">
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-xs-3">
	                           <img class="img-responsive" src="images/blouse.jpg" alt="">
	                        </div>
	                     </div--->
	                  </div>
	                  <div class="col-lg-6 col-md-6 product_info">
	                     <h2><?php echo $ProductName; ?></h2>
	                     <h5><span>Condition :</span> <?php echo empty($ProductCondition)?"Not Available":$ProductCondition; ?></h5>
	                     <p><?php echo substr($ProductDescription, 0,135); ?></p>
	                     <h1><s>Rs <?php echo $ProductPrice; ?></s> Rs <?php echo $ProductDiscount; ?></h1>
	                     
	                     <center style="margin-top:90px;"><a href="paopack_view.php?tocart=add&pid=<?php echo $ProductId;?>&view=<?php echo base64_encode($paopack->GetPageView($_GET['view'])) ;?>" id="cart"><i class="fa fa-shopping-cart"></i>ADD TO CART</a></center>
	                     <center><!--a href="#"><i class="fa fa-heart"></i>Add To My Wishlist</a---></center>
	                  </div>
	                  <div class="row more_info">
	                     <h2>More About Product</h2>
	                     <p>
	                     	<?php echo $ProductDescription; ?>
	                     </p>
	                  </div>
	                  <!--div class="row product_review">
	                     <h2>Reviews</h2>
	                     <textarea placeholder="Say Something . . ."></textarea>
	                     <a href="#">Post</a>
	                  </div-->
	                  <?php 
	                    // Load Similar Products.
	                    $layout->LoadSimilarProducts($CategoryId,$ProductId);
	                  ?>
	               </div>
                  	 <?php }/*Paopack Checkout Summary Page*/ else if($PageView=="PaopackProductCheckout"){ ?>
                  	 <div class="col-lg-9 col-md-9 col-sm-9 section_products">
	                    <h2 style="color: #dc1e28;font-size: 24px;font-weight: bold;margin-bottom: 30px;">Shopping-Cart Summary</h2>
	                     <table class="table table-bordered">
	                      <?php $layout->LoadTableHeader(); ?>
	                     </table>  
	                     <table class="table table-bordered" style="margin-top: 30px;">
	                       <thead>
	                         <tr>
	                           <th>ITEM</th>
	                           <th>NAME</th>
	                           <th>PRICE</th>
	                           <th>QTY</th>
	                           <th>TOTAL</th>
	                           <th>ACTION</th>
	                         </tr>
	                       </thead><!-- 
	                       <div class="p3"> -->
	                        
	                         	<?php 
									  if($paopack->PaopackIsCartContainsProduct()){
									  	?>
									  	 <tbody class="p3">
									  	<?php
									  	 $CartProductDetails =json_decode($paopack->PaopackCartProductDetails()); 
								         $TotalCartAmount=0;$TotalProducts=0;
								         foreach($CartProductDetails as $CartDetails){ $TotalCartAmount+=$CartDetails->Count*$CartDetails->Price;
										      $TotalProducts+=$CartDetails->Count;
										?>
			                           <tr>
			                             <td><img class="img-responsive" src="<?php echo $CartDetails->ProductImage; ?>" alt="" style="width:35%"></td>
			                             
			                             <td><?php echo $CartDetails->ProductName; ?></td>
			                             <td><?php echo $CartDetails->Price; ?></td>
			                             <td><?php echo $CartDetails->Count; ?></td>
			                             <td><?php echo $CartDetails->Count*$CartDetails->Price; ?></td>
			                             <td><a href="paopack_view.php?view=<?php echo base64_encode('PaopackProductCheckout'); ?>&delcart=<?php echo base64_encode($CartDetails->ProductId); ?>" title="Remove from Cart"><i id="p3" class="fa fa-trash-o"></i></a></td>
			                           </tr>
			                           <?php } ?>
			                           </tbody>
				                         <tfoot>
				                              <tr class="cart_total_price">
				                                  <td rowspan="3" colspan="2" id="cart_voucher" class="cart_voucher"></td>
				                                  <td colspan="3" class="text-right">Total products</td>
				                                  <td colspan="2" class="price" id="total_product"><?php echo $TotalProducts; ?></td>
				                              </tr>
				                             
				                              <tr class="cart_total_delivery">
				                                  <td colspan="3" class="text-right">Total shipping</td>
				                                  <td colspan="2" class="price" id="total_shipping">Free</td>
				                              </tr>
				                                  
				                              <tr class="cart_total_price">
				                                  <td colspan="3" class="total_price_container text-right"> <span style="font-size: 18px;font-weight: bold;">Total (Rs)</span></td>
				                                  <td colspan="2" class="price" id="total_price_container"> <span style="font-size: 18px;font-weight: bold;" id="total_price"><?php echo $TotalCartAmount; ?></span></td>
				                              </tr>
				                          </tfoot>
			                           
			                           <?php } ?>
									 
	                     </table> 
	                     
	                     <p>
	                     <a href="./" style="text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;border:1px solid #dc1e28;display:inline-block;">Continue Shopping</a>
	                     <?php if($paopack->PaopackIsCartContainsProduct()){ ?>
	                          
	                          	<a <?php if(isset($_SESSION['LoggedEmail'])){ echo "href='paopack_view.php?view=".base64_encode("PaopackCheckoutAddress")."'"; }else{ echo "href='paopack_view.php?view=".base64_encode("PaopackCheckoutLogin")."'"; } ?> style="float: right;text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;">Proceed To Checkout</a>
	                     <?php } ?>
	                     </p>   
	                </div>
                  	 <?php }/*Paopack Checkout Signin Page*/ else if($PageView=="PaopackCheckoutLogin" && !isset($_SESSION['LoggedEmail'])){ ?>	
                  	 <div class="col-lg-9 col-md-9 col-sm-9 section_products">
	                    <h2 style="color: #dc1e28;font-size: 24px;font-weight: bold;margin-bottom: 30px;">Shopping-Cart Summary</h2>
	                     <table class="table table-bordered">
	                       <?php $layout->LoadTableHeader(); ?>
	                     </table> 
	                     <div class="col-lg-12 col-md-12 col-sm-12 login_section"><!-- 
	                        <h2>Authentication</h2> -->
	                        <div class="col-lg-6 col-md-6 create_accuont">
	                           <form method="post">
		                           	<h3>CREATE AN ACCOUNT</h3>
		                           <p>Please enter your email address to create an account.</p>
		                           <label>Email address</label><br>
		                           <input type="email" required="" name="email"><br>
		                           <button id="btn" type="submit" name="btnCheckEmail"><i class="fa fa-user"></i>Create an account</button>
				                   <br/>
				                      <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $EmailExists; ?></span>
	                           </form>
	                        </div>
	                        <div class="col-lg-6 col-md-6 create_accuont">
	                           <h3>ALREADY REGISTERED?</h3>
	                           <form method="post">
	                           	   <label>Email address</label><br>
		                           <input type="email" name="email" required=""><br>
		                           <label>Password</label><br>
		                           <input type="password" name="password" required=""><br>
		                           <p><a href="#">Forgot your password?</a> <span id="MessageTxt" style="<?php echo $Style ; ?>"><?php echo $MessageStatus; ?></span></p>
		                           <button type="submit" id="btn" name="btnLoginToBuy"><i class="fa fa-lock"></i>Sign in</button>
	                           </form>
	                        </div>
	                     </div> 
	                </div>
                  	 <?php }/*Paopack Checkout Address Page*/ else if($PageView=="PaopackCheckoutAddress"){ ?>
                  	 <div class="col-lg-9 col-md-9 col-sm-9 section_products">
	                    <table class="table table-bordered">
	                      <?php $layout->LoadTableHeader(); ?>
	                    </table> 
	                    <form method="post">
	                    	<div class="col-lg-12 col-md-12 col-sm-12 login_section">
		                       <h2 style="font-size:18px;margin-bottom: 20px;">DELIVERY ADDRESS</h2>
		                       <?php 
		                         $LoggedUserDetails = json_decode($paopack->PaopackGetLoggedUserDetails($_SESSION['LoggedEmail']));
								 foreach($LoggedUserDetails as $User){
		                       ?>
		                       <div class="col-lg-12 col-md-12 create_accuont" style="padding: 0px;">
		                          <label>Email address</label><br>
		                          <input type="email" name="email" value="<?php echo $User->UserEmail; ?>" readonly required=""><br>
		                          <label>First Name</label><br>
		                          <input type="text" name="fN" value="<?php echo $User->UFirstName; ?>" readonly required><br>
		                          <label>Last Name</label><br>
		                          <input type="text" name="lN" value="<?php echo $User->ULastName; ?>" readonly required><br>
		                          <label>Address 1</label><br>
		                          <input type="text" name="address" value="<?php echo $User->UserAddress; ?>" required><br>
		                          <label>City</label><br>
		                          <input type="text" name="city" value="<?php echo $User->UserCity; ?>" required><br>
		                          <label>Post Code</label><br>
		                          <input type="text" name="pincode" value="<?php echo $User->UserPincode; ?>" required><br>
		                          <label>Country</label><br>
		                          <input type="text" name="country" value="<?php echo $User->UserCountry; ?>" required><br>
		                          <label>Tel/Mobile Number</label><br>
		                          <input type="text" name="mobile" value="<?php echo $User->UserMobile; ?>" required><br>
		                          
		                          <input type="hidden" name="userid" value="<?php echo $User->UserId; ?>"/>
		                       </div>
		                       <?php } ?>
		                       <p>
		                     <a href="./" style="text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;border:1px solid #dc1e28;display:inline-block;">Continue Shopping</a>
		                     <button type="submit" name="btnSaveAddress"  style="float: right;text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;border:1px solid #dc1e28;">Proceed To Payment</button>
		                     </p> 
		                    </div>  
	                    </form>
	                    
	                </div>
                  	 <?php }else if($PageView=="PaopackCheckoutPayment"){ ?> 
                  	   <div class="col-lg-9 col-md-9 col-sm-9 section_products">
	                    <table class="table table-bordered">
	                      <?php $layout->LoadTableHeader(); ?>
	                    </table> 
	                    <div class="col-lg-12 col-md-12 col-sm-12 login_section">
	                       <h2 style="font-size:18px;margin-bottom: 20px;">Pay Payment</h2>
	                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<!-- Identify your business so that you can collect the payments. -->
								<input type="hidden" name="business" value="<?php echo $paopack->PaopackGetPaypalAddress(); ?>">
								<!-- Specify a Buy Now button. -->
								<input type="hidden" name="cmd" value="_xclick">
								<!-- Specify details about the item that buyers will purchase. -->
								<input type="hidden" name="item_name" value="<?php echo $CartItems; ?>">
								<input type="hidden" name="amount" value="<?php echo $TotalPrice; ?>">
								<input type="hidden" name="quantity" value="<?php echo $TotalItems; ?>">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="return" value="<?php echo $UrlValue; ?>&act=<?php echo base64_encode("DummySuccessTextWritten")."_".base64_encode("PaidSuccessfully") ?>"/>
								<input type="hidden" name="cancel_return" value="<?php echo $UrlValue; ?>&act=<?php echo base64_encode("DummyFailedTextWritten")."_".base64_encode("FailedToPay") ?>"/>
								<!-- Display the payment button. -->
								<input type="image" name="submit" border="0"
								src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_checkout_pp_142x27.png"
								alt="PayPal - The safer, easier way to pay online">
								<img alt="" border="0" width="1" height="1"
								src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
							</form>

<div class="pm-button"><a href="https://www.payumoney.com/paybypayumoney/#/144363"><img src="https://www.payumoney.com//media/images/payby_payumoney/buttons/113.png" /></a></div>
							<p style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></p>
	                       <p style="margin-top: 60px;">
	                     <a href="./" style="text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;border:1px solid #dc1e28;display:inline-block;">Continue Shopping</a>
	                     <!--a href="./" style="float: right;text-decoration: none;color: #fff;background: #dc1e28;font-size: 16px;font-weight: bold;padding: 5px 15px;border-radius: 3px;">Place Order</a-->
	                     </p> 
	                    </div>  
	                    
	                </div>
                  	 <?php } /*Paopack Quick View Page*/ else if($PageView=="PaopackViewMoreProducts"){ ?>	
                  	 <div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
                    <div class="row product_row_one" style="margin-top: 20px;">
                        
                       <?php $layout->LoadingProducts("All"); ?>
                        
                        
                       
                        <!--center><a style="    display: inline-block;
    text-decoration: none;
    /* width: 100%; */
    background: #8BC34A;
    padding: 10px 30px;
    color: #fff;
    margin-top: 10px;
    font-weight: bold;
    font-size: 18px;" id="load">Load More Products(200)</a></center>
                      <center><img id="loading" src="images/Recurring Appointment-48.png" alt=""></a></center-->
                      </div>

                    </div>

        
                
            </div>
           

                  	 <?php }/*Paopack Search Product Page*/ else if($PageView=="PaopackSearchProduct"){ ?>
                  	 <div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	<?php if(count($Products)>0){ ?>
		                    	<h3 style="margin-bottom: 10px;margin-left: 15px;">Found Products</h3>
		                    	<?php foreach($Products as $Prod){ if($Prod->Status=="Success"){ ?>
		                        <div class="col-lg-3 col-md-4 col-sm-4 product_one">
		                            <div class="product_pic">
		                                <center><img class="img-responsive" src="<?php echo $Prod->ProductImage; ?>" alt=""></center>
		                                <h2><?php echo $Prod->ProductName; ?><p style="    margin-left: 10px;display: inline;
    margin-left: 10px;"><?php echo $Prod->ProductWt; ?></p></h2>
		                                
		                                <h3><span style="text-decoration: line-through;margin-right: 15px;font-size: 12px;">Rs. <?php echo $Prod->ProductPrice; ?></span>Rs. <?php echo $Prod->ProductDiscount; ?></h3>
		                                
		                                <a class="product_hover" style="    bottom: 90px;text-decoration:none;background: #dc1e28;padding: 5px 15px;color: #fff;font-size: 16px;font-weight: 600;margin-left: -51px" href="paopack_view.php?view=<?php echo base64_encode('PaopackQuickView'); ?>&pid=<?php echo base64_encode($Prod->ProductId); ?>">Quick View</a>
		
		                            </div>
		                        </div>
		                       <?php } }  } ?>
		                    </div>
	
	                   </div>
                  	 <?php }/*Paopack Show Sabse Sasta Products*/else if($PageView=="SabseSasta"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="margin-bottom: 10px;
    margin-left: 15px;
    font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-left: 15px;">Sabse Sasta Products</h3>
		                    	
		                        <?php $layout->LoadingProducts("Sasta"); ?>
		                      
		                    </div>
	
	                   </div>
                  	 <?php } /*Paopack Show Sabse Sasta Products*/else if($PageView=="HotOffers"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="margin-bottom: 10px;
    margin-left: 15px;
    font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-left: 15px;">Hot Offers </h3>
		                    	
		                        <?php $layout->LoadingProducts("Hot"); ?>
		                      
		                    </div>
	
	                   </div>
                  	 <?php } /*Paopack Show Sabse Sasta Products*/else if($PageView=="ComboOffers"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="margin-bottom: 10px;
    margin-left: 15px;
    font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-left: 15px;">Combo Offers</h3>
		                    	
		                        <?php $layout->LoadingProducts("Combo"); ?>
		                      
		                    </div>
	
	                   </div>
                  	 <?php } /*Paopack Show Sabse Sasta Products*/else if($PageView=="FreshArrival"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="margin-bottom: 10px;margin-left: 15px;">Fresh Arrivale Products</h3>
		                    	
		                        <?php $layout->LoadingProducts("All"); ?>
		                      
		                    </div>
	
	                   </div>
                  	 <?php }/*Paopack Show Products Filtered By Subcategory*/else if($PageView=="FilterSubcatProduct"){?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="margin-bottom: 10px;margin-left: 15px;">Fresh Arrivale Products</h3> <?php $GetId = $paopack->GetPageView($_GET['subid']); 
                  	            
                  	           
		                    	 $layout->LoadingProducts("SubcatProducts_".$GetId.""); ?>
		                    	 </div>
                           </div>
		                        
                  	 <?php }  /*Paopack Show Sabse Sasta Products*/else if($PageView=="ContactUs"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		                    <div class="row product_row_one">
		                    	
		                    	<h3 style="font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-bottom: 10px;">Find Us on Google Map</h3>
		                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
		                        <div style='overflow:hidden;height:300px;width:100%;'>
		                        	<div id='gmap_canvas' style='height:300px;width:100%;'></div>
		                        	
		                        	<style>
		                        	  #gmap_canvas img{max-width:none!important;background:none!important}
		                            </style>
		                         </div>
		                         <script type='text/javascript'>
		                            function init_map(){
		                            	var myOptions = {zoom:16,center:new google.maps.LatLng(<?php echo $paopack->PaopackGetLatLng(); ?>),
		                            		mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
		                            		marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(<?php echo $paopack->PaopackGetLatLng(); ?>)});
		                            		infowindow = new google.maps.InfoWindow({content:'<strong>Paopack Fresh Market</strong><br>Dummy Content<br>'});
		                            		google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);
		                            		}google.maps.event.addDomListener(window, 'load', init_map);
		                         </script>
		                      
		                    </div>
	
	                   </div>
                  	 <?php }  /*Paopack Show Sabse Sasta Products*/else if($PageView=="PrivatePolicy"){ ?>
                  	 	<div class="col-lg-9 col-md-9 col-sm-9 slider" style="padding-right: 0px;">
                        
		         
             <h2 style="    margin-bottom: 10px;
    margin-left: 15px;
    font-size: 16px;
    color: #dc1e28;
    font-weight: bold;
    margin-left: 15px;
}">PRIVACY POLICY</h2>
    
            <div class="box" style="    background: #fff;
    padding: 10px;">
 
<h4>Privacy Notice</h4>
 <p>
This Privacy Notice (“Notice”) describes how ANYTHING INFOTECH PVT. LTD. and its respective subsidiaries, associate companies and jointly controlled entities (“PAOPACK”) use your Personal Data.
 </p>
 <h4>
Collection of Personal Data</h4>
 <p>
“Personal Data” means information about you, from which you are identifiable, including but not limited to your name, identification card number, birth certificate number, passport number, nationality, address, telephone number, fax number, bank details, credit card details, race, gender, date of birth, marital status, resident status, education background, financial background, personal interests, email address, your occupation, your designation in your PAOPACK Group, your PAOPACK details, the industry in which you work in, any information about you which you have provided to PAOPACK in registration forms, application forms or any other similar forms and/or any information about you that has been or may be collected, stored, used and processed by PAOPACK from time to time and includes sensitive personal data such as data relating to health, religious or other similar beliefs.
 </p>
 <p>
The provision of your Personal Data is voluntary. However if you do not provide PAOPACK your Personal Data, PAOPACK will not be able to process your Personal Data for the Purposes and Additional Purposes outlined below.
 </p>
 <p>
If you are an agent, vendor, supplier or service provider, provision of your Personal Data is mandatory and failure to provide your Personal Data, may be a breach of laws or regulatory requirements, and may cause PAOPACK to be unable to engage you to provide services or products or issue payments to you for products or services provided.
 </p>
 <p>
In addition to the Personal Data you provide to PAOPACK directly, PAOPACK may collect your Personal Data from a variety of sources such as:
 </p>
 <ul>
<li>	Fill up application or registration forms or other similar forms</li>
<li>	From publicly available sources such as directories</li>
<li>	From PAOPACK’s social media pages, if you follow, like or are a fan of such pages</li>
<li>	From credit reporting agencies</li>
<li>	When you interact and communicate with PAOPACK at any events or activities</li>
<li>•	When you enter contests organized by PAOPACK</li>
<li>•	From various entities or divisions under PAOPACK</li>
<li>•	By using PAOPACK websites, which includes all websites operated by PAOPACK and under the names of its respective brands (“Websites”)</li> <li>•	Your personal data may also be collected from cookies used on the Websites.</li>
</ul> 
<h4>Purposes of Processing</h4>
 <p>
PAOPACK may use and process your Personal Data for business and activities of PAOPACK which shall include, without limitation the following (“Purpose”):</p>
<p> 
Where you are a customer of the services provided by PAOPACK:
 </p>
 <ul><li>

•	to perform the PAOPACK’s obligations in respect of any contract entered into with you</li>
<li>
•	to provide you with any service you have requested</li>
<li>
•	to process your subscriptions and to deliver the services to you</li>
<li>
•	where you have requested to download and use the PAOPACK App (“App”), to process your request, to deliver the App to you and to provide you a license for the use of the App</li>
<li>
•	to process your participation in any events, activities, focus groups, research studies, contests, promotions, polls, surveys or any productions</li>
<li>
•	to process, manage or verify your application for subscription with the PAOPACK and to provide you the benefits offered to subscribers
</li>
<li>
•	to validate your bookings and process payments relating to any products or services you have requested</li>
<li>
•	to validate your bookings and process payments relating to any products or services you have requested</li>
<li>
•	to develop, enhance and provide products and services to meet your needs
</li>
<li>
•	to process exchanges or product returns</li>
 </ul>
<p>Where you are an agent, vendor, supplier, partner, contractor or service provider:
 </p>
 <ul>
 <li>
•	•	for the purposes of engaging you to provide services or products</li>
<li>••	to facilitate or enable any checks as may be required by PAOPACK in order to engage you</li>
<li>
•	•	to facilitate or enable any checks as may be required by PAOPACK in order to engage you</li>
<li>
•	•	to contact you or your PAOPACK</li>

</ul>
<p> 
General:
 </p>
 <ul>
 <li>
•	to respond to questions, comments and feedback from you</li><li>
•	to communicate with you for any of the purposes listed in this Notice</li><li>
•	for internal administrative purposes, such as auditing, data analysis, database records</li><li>
•	for purposes of detection, prevention and prosecution of crime</li><li>
•	for PAOPACK to comply with its obligations under law</li>
</ul>
<p> 
and you agree and consent to PAOPACK using and processing your Personal Data for the Purposes and in the manner as identified in this Notice </p>
 <h4>
 
Marketing and promotional purposes
 </h4>
 <p>
PAOPACK may also use and process your data for other purposes such as (“Additional Purposes”):
 </p>
 <ul><li>
•	To send you alerts, newsletters, updates, mailers, promotional materials, special privileges, festive greetings from PAOPACK, its partners, sponsors or advertisers</li><li>
•	To notify and invite you to events or activities organized by PAOPACK, its partners, sponsors or advertisers</li><li>
•	To process your registration to participate in or attend an event or activity and to communicate with you regarding your attendance at the event or activity</li><li>
•	To share your Personal Data amongst its subsidiaries, associate companies and jointly controlled entities as well as with its agent, vendor, supplier, partner, contractor or service provider who may communicate with you to market their products, services, events or promotions</li>
 </ul><p>
by way of post, telephone call, short message service (SMS), by hand and/or by email.
 </p>
 <h4>
Unsubscribe and Revocation of Consent
 </h4>
 <p>
If you wish to unsubscribe to the processing of your Personal Data for Additional Purposes PAOPACK, please click on the link “Unsubscribe” which is embedded in the relevant email in order not to receive any email in the future.
 </p>
 <p>
If you wish to revoke the consent that PAOPACK has obtained from you for the Purposes stipulated herein, please notify PAOPACK using the contact details stated below
 </p><h4>
Transfer of Personal Data
</h4>
<p> 
Your Personal Data may be transferred to, stored, used and processed in a jurisdiction other than your home nation or otherwise in the country, state and city in which you are present while using any services provided by PAOPACK (“Alternate Country”), to companies under PAOPACK which are located outside of your home nation or Alternate Country and/or where PAOPACK’s servers are located outside of your home nation or Alternate Country. You understand and consent to the transfer of your Personal Data out of your home nation or Alternate Country as described herein.</p><h4>
Disclosure to Third Parties
 </h4>
 <p>
Your personal data may be transferred, accessed or disclosed to third parties for the Purposes and Additional Purposes. Further, PAOPACK may engage other companies, service providers or individuals to perform functions on its behalf, and consequently may provide access or disclose to your Personal Data to such service providers or third parties. The third parties include, without limitation:</p>
 <ul><li>
•	PAOPACK partners, which include parties with whom PAOPACK collaborates with for certain events, programs and activities</li><li>
•	Event management companies and event sponsors</li><li>
•	Marketing research companies</li><li>
•	Service providers, including, information technology (IT) service providers for infrastructure, software and development work</li><li>
•	Professional advisors and external auditors, including legal advisors, financial advisors and consultants</li>
<li>•	Other entities within PAOPACK</li>
<li>
•	Governmental authorities to comply with statutory, regulatory and governmental requirements</li>
 </ul>
 <p>
Your Personal Data may also be shared in connection with a corporate transaction, such as a sale of a subsidiary or a division, merger, consolidation, or asset sale, or in the unlikely event of winding-up.</p>
 <h4>
Access & Correction Requests and Inquiries, Limiting the Processing of Personal Data
 </h4>
 <p>
Subject to any exceptions under applicable laws of your home nation or Alternate Country, you may request for access to and/or request correction of your Personal Data, request to limit the processing of your Personal Data for the Additional Purposes and/or make any inquiries regarding your Personal Data by contacting:
 </p>
 <address>
ANYTHING INFOTECH
D-185,Phase - 8B,Industrial Area, Mohali, Punjab(140603), 8968887924, 9643616179
 support@paopack.com

 </address>
 <p>
Subject to any laws of your home nation or Alternate Country, PAOPACK reserves the right to impose a fee for access of your Personal Data in the amounts as permitted therein.
 </p>
 <p>
In respect of your right to access and/or correct your Personal Data, PAOPACK has the right to refuse the your requests to access and/or make any correction to your Personal Data for the reasons permitted under law, such as where the expense of providing access to you is disproportionate to the risks to your or another person’s privacy.
 </p>
 <p>
If you do not wish for your Personal Data to be collected via cookies on the Websites, you may deactivate cookies by adjusting your internet browser settings to disable, block or deactivate cookies, by deleting your browsing history and clearing the cache from your internet browser.</p>
 <h4>
Links to Third-Party Websites
</h4>
<p> 
The Websites may contain links to third parties’ websites. Please note that PAOPACK is not responsible for the collection, use, maintenance, sharing, or disclosure of data and information by such third parties. If you provide information directly to such sites, the privacy policy and terms of service on those sites are applicable and PAOPACK is not responsible for the information processing practices or privacy policies of such sites.</p>
 <h4>
Personal Information from Minors and Other Individuals
 </h4>
 <p>
As a parent or legal guardian, please do not allow the minor (individuals under 18 (eighteen) years of age) under your care to submit Personal Data to PAOPACK. In the event that such Personal Data is provided to PAOPACK, you hereby consent to the processing of the minor’s Personal Data and personally accept and agree to be bound by this Notice and take responsibility for his or her actions.
In some circumstances you may have provided personal data relating to other individuals (such as your spouse, family members or friends) and in such circumstances you represent and warrant that  </p>
 <p>
you are authorized to provide their personal data to PAOPACK and you have obtained their consent for their personal data be processed and used in the manner as set forth in this Notice. </p><h4>
Acknowledgement and Consent
 </h4><p>
By communicating with PAOPACK, using PAOPACK’s services, purchasing products from PAOPACK or by virtue of your engagement with PAOPACK, you acknowledge that you have read and understood this Notice and agree and consent to the use, processing and transfer of your Personal Data by PAOPACK as described in this Notice.</p><p>
PAOPACK shall have the right to modify, update or amend the terms of this Notice at any time by placing the updated Notice on the Websites. By continuing to communicate with PAOPACK, by continuing to use PAOPACK’s services, purchasing products from PAOPACK or by your continued engagement with PAOPACK following the modifications, updates or amendments to this Notice, such actions shall signify your acceptance of such modifications, updates or amendments</p><p>
In the event of any conflict between the English and other language versions, the English version shall prevail</p>
</div>
</div>



	
	                  
                  	 <?php }  ?>
                     
            </div>
        </section>
<!-- section end here
 -->

<!-- footer starts here
 -->
      
 


    </div>

     <?php $layout->ShowFooter(); ?>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script>
  $('#combo').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });


</script>




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5768d8b9537e1db952f16485/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>