<?php 

	  session_start();
	  function __autoload($className) {
	     include $className . '.php';
	  }
	  $paopack = new Paopack();
	  $layout = new Layout();

	  /* Global Variable Declarations */
	  $MessageStatus='';$Style='';$PageView='';$EmailExists='';$EmailId='';$UserType='';
	  /*Product Details Carry Variables*/
	  $ProductName='';$ProductPrice='';$ProductDiscount='';$ProductDesc='';$ProductCondition='';$CategoryId='';$UrlValue='';$CartItems='';$TotalItems=0;$TotalPrice=0;
	  
	  /*CODE FOR REGISTRATION - PAOPACK_VIEW*/
	  if(isset($_POST['btnRegister'])){
	  	if($paopack->PaopackRegsiterUser()){
	  		$Style = "color:Green;font-weight:bold;";
			$MessageStatus = "Successfully Registered.";
			
	  	}else{
	  		$Style="color:Red;font-weight:bold;";
	  		$MessageStatus = "Email Address Alreay Exists.";
	  	}
	  } // CODE ENDS
	
          
        
	  /*CODE FOR LOGIN - PAOPACK_VIEW*/
	  if(isset($_POST['btnLogin'])){
	  	if($paopack->PaopackLoginUser($_POST['email'],$_POST['pwd'])){
	  		header("location:./");
	  	}else{
	  		$Style="color:Red;font-weight:bold;";
	  		$MessageStatus="Invalid Credentials.";
	  	}
	  }  // CODE ENDS
	  
	  /*CODE TO MAKE USER LOGOUT - PAOPACK_VIEW*/
	  if(isset($_GET['view'])){ $PageView = $paopack->GetPageView($_GET['view']); }
	  if($PageView=="PaopackUserLogout"){
	  	if($paopack->PaopackUserLogout()){
	  		header("location:./");
	  	}else{}
	  }  // CODE ENDS
	  
	  /*CODE TO CHECK EMAIL EXISTS OR NOT - PAOPACK_VIEW*/
	  if(isset($_POST['btnCheckEmail'])){
	  	if(!$paopack->IsEmailExists($_POST['email'])){
	  		$Style="color:Red;font-weight:bold;"; 
	  		$EmailExists = "Email Already Exists.";
	  	}else{
	  		$EmailId = $_POST['email'];
	  		header("location:paopack_view.php?view=".base64_encode("PaopackRegistration")."&email=".base64_encode($EmailId));
	  	}
	  } // CODE ENDS
	  
	  /*FUNCTION TO REDIRECT*/
	  function MakeRedirect(){
	  	if(isset($_GET['view'])){ $PageView = $paopack->GetPageView($_GET['view']);header("location:paopack_view.php?view=".base64_encode($PageView)); }
	  }
	 
	  /*FUNCTION TO SEARCH PRODUCT*/
	  if(isset($_POST['btnSearch'])){
	  	  $SearchKey = $_POST['srchtxt'];
		  header("location:paopack_view.php?view=".base64_encode("PaopackSearchProduct")."&key=".base64_encode($SearchKey));
	  }
	  
	  /*Function to Add to Cart*/
	  $Cart = isset($_GET['tocart'])?$_GET['tocart']:"";$ProductId = isset($_GET['pid'])?$_GET['pid']:"";$ProductView = isset($_GET['view'])?$_GET['view']:"";
	  if($Cart=="add"){
	  	    $PIds = $paopack->GetPageView($ProductId);
			if($paopack->PaopackAddtoCart($PIds)){
				if(empty($ProductView)){
					header("location:./");
				}else{
					header("location:paopack_view.php?view=".$ProductView."&pid=".$ProductId);
				}
			}else{
				echo "<script>alert('Failed to Add')</script>";
			}  
	   }
	  
	  /*Function to Make Paopack Admin Login*/
	  if(isset($_POST['btnAdminPanelLogin'])){
	  	$Email = $_POST['email']; $Password = $_POST['pwd'];$UserType=$_POST['user_type'];
		if($paopack->IsPaopackAdminExists($Email,$Password,$UserType)){
		}else{
			$MessageStatus='Invalid Credentials.';
		}
	  }
          /* ADD TO PACKAGE ONE BY ONE */
          if(isset($_POST['btnAddProductToPackage']))
          {
            $female=$_POST['Female_size'];
            $male=$_POST['male_size'];
            $children=$_POST['child_size'];
            $babies=$_POST['babies_size'];
            $pro_id=$_POST['$product_id'];
            $q=$_POST['$qty'];
            echo $pro_id,$q;
           
          }
	  
	  /*PRODUCT OPERATIONS*/
	  
	  /*Function to Make Add New Product*/
	  if(isset($_POST['btnAddProduct'])){
	  	if($paopack->PaopackProductOperation("","Add")){
	  		$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "Added Successfully.";
	  	}else{
	  		$Style = "color:red;font-weight:bold;";
	  		$MessageStatus="Failed to Add Product / Image File is Not Valid.";
	  	}
	  }
	  
	  /*Function to Delete Product via delid*/
	  $ProductDelId = $paopack->GetPageView(isset($_GET['delid'])?$_GET['delid']:"");
	  if(!empty($ProductDelId)){
	  	if($paopack->PaopackProductOperation($ProductDelId,"Delete")){
	  		$Style = "color:Green;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully.";
	  	}else{
	  		$Style = "color:red;";
	  		//$MessageStatus="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failed to Delete Product / Id Not Found.";
	  	}
	  }else{}
	  
	  /*Function to Update Product Details via ProductId*/
	  if(isset($_POST['btnUpdateProduct'])){
	  	$ProductId = base64_decode(explode("_", (isset($_GET['pid'])?$_GET['pid']:""))[0]);
	  	if($paopack->PaopackProductOperation($ProductId,"Update")){
	  		$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Updated Successfully.";
	  	}
	  }else{}
	  
	  /*CATEGORY OPERATIONS*/
	  
	  /*Function to Add Category*/
	  if(isset($_POST['btnAddCategory'])){
	  	if($paopack->PaopackCategoryOperations("","Add")){
	  		$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Added Successfully.";
	  	}
	  }

