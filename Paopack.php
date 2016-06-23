<?php 
  
  class Paopack extends Configuration{
  	
	      /*PAOPACK - Complete package of Paopack Fresh Market Functional Part*/
	      
	      /* 61 FUNCTIONS DEFINED HERE */
	      
	      /*
		   * PAOPACK FRESH MARKET - USED FUNCTION'S NAME 
		   * 1 . CheckConnection
		   * 2 . GetPageView
		   * 3 . GetCategories
		   * 4 . GetSubcategories
		   * 5 . PaopackRegsiterUser
		   * 6 . IsEmailExists
		   * 7 . PaopackLoginUser
		   * 8 . PaopackUserLogout
		   * 9 . PaopackGetProducts
		   * 10. GetCategoryName
		   * 11. PaopackFoundProducts
		   * 12. PaopackQuickViewProduct
		   * 13. PaopackSimilarProduct
		   * 14. PaopackClientIp
		   * 15. PaopackAddtoCart
		   * 16. PaopackCountCartProducts
		   * 17. IsPaopackAdminExists
		   * 18. PaopackAdminDetails
		   * 19. GetAllSubcategory
		   * 20. IsValidImage
		   * 21. PaopackProductOperation
		   * 22. PaopackCategoryOperations
		   * 23. PaopackSubcategoryOperations
		   * 24. PaopackCartProductDetails
		   * 25. PaopackIsCartContainsProduct
		   * 26. PaopackDeleteCartProduct
		   * 27. PaoPackGetUrlAddress
		   * 28. PaopackDeleteCartProducts
		   * 29. PaopackGetPaypalAddress
		   * 30. PaopackSaveDeliveryLocation
		   * 31. PaopackGetLoggedUserDetails
		   * 32. PaopackGetLatLng
		   * 33. PaopackReturnProductsViaQuery
		   * 34. PaopackGetProductsViaSubcategoryId
		   * 35. PaopackContactEmailAddress
		   * 36. PaopackSendMessage
		   * 37. PaopackGetHotOffers
		   * 38. PaopackSaveSliderImage
		   * 39. PaopackGetSliderImages
		   * 40. PaopackChangeImageStatus
		   * 41. PaopackIsSimilarProducts
		   * 42. PaopackCartDetailsForExecutive
		   * 43. PaopackGetSubcategoryName
		   * 44. PaopackProductDetailsViaProductId
		   * 45. PaopackCountIds
		   * 46. PaopackIsAdminAddedProducts
		   * 47. PaopackIsHotOffersAvailable
		   * 48. PaopackResgiterExecutive
		   * 49. PaopackGetAllExecutives
		   * 50. PaopackDeleteExecutive
		   * 51. PaopackCountExecutives
		   * 52. PaopackUsersNearByCity
		   * 53. PaopackPlaceOrder
		   * 54. PaopackUserLocationProductDetails
		   * 55. PaopackGetExecutiveDetails
		   * 56. PaopackGetCartViaCartId
		   * 57. PaopackConfirmOrderSendMail
           * 58. PaopackMadePdfFile
		   * 59. PaopackGetPendingOrderDetails
		   * 60. PaopackGetDetails
           * 61. PaopackIsPendingOrderPresent           
		   */
	
          /*Function to Check Database Connection - 1*/
		  function CheckConnection(){
		    return parent::MakeConnection();
		  }
		  /*Function to provide the Page View Type - 2*/
		  public function GetPageView($ViewType){
		  	$Page =  isset($ViewType)?$ViewType:"";
			if(!empty($Page)){
				return base64_decode($Page);
			}else{
				return $Page;
			}
		  }
		  /*Function to Get all Categories - 3*/
		  function GetCategories(){
		  	$db=$this->CheckConnection();
			if($db){
				//echo "Connected";
				$json_category=array();
				$QueryToGetProducts = $db->query("select * from tbl_pao_product_categories");
				if($QueryToGetProducts->num_rows>0){
					while($Category = $QueryToGetProducts->fetch_array()){
						$json_category[]=array("CategoryId"=>$Category['category_id'],"CategoryTitle"=>$Category['category_title']);
					}
					return json_encode($json_category);
				}else{}
			}else{
				//echo "Not Connected";
				return json_encode($json_category);
			}
		  }
		  /*Function to Get Subcategories via Subcategory Id - 4*/
		  function GetSubcategories($CategoryId){
		  	$db=$this->CheckConnection();
			if($db){
				//echo "Connected";
				$json_subcategory=array();
				$QueryToGetProducts = $db->query("select * from tbl_pao_product_subcategories where category_id='$CategoryId'");
				if($QueryToGetProducts->num_rows>0){
					while($Category = $QueryToGetProducts->fetch_array()){
						$json_subcategory[]=array("SubcategoryId"=>$Category['subcategory_id'],"SubcategoryTitle"=>$Category['subcategory_title']);
					}
					return json_encode($json_subcategory);
				}else{}
			}else{
				//echo "Not Connected";
				return json_encode($json_subcategory);
			}
		  }
		  /*Function to Make Paopack Registration - 5*/
		  function PaopackRegsiterUser(){
		  	$PageView = $this->GetPageView($_GET['view']);
			if(!empty($PageView)){
				if($_POST){
			  		$Title = $_POST['title'];
					$fN = $_POST['fN'];
					$lN = $_POST['lN'];
					$Email = $_POST['email'];
					$Pwd = $_POST['pwd'];
					$dob = date("d-m-Y",strtotime($_POST['dob']));
					$db=$this->CheckConnection();
					if($db){
						if($this->IsEmailExists($Email)){
							if($db->query("insert into tbl_pao_user_registration values('','$Title','$fN','$lN','$Email','$Pwd','$dob',NOW())")){
								return TRUE;
							}else{
								return FALSE;
							}
						}else{
							return FALSE;
						}
					}else{}
			  	}
			}else{  }
		  }
		  /*Function to Check Email Exists or Not - 6*/
		  function IsEmailExists($EmailAddress){
		  	$db=$this->CheckConnection();
			if($db){
				$CountEmailQuery = $db->query("select * from tbl_pao_user_registration where user_email = '$EmailAddress'");
				if($CountEmailQuery->num_rows>0){
					return FALSE;
				}else{
					return TRUE;
				}
			}else{
				return FALSE;
			}
		  }
		  /*Function Provide Login to Paopack - 7*/
		  function PaopackLoginUser($Email,$Password){
		  	$db=$this->CheckConnection();
			if($db){
				$CountEmailQuery = $db->query("select * from tbl_pao_user_registration where user_email = '$Email' and user_pwd = '$Password'");
				if($CountEmailQuery->num_rows>0){
					$_SESSION['LoggedEmail']=$Email;
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		  }
		  /*Function to Make User Logout - 8*/
		  function PaopackUserLogout(){
		  	if(isset($_SESSION)){
		  		session_destroy();
				return TRUE;
		  	}else{
		  		return FALSE;
		  	}
		  }
		  /*Function to Load All Products - 9*/
		  function PaopackGetProducts($Type){
		  	 $db=$this->CheckConnection();
		  	 if($db){
		  	 	switch($Type){
				   case "Limit":
				        $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products order by product_id desc limit 6");
						return $this->PaopackReturnProductsViaQuery($QueryToFetchProductDetails);
					   break;	
                   case "All":
					    $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products order by product_id desc");
						return $this->PaopackReturnProductsViaQuery($QueryToFetchProductDetails);
					   break;
				   case "Hot":
					   $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where  product_type='Hot Offers' order by product_id desc");
						return $this->PaopackReturnProductsViaQuery($QueryToFetchProductDetails);
					   break;
				   case "Combo":
					   $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where  product_type='Combo Offers' order by product_id desc");
						return $this->PaopackReturnProductsViaQuery($QueryToFetchProductDetails);
					   break;
				   case "Sasta":
					   $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where  product_type='Sabse Sasta' order by product_id desc");
						return $this->PaopackReturnProductsViaQuery($QueryToFetchProductDetails);
					   break;
				   default:
					   break;   	   	   
		  	 	}
		  	 }
		  }

		  /*Function to get the Category Name via Category Id - 10*/
		  function GetCategoryName($CategoryId){
		  	$db=$this->CheckConnection();
			if($db){
				$QueryToFetchName = $db->query("select * from tbl_pao_product_categories where category_id = '$CategoryId'")->fetch_array();
				$CategoryTitle = $QueryToFetchName['category_title'];
				return $CategoryTitle;
			}else{}
		  }
		  /*Function to Show the founded Product Details - 11*/
		  function PaopackFoundProducts($Key=""){
		  	$db=$this->CheckConnection();
		  	 if($db){
		  	 	$QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where product_name like '%$Key%'");
				if($QueryToFetchProductDetails->num_rows>0){
					$json_products=array();
				 	while($ProductDetails = $QueryToFetchProductDetails->fetch_array()){
				 		$CategoryId=$ProductDetails['category_id'];
				 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
						$ProductName = $ProductDetails['product_name'];
						$ProductWt = $ProductDetails['product_wt'];
						$ProductPrice = $ProductDetails['product_price'];
						$ProductId = $ProductDetails['product_id'];
						$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
						$ProductDiscountedPrice = $ProductDetails['product_discount'];
						$json_products[]=array("Status"=>"Success","CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
				 	}
					return json_encode($json_products);
				}else{
					$json_products[]=array("Status"=>"Failed","Response"=>"No Products Found");
					return json_encode($json_products);
				}
		  	 }
		  }
		  /*Function to Show Quick View Product Details- 12*/
		  function PaopackQuickViewProduct($ProductId){
		  	$db=$this->CheckConnection();
		  	 if($db){
		  	 	$QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where product_id like '$ProductId'");
				if($QueryToFetchProductDetails->num_rows>0){
					$json_products=array();
				 	while($ProductDetails = $QueryToFetchProductDetails->fetch_array()){
				 		$CategoryId=$ProductDetails['category_id'];
				 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
						$ProductName = $ProductDetails['product_name'];
						$ProductWt = $ProductDetails['product_wt'];
						$ProductPrice = $ProductDetails['product_price'];
						$ProductId = $ProductDetails['product_id'];
						$ProductDesc = $ProductDetails['product_desc'];
						$ProductDiscountedPrice = $ProductDetails['product_discount'];
						$ProductCondition = $ProductDetails['product_condition'];
						$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
						$json_products[]=array("Status"=>"Success","CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDescription"=>$ProductDesc,"ProductCondition"=>$ProductCondition,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
				 	}
					return json_encode($json_products);
				}else{
					$json_products[]=array("Status"=>"Failed","Response"=>"No Products Found");
					return json_encode($json_products);
				}
		  	 }
		  }
		  
		  /*Function to Get Products via Category ID - 13*/
		  function PaopackSimilarProduct($CategoryId,$ProductId){
		  	$db=$this->CheckConnection();
		  	 if($db){
		  	 	$QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where category_id = '$CategoryId' and product_id!='$ProductId' order by category_id desc limit 3");
				if($QueryToFetchProductDetails->num_rows>0){
					$json_products=array();
				 	while($ProductDetails = $QueryToFetchProductDetails->fetch_array()){
				 		$CategoryId=$ProductDetails['category_id'];
				 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
						$ProductName = $ProductDetails['product_name'];
						$ProductWt = $ProductDetails['product_wt'];
						$ProductPrice = $ProductDetails['product_price'];
						$ProductId = $ProductDetails['product_id'];
						$ProductDiscountedPrice = $ProductDetails['product_discount'];
						$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
						$json_products[]=array("Status"=>"Success","CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
				 	}
					return json_encode($json_products);
				}else{
					return 0;
				}
		  	 }
		  }

        /*Function to Get Client Ip Address - 14*/
			function PaopackClientIp() {
			    $ipaddress = '';
			    if (isset($_SERVER['HTTP_CLIENT_IP']))
			        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    else if(isset($_SERVER['HTTP_X_FORWARDED']))
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			    else if(isset($_SERVER['HTTP_FORWARDED']))
			        $ipaddress = $_SERVER['HTTP_FORWARDED'];
			    else if(isset($_SERVER['REMOTE_ADDR']))
			        $ipaddress = $_SERVER['REMOTE_ADDR'];
			    else
			        $ipaddress = 'UNKNOWN';
			    return $ipaddress;
			}
			
			/*Function to Add to Cart - 15*/
			function PaopackAddtoCart($ProductId){
				$db=$this->CheckConnection();
				if($db){
					$SelectCartProducts = $db->query("select * from tbl_pao_cart_products where  ip_address = '".$this->PaopackClientIp()."'");
					if($SelectCartProducts->num_rows>0){
						$GetDetails = $SelectCartProducts->fetch_array();
						$ProductIds = $GetDetails['product_ids'];
						$UpdatedIds = $ProductIds.",".$ProductId;
						if($db->query("update tbl_pao_cart_products set product_ids = '$UpdatedIds' where ip_address = '".$this->PaopackClientIp()."'")){
							return TRUE;
						}else{
							return FALSE;
						}
					}else{
						if($db->query("insert into tbl_pao_cart_products values('','2','".$ProductId."','".$this->PaopackClientIp()."','',NOW())")){
							return TRUE;
						}else{
							return FALSE;
						}
					}
				}
			}
			
			/*Function to Count Total Cart Proudcts - 16*/
			function PaopackCountCartProducts(){
				$db=$this->CheckConnection();
				if($db){
					$SelectProducts = $db->query("select * from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
					if($SelectProducts->num_rows>0){
						$ProductDetails = $SelectProducts->fetch_array();
						$CountProducts = count(explode(",", $ProductDetails[1]));
						return $CountProducts;
					}else{
						return 0;
					}
				}
			}

            /*Function to Make Admin Panel Login - 17*/
            function IsPaopackAdminExists($Email,$Password,$UserType){
            	$db=$this->CheckConnection();
            	if($db){
            		if($UserType=="admin"){
            			$SelectAdmin = $db->query("select * from tbl_pao_admin where admin_email = '$Email' and admin_password = '$Password'");
            		}else if($UserType=="executive"){
            			$SelectAdmin = $db->query("select * from tbl_executives_registration where exe_email = '$Email' and exe_password = '".base64_encode($Password)."'");
            		}
            		$AdminDetails = array();
            		if($SelectAdmin->num_rows>0){
            			$_SESSION['AdminEmail']=$Email;
						$_SESSION['UserType']=$UserType;
						return TRUE;
            		}else{
            			return FALSE;
            		}
            	}
            }
			
			/*Function to Get Admin Details - 18*/
			function PaopackAdminDetails($AdminEmail){
				$db=$this->CheckConnection();
            	if($db){
            		$SelectAdmin = $db->query("select * from tbl_pao_admin where admin_email = '$AdminEmail'");
            		$AdminDetails = array();
            		if($SelectAdmin->num_rows>0){
            			$Details = $SelectAdmin->fetch_array();
						$AdminDetails[]=array("Name"=>$Details['admin_name'],"Email"=>$Details['admin_email']);
						return json_encode($AdminDetails);
            		}else{
            			return json_encode($AdminDetails);
            		}
            	}
			}
		
		 
		  /*Function to Get Subcategories - 19*/
		  function GetAllSubcategory(){
		  	$db=$this->CheckConnection();
			if($db){
				//echo "Connected";
				$json_subcategory=array();
				$QueryToGetProducts = $db->query("select * from tbl_pao_product_subcategories");
				if($QueryToGetProducts->num_rows>0){
					while($Category = $QueryToGetProducts->fetch_array()){
						$CategoryName = $this->GetCategoryName($Category['category_id']);
						$json_subcategory[]=array("SubcategoryId"=>$Category['subcategory_id'],"SubcategoryTitle"=>$Category['subcategory_title'],"CategoryName"=>$CategoryName);
					}
					return json_encode($json_subcategory);
				}else{}
			}else{
				//echo "Not Connected";
				return json_encode($json_subcategory);
			}
		  }
		  
		  
		  /*Function to Validate Image - Y (moves to images folder), N returns false - 20*/
		  function IsValidImage($ImageFile){
			$allowed =  array('gif','png' ,'jpg');
			$filename = $ImageFile['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION); /*checking file extension while uploading*/
			if(!in_array($ext,$allowed) ) {
					return FALSE;
			}else{
				if(move_uploaded_file($ImageFile['tmp_name'], "../images/products/".$ImageFile['name'])){
					return TRUE;
				}else{
					return FALSE;
				}	
			}
		  }

		  /*Global Functions for Product Operations Like- Add , Update , Delete - 21 */
		  function PaopackProductOperation($ProductId="",$OperationMode){
		  	$db=$this->CheckConnection();
			if($db){
				switch($OperationMode){
					case "Add" :
						        $Name = $_POST['product_name'];
								$Desc = preg_replace("/'/", "\'", $_POST['product_description']);
								$CategoryId = $_POST['product_category'];
								$Weight = $_POST['product_weight']; 
								$Price = $_POST['product_price'];
								$Discount = $_POST['product_discount_price'];
								$Condition = $_POST['product_condition'];
								$Type = $_POST['product_type'];
								$Image = $_FILES['product_image'];
								$SubcatId = $_POST['product_subcategory'];
								if($this->IsValidImage($Image)){
									$ImgName = $Image['name'];
									if($db->query("insert into tbl_pao_products values('','$CategoryId','$SubcatId','$Type','$Name','$Condition','$Desc','$Weight','$Price','$Discount','images/products/$ImgName',NOW())")){
									  return TRUE;
									}else{
										return FALSE;
									}
								}
						break;
					case "Delete":
						        if($db->query("select * from tbl_pao_products where product_id = '$ProductId'")->num_rows>0){
									if($db->query("delete from tbl_pao_products where product_id = '$ProductId'")){
										return TRUE;
									}else{
										return FALSE;
									}
								}else{
									return FALSE;
								}
					    break;
					Case "Update": 
					            $Name = $_POST['product_name'];
								$Desc = $_POST['product_description'];
								$CategoryId = $_POST['product_category'];
								$SubcategoryId = $_POST['product_subcategory'];
								$ProductType = $_POST['product_type'];
								$Weight = $_POST['product_weight']; 
								$Price = $_POST['product_price'];
								$Discount = $_POST['product_discount_price'];
								$Condition = $_POST['product_condition'];
								$Image = $_FILES['product_image']; 
								if($this->IsValidImage($Image)){
									$ImgName = $Image['name'];
									if($db->query("update tbl_pao_products set product_type='$ProductType',subcategory_id='$SubcategoryId',category_id='$CategoryId',product_name='$Name',product_condition='$Condition',product_desc='$Desc',product_wt='$Weight',product_price='$Price',product_discount='$Discount',product_image='images/products/$ImgName' where product_id = '$ProductId'")){
									  return TRUE;
									}else{
										return FALSE;
									}
								}
						 break;	
						 
					  default :
						  break;	 	
				}
			}else{}
		  }

         /*Global Functions for Category Operations Like- Add , Update , Delete - 22 */
         function PaopackCategoryOperations($CategoryId,$OperationMode){
         	$db=$this->CheckConnection();
			if($db){
				switch ($OperationMode) {
					case 'Add':
						      $Title = $_POST['category_title'];
						      if($db->query("insert into tbl_pao_product_categories values('','$Title',NOW())")){
						      	return TRUE;
						      }else{
						      	return FALSE;
						      }
						
						break;
						
					case 'Delete':
					          if($db->query("select * from tbl_pao_product_categories where category_id = '$CategoryId'")->num_rows>0){
					          	  if($db->query("delete from tbl_pao_product_categories where category_id = '$CategoryId'")){
							      	return TRUE;
							      }else{
							      	return FALSE;
							      }
					          }else{
					          	//echo "<script>alert('Sanjay')</script>";
					          }
						      
						break;

case 'Update':
						      $CategoryTitle = $_POST['category_title'];
					          if($db->query("update tbl_pao_product_categories set category_title = '".$CategoryTitle."' where category_id='".$CategoryId."'")){
									  return TRUE;
							  }else{
										return FALSE;
							  }
						      
						break;		
					
					default:
						
						break;
				}
			}
         }
		 
		 /*Global Functions for Category Operations Like- Add , Update , Delete - 23 */
         function PaopackSubcategoryOperations($SubcategoryId,$OperationMode){
         	$db=$this->CheckConnection();
			if($db){
				switch ($OperationMode) {
					case 'Add':
						      $Title = $_POST['subcategory_title'];
							  $CategoryId = $_POST['product_category'];
						      if($db->query("insert into tbl_pao_product_subcategories values('','$CategoryId','$Title',NOW())")){
						      	return TRUE;
						      }else{
						      	return FALSE;
						      }
						
						break;
						
					case 'Delete':
					          if($db->query("select * from tbl_pao_product_subcategories where subcategory_id = '$SubcategoryId'")->num_rows>0){
					          	  if($db->query("delete from tbl_pao_product_subcategories where subcategory_id = '$SubcategoryId'")){
							      	return TRUE;
							      }else{
							      	return FALSE;
							      }
					          }else{
					          	//echo "<script>alert('Sanjay')</script>";
					          }
						      
						break;	
					
					default:
						
						break;
				}
			}
         }
         
		 /*Function which keeps track of Paopack Cart Added Product Details - 24*/
		 function PaopackCartProductDetails(){
		 	$db=$this->CheckConnection();
				if($db){
					$SelectProducts = $db->query("select * from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
					if($SelectProducts->num_rows>0){
						$ProductDetails = $SelectProducts->fetch_array();
						$Numbers = $ProductDetails[1];
						$ProductIds = array_count_values(explode(",",$Numbers));
						//print_r($ProductIds);
						$CartDetailsJson = array();
						foreach($ProductIds as $ProdId=>$Count){
							$ProductId = $ProdId;
							$ProductDetailsFromQuickView = json_decode($this->PaopackQuickViewProduct($ProductId));
							foreach($ProductDetailsFromQuickView as $QuickView){
								$CartDetailsJson[]=array("Count"=>$Count,"ProductName"=>$QuickView->ProductName,"ProductImage"=>$QuickView->ProductImage,"Price"=>$QuickView->ProductDiscount,"ProductId"=>$ProductId,"Original"=>$QuickView->ProductPrice,"CartId"=>$ProductDetails[0],"DateTime"=>$ProductDetails[4]);
							}
						}
						return json_encode($CartDetailsJson);
					}else{
						return 0;
					}
				}
		 }
		 
		 /*Function to Check Cart Status - 25*/
		 function PaopackIsCartContainsProduct(){
		 	$db=$this->CheckConnection();
		 	if($db){
					$SelectProducts = $db->query("select * from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
					if($SelectProducts->num_rows>0){
						return TRUE;
					}else{
						return FALSE;
					}
				}
		 }
		 
		 /*Function To Delete Product From Cart - 26*/
		 function PaopackDeleteCartProduct($ProductId){
		 	$db=$this->CheckConnection();
				if($db){
					$SelectProducts = $db->query("select * from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
					if($SelectProducts->num_rows>0){
						$ProductDetails = $SelectProducts->fetch_array();
						$ProductIds = explode(",",$ProductDetails[1]);
						for($i=0;$i<count($ProductIds)+1;$i++){
							if($ProductIds[$i]==$ProductId){
								unset($ProductIds[$i]);
							}
						}
						$GetUpdatedProductIds = implode(",", $ProductIds);
						if(empty($GetUpdatedProductIds)){
							if($db->query("delete from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'")){
								return TRUE;
							}else{
								return FALSE;
							}
						}else{
							if($db->query("update tbl_pao_cart_products set product_ids='$GetUpdatedProductIds' where ip_address = '".$this->PaopackClientIp()."'")){
								return TRUE;
							}else{
								return FALSE;
							}
						}
						
						
					}else{
						return FALSE;
					}
				}
		 }

        /*Function to Return the Url value - 27*/
        function PaoPackGetUrlAddress(){
        	$AddressUrlValue = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			return $AddressUrlValue;
        }
		
		/*Function to Get Delete Cart Products iff the payment paid - 28*/
		function PaopackDeleteCartProducts(){
			$db=$this->CheckConnection();
			if($db){
				$CartDetails = $db->query("select * from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
				$CartId = $CartDetails['cart_id'];
				if($db->query("delete from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'")){
					if($db->query("insert into tbl_order_status values('','".$CartId."','completed','".$_SESSION['LoggedEmail']."',NOW())")){
						return TRUE;
					}else{}
					
				}else{
					return FALSE;
				}
			}
		}
		
		/*Function to Get Paypal Id of Paoapck - 29*/
		function PaopackGetPaypalAddress(){
			return parent::MyPaypalAccountId();
		}
		
		/*Function to Save the Delivery Location of User - 30*/
		function PaopackSaveDeliveryLocation($LoggedUserId){
			$db=$this->CheckConnection();
			if($db){
				if($db->query("insert into tbl_pao_saved_delivery_address values('','$LoggedUserId','".$_POST['address']."','".$_POST['city']."','".$_POST['pincode']."','".$_POST['country']."','".$_POST['mobile']."',NOW())")){
						return TRUE;
				}else{
						return FALSE;
				}
			}
		}
		
		/*Function to Get Logged User Details - 31*/
		function PaopackGetLoggedUserDetails($LoggedEmail){
			$db=$this->CheckConnection();
			if($db){
				$GetDetailsQuery = $db->query("select * from tbl_pao_user_registration where user_email = '$LoggedEmail'");
				if($GetDetailsQuery->num_rows>0){
					$UserDetails = array();
					$User = $GetDetailsQuery->fetch_array();
					$GetSavedAddressQuery = $db->query("select * from tbl_pao_saved_delivery_address where user_id='".$User['user_id']."'");
					if($GetSavedAddressQuery->num_rows>0){
						$AddressDetails = $GetSavedAddressQuery->fetch_array();
						$UserDetails[]=array("UserId"=>$User['user_id'],"UFirstName"=>$User['user_fn'],"ULastName"=>$User['user_ln'],"UserEmail"=>$User['user_email'],"UserAddress"=>$AddressDetails['user_address'],"UserCity"=>$AddressDetails['user_city'],"UserPincode"=>$AddressDetails['user_pincode'],"UserCountry"=>$AddressDetails['user_country'],"UserMobile"=>$AddressDetails['user_mobile']);
					}else{
						$UserDetails[]=array("UserId"=>$User['user_id'],"UFirstName"=>$User['user_fn'],"ULastName"=>$User['user_ln'],"UserEmail"=>$User['user_email'],"UserAddress"=>"","UserCity"=>"","UserPincode"=>"","UserCountry"=>"","UserMobile"=>"");
					}
					return json_encode($UserDetails);
				}else{
					return FALSE;
				}
			}
		}

      /*Function to Get LatLng - 32*/
      function PaopackGetLatLng(){
      	 return parent::MyLocation();
      }
      
      /*Function to Get Products Via Select Query - 33*/
      function PaopackReturnProductsViaQuery($SelectQuery){
	        	   if($SelectQuery->num_rows>0){
							$json_products=array();
						 	while($ProductDetails = $SelectQuery->fetch_array()){
						 		$CategoryId=$ProductDetails['category_id'];
						 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
								$ProductName = $ProductDetails['product_name'];
								$ProductWt = $ProductDetails['product_wt'];
								$ProductId = $ProductDetails['product_id'];
								$ProductPrice = $ProductDetails['product_price'];
								$ProductDiscountedPrice = $ProductDetails['product_discount'];
								$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
								$json_products[]=array("CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
						 	}
							return json_encode($json_products);
				    }
	   }

       /*Function to Get All Products via Subcategory Id - 34*/
       function PaopackGetProductsViaSubcategoryId($SubcatId){
       	  $db=$this->CheckConnection();
		  if($db){
		  	 $QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where subcategory_id = '$SubcatId'");
			  $json_products=array();
				if($QueryToFetchProductDetails->num_rows>0){
				 	while($ProductDetails = $QueryToFetchProductDetails->fetch_array()){
				 		$CategoryId=$ProductDetails['category_id'];
				 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
						$ProductName = $ProductDetails['product_name'];
						$ProductWt = $ProductDetails['product_wt'];
						$ProductPrice = $ProductDetails['product_price'];
						$ProductId = $ProductDetails['product_id'];
						$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
						$ProductDiscountedPrice = $ProductDetails['product_discount'];
						$json_products[]=array("Status"=>"Success","CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
				 	}
					return json_encode($json_products);
				}else{
					return json_encode($json_products);
				}
		  }
       }

     /*Function to Get Mailing Email Address - 35*/
     function PaopackContactEmailAddress(){
     	return parent::MyEmailAddress();
     }
	 
	 /*Function to Send Message - 36*/
	 function PaopackSendMessage(){
		$Subject = $_POST['subject'];
		$Message = $_POST['message'];
		$to = $this->PaopackContactEmailAddress();
		$headers = "From: ".$_POST['email'];
		if(mail($to,$Subject,$Message,$headers)){
			return TRUE;
		}else{
			return FALSE;
		}
	 }

     /*Function to Fetch Hot Offers - 37*/
     function PaopackGetHotOffers(){
     	$db=$this->CheckConnection();
		if($db){
			$QueryToFetchRecords = $db->query("select * from tbl_pao_products where product_type = 'Hot Offers'");
			$json_products=array();
			if($QueryToFetchRecords->num_rows>0){
				while($ProductDetails = $QueryToFetchRecords->fetch_array()){
					
					    $CategoryId=$ProductDetails['category_id'];
				 		$CategoryName = $this->GetCategoryName($ProductDetails['category_id']);
						$ProductName = $ProductDetails['product_name'];
						$ProductWt = $ProductDetails['product_wt'];
						$ProductPrice = $ProductDetails['product_price'];
						$ProductId = $ProductDetails['product_id'];
						$ProductImage = !empty($ProductDetails['product_image'])?$ProductDetails['product_image']:"images/products/no_product_img.jpg";
						$ProductDiscountedPrice = $ProductDetails['product_discount'];
						$json_products[]=array("Status"=>"Success","CategoryName"=>$CategoryName,"ProductName"=>$ProductName,"ProductWt"=>$ProductWt,"ProductPrice"=>$ProductPrice,"ProductDiscount"=>$ProductDiscountedPrice,"ProductId"=>$ProductId,"CategoryId"=>$CategoryId,"ProductImage"=>$ProductImage);
				
				}
				return json_encode($json_products);
			}else{}
		}
     }

   /*Function to Save Slider Image - 38*/
	 function PaopackSaveSliderImage(){
	 	$db=$this->CheckConnection();
		if($db){
			/* EXTENSION VALIDATION*/
			$allowed =  array('gif','png' ,'jpg');
			$filename = $_FILES['slider_image']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION); /*checking file extension while uploading*/
			if(!in_array($ext,$allowed) ) {
				
					return FALSE;
					
			}else{
				
				/*SIZE VALIDATION*/
				if($_FILES['slider_image']['size'] > 512000) { //500 KB (size is also in bytes)
					// File too big
				   return FALSE;
				} else {
					/*RESOLUTION VALIDATION*/
					
					// File within size restrictions
					$image_info = getimagesize($_FILES["slider_image"]["tmp_name"]);
					$image_width = $image_info[0];  /*getting image width*/
					$image_height = $image_info[1]; /*getting image height*/
					if($image_height=="255" && $image_width=="770"){
						if(move_uploaded_file($_FILES["slider_image"]["tmp_name"], "../images/slider/".$_FILES["slider_image"]["name"])){
							if($db->query("insert into tbl_paopack_slider_images values('','images/slider/".$_FILES["slider_image"]["name"]."','active',NOW())")){
								return TRUE;
							}else{
								return FALSE;
							}
							
						}else{
							return FALSE;
						}
						
					}else{
						return FALSE;
					}
				}	
			}
		}
	 }

    /*Function to Get Slider Images - 39*/
    function PaopackGetSliderImages($Status){
    	$db=$this->CheckConnection();
		if($db){
			if($Status=="All"){
				$QueryToFetchSliderImages = $db->query("select * from tbl_paopack_slider_images");
				if($QueryToFetchSliderImages->num_rows>0){
					$ImageJson = array();
					while($Image = $QueryToFetchSliderImages->fetch_array()){
						$ImageJson[]=array("ImageId"=>$Image['img_id'],"ImageData"=>$Image['img_data'],"ImageStatus"=>$Image['img_status']);
					}
					return json_encode($ImageJson);
				}else{
					
				}
			}else if($Status=="Active"){
				$QueryToFetchSliderImages = $db->query("select * from tbl_paopack_slider_images where img_status='active'");
				if($QueryToFetchSliderImages->num_rows>0){
					$ImageJson = array();
					while($Image = $QueryToFetchSliderImages->fetch_array()){
						$ImageJson[]=array("ImageId"=>$Image['img_id'],"ImageData"=>$Image['img_data'],"ImageStatus"=>$Image['img_status']);
					}
					return json_encode($ImageJson);
				}else{
					
				}
			}
		}
    }
    
	/*Function to Change the Status of Image - 40*/
    function PaopackChangeImageStatus($ImgId){
    	$db=$this->CheckConnection();
    	if($db){
    		$GetStatus = $db->query("select * from tbl_paopack_slider_images where img_id = '$ImgId'")->fetch_array();
			$Status = $GetStatus['img_status'];
			$SaveStatus = $Status=="active"?"inactive":"active";
    		if($db->query("update tbl_paopack_slider_images set img_status='$SaveStatus' where img_id = '$ImgId'")){
    			return TRUE;
    		}else{
    			return FALSE;
    		}
    	}
      }
	
	    /*Function To Check Similar Products - 41*/
		 function PaopackIsSimilarProducts($CategoryId,$ProductId){
		 	$db=$this->CheckConnection();
		  	 if($db){
		  	 	$QueryToFetchProductDetails = $db->query("select * from tbl_pao_products where category_id = '$CategoryId' and product_id!='$ProductId' order by category_id desc");
				if($QueryToFetchProductDetails->num_rows>0){
					return TRUE;
				}else{
					return FALSE;
				}
		  	 }
		 }
		 
		 /*Function to Get Cart Details for Executives - 42*/
		 function PaopackCartDetailsForExecutive(){
		 	$db=$this->CheckConnection();
			if($db){
				$CartDetails = json_decode($this->PaopackCartProductDetails());
				$products_array=array();
				foreach($CartDetails as $Product){
					$QueryToGetIds = $db->query("select * from tbl_pao_products where product_id = '".$Product->ProductId."'")->fetch_array();
					$products_array[]=array("ProductId"=>$Product->ProductId,"SubcatId"=>$QueryToGetIds['subcategory_id'],"CatId"=>$QueryToGetIds['category_id'],"SubcatName"=>$this->PaopackGetSubcategoryName($QueryToGetIds['subcategory_id']),"CatName"=>$this->GetCategoryName($QueryToGetIds['category_id']),"ProductWt"=>$QueryToGetIds['product_wt'],"ProductName"=>$QueryToGetIds['product_name'],"Count"=>$Product->Count,"TotalWt"=>$Product->Count*$QueryToGetIds['product_wt'],"Unit"=>explode(" ", $QueryToGetIds['product_wt'])[1]);	
				}
				return json_encode($products_array);
			}
		 }
		 
		 /*Function to get Subcategory name via SubId - 43*/
		 function PaopackGetSubcategoryName($SubcatId){
		 	$db=$this->CheckConnection();
			if($db){
				$QueryToFetchName = $db->query("select * from tbl_pao_product_subcategories where subcategory_id = '$SubcatId'")->fetch_array();
				$SubcategoryTitle = $QueryToFetchName['subcategory_title'];
				return $SubcategoryTitle;
			}else{}
		 }
		 
		  /*Function to Get CatId , SubcatId via ProdId - 44*/
		 function PaopackProductDetailsViaProductId($ProductId){
		 	$db=$this->CheckConnection();
			if($db){
				$QueryToGetIds = $db->query("select * from tbl_pao_products where product_id = '$ProductId'")->fetch_array();
				$SubcatId = $QueryToGetIds['subcategory_id'];
				$CatId = $QueryToGetIds['category_id'];
				$CatName = $this->GetCategoryName($CatId);
				$SubcatName = $this->PaopackGetSubcategoryName($SubcatId);
				$products_array=array();
				
			}
		 }
		 
		 /*Function to Count Total Pending Orders - 45*/
		 function PaopackCountIds($Type){
		 	$db=$this->CheckConnection();
			if($db){
				switch($Type){
					case "Users":
						  $QueryToCount = $db->query("select count(user_id) from tbl_pao_user_registration")->fetch_array();
				          return $QueryToCount[0];
						break;
					case "PendingOrders":
						  $QueryToCount = $db->query("select count(order_id) from tbl_pao_pending_orders")->fetch_array();
				          return $QueryToCount[0];
						break;
					case "CompletedOrders":
						  $QueryToCount = $db->query("select count(order_id) from tbl_order_status where order_status='completed'")->fetch_array();
				          return $QueryToCount[0];
						break;
					case "Categories":
						  $QueryToCount = $db->query("select count(category_id) from tbl_pao_product_categories")->fetch_array();
				          return $QueryToCount[0];
						break;
					default:	
				}
			}
		 }
		 
		 /*Function to Check Products - 46*/
		 function PaopackIsAdminAddedProducts(){
		 	$db=$this->CheckConnection();
			if($db){
				$ProductsCount = $db->query("select * from tbl_pao_products");
				if($ProductsCount->num_rows>0){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		 }
		 
		 /*Function to Check Hot Offers - 47*/
		 function PaopackIsHotOffersAvailable(){
		 	$db=$this->CheckConnection();
			if($db){
				$ProductsCount = $db->query("select * from tbl_pao_products where product_type='Hot Offers'");
				if($ProductsCount->num_rows>0){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		 }
		 
		 /*Function to Fetch Completed Orders - 48*/
		 function PaopackResgiterExecutive(){
		 	$db=$this->CheckConnection();
			if($db){
				$Name = $_POST['exe_name'];
				$Email = $_POST['exe_email'];
				$Password = base64_encode($_POST['exe_password']);
				$Location = $_POST['exe_location'];
				$City = $_POST['exe_city'];
				$State = $_POST['exe_state'];
				if($db->query("insert into tbl_executives_registration values('','$Name','$Email','$Password','$Location','$City','$State','active',NOW())")){
					return true;
				}else{
					return FALSE;
				}
			}
		 }
		 
		 /*function to get All Executives - 49*/
		 function PaopackGetAllExecutives(){
		 	$db=$this->CheckConnection();
			if($db){
				$json=array();
				$QueryToGetExecutives = $db->query("select * from tbl_executives_registration");
				if($QueryToGetExecutives->num_rows>0){
					while($Exe = $QueryToGetExecutives->fetch_array()){
						$json[]=array("ExeId"=>$Exe['exe_id'],"ExeName"=>$Exe['exe_name'],"ExeEmail"=>$Exe['exe_email'],"ExeCity"=>$Exe['exe_city']."/".$Exe['exe_state'],"ExeAddress"=>$Exe['exe_location']);
					}
					return json_encode($json);
				}else{}
			}
		 }
		 
		 /*Function to Delete Executive via Executive Id - 50*/
		 function PaopackDeleteExecutive($ExecutiveId){
		 	$db=$this->CheckConnection();
			if($db){
				if($db->query("delete from tbl_executives_registration where exe_id = '$ExecutiveId'")){
					return true;
				}else{
					return FALSE;
				}
			}
		 }
		 
		 /*Function to Count Executives - 51*/
		 function PaopackCountExecutives(){
		 	$db=$this->CheckConnection();
			if($db){
				$QueryToCount = $db->query("select count(exe_id) from tbl_executives_registration")->fetch_array();
				if($QueryToCount[0]>0){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		 }
		 
		 /*Function to Select Unique User Id via City - 52*/
		 function PaopackUsersNearByCity($City){
		 	$db=$this->CheckConnection();
			if($db){
				$QueryToSelectUsers = $db->query("select distinct(user_id) from tbl_pao_saved_delivery_address where user_city like '%".$City."%'");
				$UsersArray = array();
				if($QueryToSelectUsers->num_rows>0){
					while($User = $QueryToSelectUsers->fetch_array()){
						$UsersArray[]=array("UserId"=>$User[0]);
					}
					return json_encode($UsersArray);
				}else{
					return 0;
				}
			}
		 }
		 
		 /*Function to Place Paopack Order - 53*/
		 function PaopackPlaceOrder(){
		 	$db=$this->CheckConnection();
			if($db){
				$SelectCartId = $SelectProducts = $db->query("select cart_id from tbl_pao_cart_products where ip_address = '".$this->PaopackClientIp()."'");
				if($SelectCartId->num_rows>0){
					$CartIdDatas = $SelectCartId->fetch_array();
					$CartId = $CartIdDatas[0];
					$LoginId = $db->query("select * from tbl_pao_user_registration where user_email = '".$_SESSION['LoggedEmail']."'")->fetch_array();
					$Id = $LoginId['user_id'];
					if($db->query("insert into tbl_pao_pending_orders values('','".$Id."','$CartId',NOW())")){
						return TRUE;
					}else{
						return FALSE;
					}
				}
			}
		 }
		 
		 /*Function to Keep Track of Order Location - 54*/
		 function PaopackUserLocationProductDetails($City){
		 	$db=$this->CheckConnection();
				if($db){
					$SelectUser = json_decode($this->PaopackUsersNearByCity($City));
					if($SelectUser!=0){
						foreach($SelectUser as $FilterUser){
							$QueryToFindCartId = $db->query("select * from tbl_pao_pending_orders where user_id='".$FilterUser->UserId."'")->fetch_array();
							$CartId = $QueryToFindCartId['cart_id'];
							$CartDetails = json_decode($this->PaopackGetCartViaCartId($CartId));
							$products_array=array();
							foreach($CartDetails as $Product){
										$QueryToGetIds = $db->query("select * from tbl_pao_products where product_id = '".$Product->ProductId."'")->fetch_array();
										$products_array[]=array("ProductId"=>$Product->ProductId,"SubcatId"=>$QueryToGetIds['subcategory_id'],"CatId"=>$QueryToGetIds['category_id'],"SubcatName"=>$this->PaopackGetSubcategoryName($QueryToGetIds['subcategory_id']),"CatName"=>$this->GetCategoryName($QueryToGetIds['category_id']),"ProductWt"=>$QueryToGetIds['product_wt'],"ProductName"=>$QueryToGetIds['product_name'],"Count"=>$Product->Count,"TotalWt"=>$Product->Count*$QueryToGetIds['product_wt'],"Unit"=>explode(" ", $QueryToGetIds['product_wt'])[1]);	
							}
						}
                       return json_encode($products_array);
						
					}
				}
		 }

        /*Function to Get Executive Details - 55*/ 
		function PaopackGetExecutiveDetails($ExeEmail){
			$db=$this->CheckConnection();
			if($db){
				$exe_json = array();
				$QueryToGetDetails = $db->query("select * from tbl_executives_registration where exe_email = '".$ExeEmail."'");
				$Details = $QueryToGetDetails->fetch_array();
				$exe_json[]=array("ExeId"=>$Details['exe_id'],"ExeName"=>$Details['exe_name'],"ExeEmail"=>$Details['exe_email'],"ExeCity"=>$Details['exe_city'],"ExeState"=>$Details['exe_state']);
				return json_encode($exe_json);
			}
		} 
		
		/*Function to Make Cart via Location - 56*/
		function PaopackGetCartViaCartId($CartId){
			$db=$this->CheckConnection();
				if($db){
					$SelectProducts = $db->query("select * from tbl_pao_cart_products where cart_id = '$CartId'");
					if($SelectProducts->num_rows>0){
						$ProductDetails = $SelectProducts->fetch_array();
						$Numbers = $ProductDetails[1];
						$ProductIds = array_count_values(explode(",",$Numbers));
						$CartDetailsJson = array();
						foreach($ProductIds as $ProdId=>$Count){
							$ProductId = $ProdId;
							$ProductDetailsFromQuickView = json_decode($this->PaopackQuickViewProduct($ProductId));
							foreach($ProductDetailsFromQuickView as $QuickView){
								$CartDetailsJson[]=array("Count"=>$Count,"ProductName"=>$QuickView->ProductName,"ProductImage"=>$QuickView->ProductImage,"Price"=>$QuickView->ProductDiscount,"ProductId"=>$ProductId,"Original"=>$QuickView->ProductPrice);
							}
						}
						return json_encode($CartDetailsJson);
					}else{
						return 0;
					}
				}
		}
		
		/*Sending Order Confirmation to User - 57 */
		function PaopackConfirmOrderSendMail($UrlValue){
			$MailId = parent::MyEmailAddress();
			$to = $_SESSION['LoggedEmail'];
			$subject = "Your Order Confirmation";
			$txt = "Order has been placed Successfully , Product will be delivered within 3 days. Thank you for making shop with us.You can download your order summary pdf from this link : ".parent::MyWebAddress()."pdfs/".$_SESSION['LoggedEmail'].".pdf";
			$headers = "From: ".$MailId;
			
			if(mail($to,$subject,$txt,$headers)){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/*Make PDF - 58*/
		function PaopackMadePdfFile(){
			$db=$this->CheckConnection();
			if($db){
				$CartProductDetails = json_decode($this->PaopackCartProductDetails());
			    $BuyerDetails = json_decode($this->PaopackGetLoggedUserDetails($_SESSION['LoggedEmail']));
			    $TotalCartAmount=0;$TotalProducts=0;$DiscontedAmount=0;$ClientEmail='';
				$htmlCode="
						<!DOCTYPE html>
						<html>
						<head>
						    <title>Print Invoice</title>
						    <style>
						        *
						        {
						            margin:0;
						            padding:0;
						            font-family:Arial;
						            font-size:10pt;
						            color:#000;
						        }
						        body
						        {
						            width:100%;
						            font-family:Arial;
						            font-size:10pt;
						            margin:0;
						            padding:0;
						        }
						         
						        p
						        {
						            margin:0;
						            padding:0;
						        }
						         
						        #wrapper
						        {
						            width:180mm;
						            margin:0 15mm;
						        }
						         
						        .page
						        {
						            height:297mm;
						            width:210mm;
						            page-break-after:always;
						        }
						 
						        table
						        {
						            border-left: 1px solid #ccc;
						            border-top: 1px solid #ccc;
						             
						            border-spacing:0;
						            border-collapse: collapse; 
						             
						        }
						         
						        table td 
						        {
						            border-right: 1px solid #ccc;
						            border-bottom: 1px solid #ccc;
						            padding: 2mm;
						        }
						         
						        table.heading
						        {
						            height:50mm;
						        }
						         
						        h1.heading
						        {
						            font-size:14pt;
						            color:#000;
						            font-weight:normal;
						        }
						         
						        h2.heading
						        {
						            font-size:9pt;
						            color:#000;
						            font-weight:normal;
						        }
						         
						        hr
						        {
						            color:#ccc;
						            background:#ccc;
						        }
						         
						        #invoice_body
						        {
						            height: 149mm;
						        }
						         
						        #invoice_body , #invoice_total
						        {   
						            width:100%;
						        }
						        #invoice_body table , #invoice_total table
						        {
						            width:100%;
						            border-left: 1px solid #ccc;
						            border-top: 1px solid #ccc;
						     
						            border-spacing:0;
						            border-collapse: collapse; 
						             
						            margin-top:5mm;
						        }
						         
						        #invoice_body table td , #invoice_total table td
						        {
						            text-align:center;
						            font-size:9pt;
						            border-right: 1px solid #ccc;
						            border-bottom: 1px solid #ccc;
						            padding:2mm 0;
						        }
						         
						        #invoice_body table td.mono  , #invoice_total table td.mono
						        {
						            font-family:monospace;
						            text-align:right;
						            padding-right:3mm;
						            font-size:10pt;
						        }
						         
						        #footer
						        {   
						            width:180mm;
						            margin:0 15mm;
						            padding-bottom:3mm;
						        }
						        #footer table
						        {
						            width:100%;
						            border-left: 1px solid #ccc;
						            border-top: 1px solid #ccc;
						             
						            background:#eee;
						             
						            border-spacing:0;
						            border-collapse: collapse; 
						        }
						        #footer table td
						        {
						            width:25%;
						            text-align:center;
						            font-size:9pt;
						            border-right: 1px solid #ccc;
						            border-bottom: 1px solid #ccc;
						        }
						    </style>
						</head>
						<body>
						<div id='wrapper'>
						     
						    <p style='text-align:center; font-weight:bold; padding-top:5mm;'>INVOICE</p>
						    <br /> ";
						    $CartId = '';$DateTime='';
						    foreach($CartProductDetails as $CartDetails){ $CartId=$CartDetails->CartId;$DateTime=$CartDetails->DateTime; }
						    
						    
					$htmlCode.="
					
						    <table class='heading' style='width:100%;'>
						        <tr>
						            <td style='width:80mm;'>
										<h1><img style='width: 150px;height:50px;vertical-align: baseline;margin-left: 3px;' src='images/logo.png' alt=''></h1>
						            </td>
						            <td rowspan='2' valign='top' align='right' style='padding:3mm;'>
						                <table>
						                    <tr><td>Invoice No : </td><td>".$CartId."</td></tr>
						                    <tr><td>Dated : </td><td>".$DateTime."</td></tr>
						                    <tr><td>Currency : </td><td>Rs.</td></tr>
						                </table>
						            </td>
						        </tr>
						        <tr> ";
								
								 foreach($BuyerDetails as $User){  $ClientEmail = $User->UserEmail;
									 $htmlCode.="<td>
						                <b>Buyer</b> :<br />
						                ".$User->UFirstName."  ".$User->ULastName."<br />
						            ".$User->UserAddress."
						                <br />
						                ".$User->UserCity." - ".$User->UserPincode." , ".$User->UserCountry."<br />
										".$User->UserEmail."<br/>".$User->UserMobile."
						            </td>";
								 }
							
								
						$htmlCode.="		
						            
						        </tr>
						    </table>
						         
						         
						    <div id='content'>
						         
						        <div id='invoice_body'>
						            <table> <tr style='background:#eee;'>
													<td style='width:8%;'><b>Sr.No</b></td>
													<td><b>Name</b></td>
													<td style='width:15%;'><b>Price</b></td>
													<td style='width:15%;'><b>Quantity</b></td>
													<td style='width:15%;'><b>Amount</b></td>
												</tr> </table> <table>";
									$k=1;
									foreach($CartProductDetails as $CartDetails){ 
											$TotalCartAmount+=$CartDetails->Count*$CartDetails->Original;$DiscontedAmount+=$CartDetails->Count*$CartDetails->Price;
											$TotalProducts+=$CartDetails->Count;
											$htmlCode.="	
												<tr>
													<td style='width:8%;'>".$k++."</td>
													<td style='text-align:left; padding-left:10px;'>".$CartDetails->ProductName."</td>
													<td class='mono' style='width:15%;'>".$CartDetails->Original."</td>
													<td style='width:15%;' class='mono'>".$CartDetails->Count."</td>
													<td style='width:15%;' class='mono'>".$CartDetails->Count*$CartDetails->Original."</td>
												</tr>
												";
									}
									
							
									
						   
						            $htmlCode.="<tr>
						                <td colspan='3'></td>
						                <td></td>
						                <td></td>
						            </tr>
						             <tr>
						                <td colspan='3'></td>
						                <td>Total Products:</td>
						                <td class='mono'>".$TotalProducts."</td>
						            </tr>
						            <tr>
						                <td colspan='3'></td>
						                <td>Total Amount:</td>
						                <td class='mono'>".$TotalCartAmount."</td>
						            </tr>
						            <tr>
						                <td colspan='3'></td>
						                <td>Dis. Amount:</td>
						                <td class='mono'>".$DiscontedAmount."</td>
						            </tr>
						        </table>
						        </div>
						        
						        <br />
						        <hr />
						        <br />
						         
						      
						    </div>
						     
						    <br />
						     
						    </div>
						     
						</body>
						</html>
							     ";
							     
							        include("MPDF56/mpdf.php");
	 
									$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
									 
									$mpdf->SetDisplayMode('fullpage');
									 
									$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
									 
									$mpdf->WriteHTML($htmlCode);
											 
									$mpdf->Output("pdfs/".$ClientEmail.".pdf","F");
			}
		}
        /*Get Pending Order Details - 59*/
		function PaopackGetPendingOrderDetails(){
			$db=$this->CheckConnection();
			if($db){
				$UserName = ''; $UserEmail = ''; $UserMobile = ''; $UserAddress = '';$CountProducts = '';$TotalAmount = '';
				$order_details = array();
				$QueryToFetchOrderDetails = $db->query("select * from tbl_pao_pending_orders");
				if($QueryToFetchOrderDetails->num_rows>0){
					$PendingOrderDetails = $QueryToFetchOrderDetails->fetch_array();
					$UserId = $PendingOrderDetails['user_id'];
					$CartId = $PendingOrderDetails['cart_id'];
					$UserDetails = json_decode($this->PaopackGetDetails("User", $UserId));
					$CartDetails = json_decode($this->PaopackGetDetails("Cart",$CartId));
					
					foreach($UserDetails as $uDetail){
						$UserName = $uDetail->Name;
						$UserEmail=$uDetail->Email;
						$UserAddress = $uDetail->Address;
						$UserMobile = $uDetail->Mobile;
					}
					foreach($CartDetails as $cDetails){
						$CountProducts = $cDetails->Count;
						$TotalAmount = $cDetails->Amount;
					}
					
					$order_details[]=array("Name"=>$UserName,"Email"=>$UserEmail,"Mobile"=>$UserMobile,"Address"=>$UserAddress,"TotalProducts"=>$CountProducts,"Amount"=>$TotalAmount,"Date"=>$PendingOrderDetails['order_created']);
					
					return json_encode($order_details);

					
				}else{
					
				}
			}
		}
		
		/*Get User Details via UserId - 60*/
		function PaopackGetDetails($DetailType,$Id){
			$db=$this->CheckConnection();
			if($db){
				switch ($DetailType) {
					case 'User':
						$UserArray=array();
						$QueryForUserDetails = $db->query("select * from tbl_pao_user_registration where user_id = '".$Id."'")->fetch_array();
						$SecondQueryForUser = $db->query("select * from tbl_pao_saved_delivery_address where user_id = '".$Id."' order by user_id desc limit 1")->fetch_array();
						$UserArray[]=array("UserId"=>$QueryForUserDetails[0],"Name"=>$QueryForUserDetails[2]." ".$QueryForUserDetails[3],"Email"=>$QueryForUserDetails[4],"Address"=>$SecondQueryForUser[2],"Mobile"=>$SecondQueryForUser[6]);
						return json_encode($UserArray);
						break;
						
					case 'Cart':
						$CartArray=array();
						$QueryForCartDetails = $db->query("select * from tbl_pao_cart_products where cart_id='".$Id."'")->fetch_array();
						$TotalIds = explode(",", $QueryForCartDetails['product_ids']);
						$TotalAmount = 0;
						foreach($TotalIds as $Id){
							$QueryForAmount = $db->query("select * from tbl_pao_products where product_id = '$Id'")->fetch_array();
							$TotalAmount+=$QueryForAmount['product_discount'];
							
						}
						$CartArray[]=array("Count"=>count(explode(",", $QueryForCartDetails['product_ids'])),"Amount"=>"$TotalAmount");
						return json_encode($CartArray);
						break;
						
					default:
						
						break;
				}
			}
		}
        /*Function to Check whether pending order are there or not - 61*/
        function PaopackIsPendingOrderPresent(){
        	$db=$this->CheckConnection();
        	if($db){
        		$QueryToCheckPendingOrderTable = $db->query("select count(order_id) from tbl_pao_pending_orders");
				if($QueryToCheckPendingOrderTable->num_rows>0){
					return true;
				}else{
					return FALSE;
				}
        	}
        }	
  }

  
?>