if(isset($_POST['btnUpdateCategory'])){
	  	$CategoryId = base64_decode(explode("_", (isset($_GET['cid'])?$_GET['cid']:""))[0]);
	  	if($paopack->PaopackCategoryOperations($CategoryId,"Update")){
	  		$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Updated Successfully.";
	  	}
	  }else{}
	  
	  /*Function to Delete Catgeory via catid*/
	  $CategoryDelId = $paopack->GetPageView(isset($_GET['catid'])?$_GET['catid']:"");
	  if(!empty($CategoryDelId)){
	  	if($paopack->PaopackCategoryOperations($CategoryDelId,"Delete")){
	  		$Style = "color:Green;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully.";
	  	}else{
	  		$Style = "color:red;";
	  		//$MessageStatus="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failed to Delete Product / Id Not Found.";
	  	}
	  }else{}
	  
	  /*SUBCATEGORY OPERATIONS*/
	  
	  /*Function to Add Category*/
	  if(isset($_POST['btnAddSubcategory'])){
	  	if($paopack->PaopackSubcategoryOperations("","Add")){
	  		$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Added Successfully.";
	  	}
	  }
	  /*Function to Delete Subcategory via subcatid*/
	  $SubcategoryDelId = $paopack->GetPageView(isset($_GET['subcatid'])?$_GET['subcatid']:"");
	  if(!empty($SubcategoryDelId)){
	  	if($paopack->PaopackSubcategoryOperations($SubcategoryDelId,"Delete")){
	  		$Style = "color:Green;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully.";
	  	}else{
	  		$Style = "color:red;";
	  		//$MessageStatus="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failed to Delete Product / Id Not Found.";
	  	}
	  }else{}
	  
	  
	  /*Checkout Page Login*/
	  if(isset($_POST['btnLoginToBuy'])){
	  	if($paopack->PaopackLoginUser($_POST['email'],$_POST['password'])){
	  		header("location:paopack_view.php?view=".base64_encode("PaopackCheckoutAddress"));
	  	}else{
	  		$Style="color:Red;font-weight:bold;";
	  		$MessageStatus="Invalid Credentials.";
	  	}
	  }
	  
	  /*Function to Delete Product From Cart Summary Page*/
	  $CartProductId = $paopack->GetPageView(isset($_GET['delcart'])?$_GET['delcart']:"");
	  $View = $paopack->GetPageView(isset($_GET['view'])?$_GET['view']:"");
	  if(!empty($CartProductId)){
	  	if($paopack->PaopackDeleteCartProduct($CartProductId)){
	  		header("location:paopack_view.php?view=".base64_encode($View));
	  	}
	  }
	  
	  /*Function to Get Url Value*/
	  $UrlValue = $paopack->PaoPackGetUrlAddress();
	  
	  $GetReturnedPaymentMessage = isset($_GET['act'])?$_GET['act']:"";
	  
	  /*Function of Redirecting after Payment*/
	  if(!empty($GetReturnedPaymentMessage)){
	  	  $DecodeMessage = explode("_", $GetReturnedPaymentMessage)[1];
		  if(!empty($DecodeMessage)){
		  	$Style="color:green";
		  	if($paopack->GetPageView($DecodeMessage)=="PaidSuccessfully"){
		  		        if($paopack->PaopackDeleteCartProducts()){
		  		        	if($paopack->PaopackPlaceOrder()){
		  		        		if($paopack->PaopackConfirmOrderSendMail($UrlValue)){
                                                                $paopack->PaopackMadePdfFile();
		  		        			$MessageStatus="Order Placed Successfully, redirecting in few second ...";
                                
		  		        		}
		  		        	}else{}
		  		        	
		  		        }else{}
		  	}else if($paopack->GetPageView($DecodeMessage)=="FailedToPay"){
		  		$MessageStatus="Payment Verification Failed, redirecting in few second ...";
		  			  	
		  	}
		  	header('Refresh: 3; URL=./');
		  }
	  }
	  
	  /*Function to Make Save Delivery Location Of User*/
	  if(isset($_POST['btnSaveAddress'])){
	  	$UserId = $_POST['userid'];
	  	if($paopack->PaopackSaveDeliveryLocation($UserId)){
	  		header("location:paopack_view.php?view=".base64_encode("PaopackCheckoutPayment"));
	  	}else{
	  		echo "<script>alert('Failed')</script>";
	  	}
	  }
	  
	 /*Function to Get Cart Products of Logged User*/
	if($paopack->PaopackIsCartContainsProduct()){
		$CartDetails = json_decode($paopack->PaopackCartProductDetails());
		foreach($CartDetails as $Details){
			$CartItems.="( Name : ".$Details->ProductName." , Quantity :".$Details->Count." , Price : ".$Details->Count." X ".$Details->Price." = ".$Details->Count*$Details->Price." ) ";
		    $TotalPrice+=$Details->Count*$Details->Price;
			$TotalItems+=$Details->Count;
		}
	}
	
	
	/*Function to Send Message From Contact Us Page*/
	if(isset($_POST['btnSendMessage'])){
		if($paopack->PaopackSendMessage()){
			$Style = "color:Green;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Thank you for Contacting us , we'll contact you soon.";
		}else{
			$Style = "color:red;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Message Sent Failed.";
		}
	}
	
	/*Function to Add Slider Image*/
	if(isset($_POST['btnAddSliderImage'])){
		if($paopack->PaopackSaveSliderImage()){
			$Style = "color:Green;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image Uploaded Successfully.";
		}else{
			$Style = "color:red;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failed to Upload Image | Either You haven't fullfilled its conditions.";
		}
	}
	
	/*Function to Change Status of Image Slider*/
	$ImageId = $paopack->GetPageView(isset($_GET['imgid'])?$_GET['imgid']:"");
	$ImageToggle = $paopack->GetPageView(isset($_GET['view'])?$_GET['view']:"");
	if(!empty($ImageId)){
		if($paopack->PaopackChangeImageStatus($ImageId)){
			header("location:dashboard.php?view=".base64_encode($ImageToggle));
		}else{}
	}
	
	/*Function to Register New Executive*/
	if(isset($_POST['btnAddExecutive'])){
		if($paopack->PaopackResgiterExecutive()){
			$Style = "color:Green;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Added Successfully.";
		}else{
			$Style = "color:red;font-weight:bold;";
	  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failed to Add.";
		}
	}
	
	  /*Function to Delete Executive via exeid */
  $ExeDelId = $paopack->GetPageView(isset($_GET['exeid'])?$_GET['exeid']:"");
  if(!empty($ExeDelId)){
  	if($paopack->PaopackDeleteExecutive($ExeDelId)){
  		$Style = "color:Green;";
  		$MessageStatus = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully.";
  	}else{
  		$Style = "color:red;";
  	}
  }else{}


?>