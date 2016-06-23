<?php include_once '../inc/autoload.php'; if(!isset($_SESSION['AdminEmail'])){header("location:index.php"); } $PageView=$paopack->GetPageView(isset($_GET['view'])?$_GET['view']:""); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <title>Dashboard - Paopack Admin Panel</title>
  <link rel="shortcut icon" type="image/png" href="../images/p_paopack.png"/>
 <link rel="stylesheet" type="text/css" href="font-awesome/font-awesome.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <?php $layout->PaopackAdminPanelHeaderFiles(); ?>
  
  <script type="text/javascript">
  $(document).ready(function() 
      { 
          $(".tablesorter").tablesorter(); 
          
     } 

  );
  
  $(document).ready(function() {

  //When page loads...
  $(".tab_content").hide(); //Hide all content
  $("ul.tabs li:first").addClass("active").show(); //Activate first tab
  $(".tab_content:first").show(); //Show first tab content

  //On Click Event
  $("ul.tabs li").click(function() {

    $("ul.tabs li").removeClass("active"); //Remove any "active" class
    $(this).addClass("active"); //Add "active" class to selected tab
    $(".tab_content").hide(); //Hide all tab content

    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
  });

});
    </script>
<script>
    $(document).ready(function() {
         $(".up").click(function(){
         var $incdec = $(this).prev();
         
          $incdec.val(parseInt($incdec.val())+1);
        
});
$(".down").click(function(){
      var $incdec = $(this).next();
        if(parseInt($incdec.val())>1){
        $incdec.val(parseInt($incdec.val())-1);
      }
     });
});
</script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
        $('#MessageTxt').delay(2000).fadeOut('slow');
        $('#product_category').change(function(){
          $.ajax({
            url:"ajax/paopack_filter_subcat.php",
            data:{id:$(this).val()},
            type:"post",
            dataType:"json",
            success:function(response){
              console.log(response);
              var result="";
           $.each(response,function(i,item){
             result+="<option value='"+item.SubcategoryId+"'>"+item.SubcategoryTitle+"</option>";
           });
               $('#product_subcategory').html(result); 
            }
          });
        });
    });
</script>

<style>
header#header{
 background: #8BC34A;
}
header#header h2.section_title{
    background: #8BC34A
}
</style>

</head>


<body>
  <header id="header">
    <hgroup>
      <h1 class="site_title"><a href="index.html">Paopack Admin</a></h1>
      <h2 class="section_title">Dashboard</h2><div class="btn_view_site"><a href="../" target="_blank">View Site</a></div>
    </hgroup>
  </header> <!-- end of header bar -->
  
  <?php $layout->PaopackAdminHomeSidebar(); ?>
  
  <!-- end of sidebar -->
  
  <section id="main" class="column">
    
    <h4 class="alert_info">Welcome to the Admin Panel of Paopack Fresh Market .</h4>
    
    <div class="clear"></div>
        <?php /*View New Product*/ if($PageView=="PaopackNewProduct"){ ?>

        <article class="module width_full">
      <header><h3>Post New Product</h3></header>
        <form method="post" enctype="multipart/form-data">
             
            <div class="module_content">
               <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
               <fieldset>
                <label>Product Type</label>
                <select style="width:92%;"  name="product_type">
                  <option value="Sabse Sasta">Sabse Sasta</option>
                  <option value="Hot Offers">Hot Offers</option>
                  <option value="Combo Offers">Combo Offers</option>
                  <option value="Fresh Arrival">Fresh Arrival</option>
                </select>
              </fieldset>
              <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Category</label>
                <select style="width:92%;"  name="product_category" id="product_category">
                  <?php $Categories = json_decode($paopack->GetCategories());$i=1;foreach($Categories as $Cat) { ?>
                     <option value="<?php echo $Cat->CategoryId; ?>"><?php echo $Cat->CategoryTitle; ?></option>
                  <?php } ?>
                </select>
              </fieldset>
              <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Subcategory</label>
                <select style="width:92%;"  name="product_subcategory" id="product_subcategory">
                  
                </select>
              </fieldset>
              <fieldset>
                <label>Product Name</label>
                <input type="text" name="product_name" required="">
              </fieldset>
              <fieldset>
                <label>Product Description</label>
                <textarea rows="12" name="product_description" required></textarea>
              </fieldset>
              
              <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Weight</label>
                <input type="text" style="width:92%;" name="product_weight" required>
              </fieldset>
              <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Price (Rs)</label>
                <input type="text" style="width:92%;" name="product_price" required/>
              </fieldset>
              <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Discounted Price (Rs)</label>
                <input type="text" name="product_discount_price" style="width:92%;" required>
              </fieldset>
              <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Choose Product Image :</label>
                <input type="file" name="product_image" style="width:92%;" required>
              </fieldset>
              <fieldset style="width:48%; float:right;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Product Condition :</label>
                <input type="text" name="product_condition" style="width:92%;" required>
              </fieldset>
              <div class="clear"></div>
          </div>
          <footer>
            <div class="submit_link">
              <input type="submit" value="+ Add Product" class="alt_btn" name="btnAddProduct">
            </div>
          </footer>
        </form>
    </article><!-- end of post new article -->
    
        <?php }/*View Show All Products*/ else if($PageView=="PaopackShowAllProduct"){ ?>
        
        <article class="module width_full">
                 
    <header><h3 class="tabs_involved">List of All Products  <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span></h3></header>
    <div class="tab_container">
      <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th>Sr.No</th> 
            <th>Product Name</th> 
            <th>Category Name</th> 
            <th>Product Wt</th> 
            <th>Price (Rs)</th> 
            <th>Discounted Price (Rs)</th>
            <th>Action</th>
        </tr> 
      </thead> 
      <tbody> 
        <?php if($paopack->PaopackIsAdminAddedProducts()){ $Products = json_decode($paopack->PaopackGetProducts("All"));$i=1;foreach($Products as $Product) { ?>
        <tr> 
            <td><?php echo $i++; ?></td> 
            <td><?php echo $Product->ProductName; ?></td> 
            <td><?php echo $Product->CategoryName; ?></td> 
            <td><?php echo $Product->ProductWt; ?></td> 
            <td><?php echo $Product->ProductPrice; ?></td>
            <td><?php echo $Product->ProductDiscount; ?></td>
            <td><a href="dashboard.php?view=<?php echo base64_encode('PaopackEditProduct') ?>&pid=<?php echo base64_encode($Product->ProductId)."_".base64_encode("PaopackProductId"); ?>"  title="Edit">
              <img src="images/icn_edit.png" /></a> &nbsp;&nbsp;&nbsp;&nbsp;
              <a href="dashboard.php?view=<?php echo base64_encode('PaopackShowAllProduct') ?>&delid=<?php echo base64_encode($Product->ProductId); ?>" title="Trash" onclick="return confirm('Are you sure want to delete ?')"><img src="images/icn_trash.png" /></a></td> 
        </tr> 
        <?php } }?>
      </tbody> 
      </table>
      </div><!-- end of #tab1 -->
      
    </div><!-- end of .tab_container -->
    
    </article><!-- end of content manager article -->
        
        <?php }/*View Product Edit Module*/else if($PageView=="PaopackEditProduct"){ $UrlProductId = base64_decode(explode("_", $_GET['pid'])[0]); if(!empty($UrlProductId)){
          $GetProductDetails = json_decode($paopack->PaopackQuickViewProduct($UrlProductId));  } $Name ='';$Desc='';$Price='';$Discount='';$Wt='';$Cat='';$Condition='';
          foreach($GetProductDetails as $Details){ $Name=$Details->ProductName;$Desc=$Details->ProductDescription;$Price=$Details->ProductPrice;$Condition=$Details->ProductCondition;$Discount=$Details->ProductDiscount;$Wt=$Details->ProductWt; } ?>
          
        <article class="module width_full">
      <header><h3>Edit Product</h3></header>
      <form method="post" enctype="multipart/form-data">
        <div class="module_content">
           <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
            <fieldset>
                <label>Product Type</label>
                <select style="width:92%;"  name="product_type">
                  <option value="Sabse Sasta">Sabse Sasta</option>
                  <option value="Hot Offers">Hot Offers</option>
                  <option value="Combo Offers">Combo Offers</option>
                  <option value="Fresh Arrival">Fresh Arrival</option>
                </select>
              </fieldset>
              <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Category</label>
                <select style="width:92%;"  name="product_category" id="product_category">
                  <?php $Categories = json_decode($paopack->GetCategories());$i=1;foreach($Categories as $Cat) { ?>
                     <option value="<?php echo $Cat->CategoryId; ?>"><?php echo $Cat->CategoryTitle; ?></option>
                  <?php } ?>
                </select>
              </fieldset>
              <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Subcategory</label>
                <select style="width:92%;"  name="product_subcategory" id="product_subcategory">
                  
                </select>
              </fieldset>
            <fieldset>
              <label>Product Name</label>
              <input type="text" value="<?php echo $Name; ?>" name="product_name">
            </fieldset>
            <fieldset>
              <label>Product Description</label>
              <textarea rows="12" name="product_description"><?php echo $Desc; ?></textarea>
            </fieldset>
            
            <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
              <label>Weight</label>
              <input type="text" style="width:92%;" value="<?php echo $Wt; ?>" name="product_weight">
            </fieldset>
            <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
              <label>Price (Rs)</label>
              <input type="text" style="width:92%;" value="<?php echo $Price; ?>" name="product_price">
            </fieldset>
            <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
              <label>Discounted Price (Rs)</label>
              <input type="text" style="width:92%;" value="<?php echo $Discount; ?>" name="product_discount_price">
            </fieldset>
            <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Choose Product Image :</label>
                <input type="file" name="product_image" style="width:92%;" required name="product_image">
              </fieldset>
              <fieldset style="width:48%; float:right;"> <!-- to make two field float next to one another, adjust values accordingly -->
                <label>Product Condition :</label>
                <input type="text" name="product_condition" style="width:92%;" required value="<?php echo $Condition; ?>" name="product_condition">
              </fieldset>
            <div class="clear"></div>
        </div>
      <footer>
        <div class="submit_link">
          <input type="submit" value="Update" class="alt_btn" name="btnUpdateProduct">
        </div>
      </footer>
      </form>
    </article><!-- end of post new article -->
        <?php }/*View Add Category Module*/else if($PageView=="PaopackNewCategory"){ ?>
          <article class="module width_full">
      <header><h3>Post New Category</h3></header>
      <form method="post">
          <div class="module_content">
             <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
            <fieldset>
              <label>Category Name</label>
              <input type="text" name="category_title" required="">
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
          <div class="submit_link">
            <input type="submit" value="+ Add Category" class="alt_btn" name="btnAddCategory">
          </div>
        </footer>
      </form>
    </article><!-- end of post new article -->
        <?php }/*View Show All Category*/else if($PageView=="PaopackShowAllCategory"){ ?> 
        <article class="module width_full">
    <header><h3 class="tabs_involved">List of All Categories  <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span></h3></header>

    <div class="tab_container">
      <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th>Sr.No</th> 
            <th>Category Name</th> 
            <th>Action</th>
        </tr> 
      </thead> 
      <tbody> 
        <?php $Categories = json_decode($paopack->GetCategories());$i=1;foreach($Categories as $Cat) { ?>
        <tr> 
            <td><?php echo $i++; ?></td> 
            <td><?php echo $Cat->CategoryTitle; ?></td>
              <td>
              <a href="dashboard.php?view=<?php echo base64_encode('PaopackEditCategory') ?>&cid=<?php echo base64_encode($Cat->CategoryId)."_".base64_encode("PaopackProductId"); ?>"  title="Edit">
              <img src="images/icn_edit.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="dashboard.php?view=<?php echo base64_encode('PaopackShowAllCategory') ?>&catid=<?php echo base64_encode($Cat->CategoryId); ?>" title="Trash" onclick="return confirm('Are you sure want to delete ?')"><img src="images/icn_trash.png" /></a></td> 
        </td> 
          </tr> 
        <?php } ?>
      </tbody> 
      </table>
      </div><!-- end of #tab1 -->
      
    </div><!-- end of .tab_container -->
    
    </article><!-- end of content manager article -->
        <?php }/*Edit Category*/ else if($PageView=="PaopackEditCategory"){ ?>
        <article class="module width_full">
      <header><h3>Post New Category</h3></header>
      <form method="post">
          <div class="module_content">
             <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
            <fieldset>
              <label>Category Name</label>
              <input type="text" name="category_title" required="" value="<?php echo $paopack->GetCategoryName(base64_decode(explode("_", (isset($_GET['cid'])?$_GET['cid']:""))[0])); ?>">
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
          <div class="submit_link">
            <input type="submit" value="Save" class="alt_btn" name="btnUpdateCategory">
          </div>
        </footer>
      </form>
    </article><!-- end of post new article -->
        <?php  }/*Add New Subcategory Module*/else if($PageView=="PaopackNewSubcategory"){ ?>
          <article class="module width_full">
      <form method="post">
        <header><h3>Post New Subcategory</h3></header>
        <div class="module_content">
           <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
           <fieldset > <!-- to make two field float next to one another, adjust values accordingly -->
              <label>Category</label>
              <select style="width:92%;"  name="product_category">
                  <?php $Categories = json_decode($paopack->GetCategories());$i=1;foreach($Categories as $Cat) { ?>
                     <option value="<?php echo $Cat->CategoryId; ?>"><?php echo $Cat->CategoryTitle; ?></option>
                  <?php } ?>
              </select>
            </fieldset>
            <fieldset>
              <label>Subcategory Name</label>
              <input type="text" name="subcategory_title" required="">
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
          <div class="submit_link">
            <input type="submit" value="+ Add Subcategory" class="alt_btn" name="btnAddSubcategory">
          </div>
        </footer>
      </form>
    </article><!-- end of post new article -->
        <?php }/*View Show All Category*/else if($PageView=="PaopackShowAllSubcategory"){ ?>  
        <article class="module width_full">
    <header><h3 class="tabs_involved">List of All Subcategories  <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span></h3>
    </header>

    <div class="tab_container">
      <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th>Sr.No</th> 
            <th>Category Name</th> 
            <th>Subcategory Name</th> 
            <th>Action</th>
        </tr> 
      </thead> 
      <tbody> 
        <?php $Subcategories = json_decode($paopack->GetAllSubcategory());$i=1;foreach($Subcategories as $Subcat) { ?>
        <tr> 
            <td><?php echo $i++; ?></td> 
            <td><?php echo $Subcat->CategoryName; ?></td> 
            <td><?php echo $Subcat->SubcategoryTitle; ?></td> 
            <td><a href="dashboard.php?view=<?php echo base64_encode('PaopackShowAllSubcategory') ?>&subcatid=<?php echo base64_encode($Subcat->SubcategoryId); ?>" title="Trash" onclick="return confirm('Are you sure want to delete ?')"><img src="images/icn_trash.png" /></a></td> 
        </tr> 
        <?php } ?>
      </tbody> 
      </table>
      </div><!-- end of #tab1 -->
      
    </div><!-- end of .tab_container -->
    
    </article><!-- end of content manager article -->
        <?php }/*View Profile of Logged User*/else if($PageView=="PaopackUserProfile"){ ?>
        <article class="module width_full">
      <form method="post">
        <header><h3>Logged Admin Profile</h3></header>
        <div class="module_content">
          <?php $AdminDetails = json_decode($paopack->PaopackAdminDetails($_SESSION['AdminEmail']));foreach($AdminDetails as $Detail){ ?>
           <fieldset > 
              <label>Name</label>
              <input type="text" value="<?php echo $Detail->Name; ?>" readonly>
            </fieldset>
            <fieldset>
              <label>Email</label>
              <input type="text" value="<?php echo $Detail->Email; ?>" readonly>
            </fieldset>
            <div class="clear"></div>
            <?php } ?>
        </div>
        
      </form>
    </article><!-- end of post new article -->
        <?php }/**/else if($PageView=="PaopackNewSliderImage"){ ?>  
          <article class="module width_full">
          
      <header><h3>Post New Slider Image</h3></header>
      <form method="post" enctype="multipart/form-data">
          <div class="module_content">
             <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
             <fieldset>
              <label>Note : </label>
              <div>1 . Image Must be (.jpg | .gif | .png) <br/> 2 . Image Resolution must be (width X height = 770 X 255 px) . <br/></div>
            </fieldset>
            <fieldset>
              <label>Add Image</label>
              <input type="file" name="slider_image" required="">
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
          <div class="submit_link">
            <input type="submit" value="+ Add Image" class="alt_btn" name="btnAddSliderImage">
          </div>
        </footer>
      </form>
    </article><!-- end of post new article -->
        <?php }/*Show All Slider Image*/else if($PageView=="PaopackAllSliderImage"){ ?> 
        <article class="module width_full">
    <header><h3 class="tabs_involved">List of All Images  <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span></h3>
    </header>

    <div class="tab_container">
      <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th>Sr.No</th> 
            <th>Image</th> 
            <th>Status</th> 
            <th>Action</th>
        </tr> 
      </thead> 
      <tbody> 
        <?php $Images = json_decode($paopack->PaopackGetSliderImages("All"));$i=1;foreach($Images as $Subcat) { ?>
        <tr> 
            <td><?php echo $i++; ?></td> 
            <td><img src="../<?php echo $Subcat->ImageData; ?>" style="height: 70px;width:140px;" /></td> 
            <td><?php echo $Subcat->ImageStatus; ?></td> 
            <td><a href="dashboard.php?view=<?php echo base64_encode('PaopackAllSliderImage') ?>&imgid=<?php echo base64_encode($Subcat->ImageId);?>"  title="Toggle Status">
              <img src="images/icn_edit.png" /></a> </td> 
        </tr> 
        <?php } ?>
      </tbody> 
      </table>
      </div><!-- end of #tab1 -->
      
    </div><!-- end of .tab_container -->
    
    </article><!-- end of content manager article -->
        <?php }/*Function to Create Executives*/ else if($PageView=="PaopackNewExecutives"){ ?>
          <article class="module width_full">
        <header><h3>Add New Executive</h3></header>
          <form method="post" enctype="multipart/form-data">
               
              <div class="module_content">
                <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
                <fieldset>
                  <label>Executive Name</label>
                  <input type="text" name="exe_name" style="width:92%;" required>
                </fieldset>
                
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                  <label>Email Address</label>
                  <input type="text" name="exe_email" style="width:92%;" required>
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                  <label>Password</label>
                  <input type="password" name="exe_password" style="width:92%;" required>
                </fieldset>
                
                
                <fieldset>
                  <label>Executive Location</label>
                  <input type="text" name="exe_location" style="width:92%;" required>
                </fieldset>
                
                <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                  <label>City</label>
                  <input type="text" name="exe_city" style="width:92%;" required>
                </fieldset>
                <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
                  <label>State</label>
                  <input type="text" name="exe_state" style="width:92%;" required>
                </fieldset>
                
                <div class="clear"></div>
            </div>
            <footer>
              <div class="submit_link">
                <input type="submit" value="+ Add Executive" class="alt_btn" name="btnAddExecutive">
              </div>
            </footer>
          </form>
      </article><!-- end of post new article -->
        <?php  }/*Show All Executives*/ else if($PageView=="PaopackShowAllExecutives"){ ?>
        <article class="module width_full">
    <header><h3 class="tabs_involved">List of All Executives  
      <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span></h3></header>

    <div class="tab_container">
      <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0"> 
      <thead> 
        <tr> 
            <th>Sr.No</th> 
            <th>Name</th> 
            <th>Email</th>
            <th>Address</th>
            <th>City/State</th>
            <th>Action</th>
        </tr> 
      </thead> 
      <tbody> 
        <?php if($paopack->PaopackCountExecutives()){ $Executives = json_decode($paopack->PaopackGetAllExecutives()); $i=1; foreach($Executives as $Exe){ ?>
        <tr> 
            <td><?php echo $i++; ?></td> 
            <td><?php echo $Exe->ExeName; ?></td> 
            <td><?php echo $Exe->ExeEmail; ?></td> 
            <td><?php echo $Exe->ExeAddress; ?></td> 
            <td><?php echo $Exe->ExeCity; ?></td> 
            <td><a href="dashboard.php?view=<?php echo base64_encode('PaopackShowAllExecutives') ?>&exeid=<?php echo base64_encode($Exe->ExeId); ?>" title="Trash" onclick="return confirm('Are you sure want to delete ?')"><img src="images/icn_trash.png" /></a></td>
        </tr> 
        <?php }} ?>
      </tbody> 
      </table>
      </div><!-- end of #tab1 -->
      
    </div><!-- end of .tab_container -->
    
    </article><!-- end of content manager article -->
        <?php }/*family package*/else if($PageView=="PaopackFamilyPackage"){ ?>
<article class="module width_full">
  <form method="post">
    <header><h3>Family Package</h3></header>
    <div class="">
    <?php $AdminDetails = json_decode($paopack->PaopackAdminDetails($_SESSION['AdminEmail']));foreach($AdminDetails as $Detail){ ?>
    <fieldset id="mySelect1">
 
      <label>Family Size</label>
      <h1 style="    float: right;margin-right: 676px;margin-top: 47px;">No of Female</h1>
      <select name="Female_size" style="width: 9%;margin-top: 20px;border: 1px solid #bbb;height: 20px;color: #666666;margin-left: 14px;" >
              <option value="0">0</option> 
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
          </select>

          <h1 style="float: left;margin-left: 10px;margin-top: 22px;">No of Male</h1>
          <select name="male_size"   style="float: right;margin-right: -192px;margin-top: 19px;" form="carform">
               <option value="0">0</option> 
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>                                           
          </select>

          <h1 style="float: right;margin-right: -305px; margin-top: 22px; ">No of Children</h1>
      <select name="child_size"  style="margin-top: 19px;float: right;margin-right: -407px;" form="carform">
              <option value="0">0</option> 
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
          </select>
      <h1 style="    float: right;margin-right: -525px; margin-top: 20px; ">No of Babies</h1>
      <select name="babies_size"  style="  margin-top: 19px!important;  float: right;margin-right: -624px;" form="carform">
              <option value="0">0</option> 
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>              
          </select>
     
      

    </fieldset>
   
           <fieldset id="show">

        <?php
           
            
            mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
            mysql_select_db("a132cbmz_paopackfreshmarket");
       ?>
         <label>Product List</label>
           <input type="submit" value="Show Package" class="alt_btn" onclick="showItems()" style="float: right;margin-right:10px;margin-top: 10px;" >
               <form method="post" action="">
      <span style="font-weight: bold;margin-left: -200px;padding-top: 25px;display: inline-block;">Select Category</span>
         <select name="category" > 
     <?php 
       $QueryToSelectCategory=mysql_query("Select * from tbl_pao_product_categories");
       if(mysql_num_rows($QueryToSelectCategory)>0)
       {
         while($cat=mysql_fetch_array($QueryToSelectCategory))
         {
            print "<option value='".$cat['category_id']."'>".$cat['category_title']."</option>";
            


         }
       }
       else
       {}
    ?>
         </select>
<span style="font-weight: bold;padding-top: 25px;margin-left: 30px;display: inline-block;">Select Sub-Category</span>
         <select name="subcategory" > 
         <?php 
       $QueryToSelectSubCategory=mysql_query("Select * from tbl_pao_product_subcategories");
       if(mysql_num_rows($QueryToSelectSubCategory)>0)
       {
         while($cat=mysql_fetch_array($QueryToSelectSubCategory))
         {
            print "<option value='".$cat['subcategory_id']."'>".$cat['subcategory_title']."</option>";
            


         }
       }
       else
       {}
    ?>
         </select>
<input type="submit" name="btnshowproduct" class="alt_btn" value="Show Products" >

        <?php

         if(isset($_POST['btnshowproduct']))
           {
  
            $cat=$_POST['category'];
            $sub=$_POST['subcategory'];
     
                                $i=1;

            print "<table style='margin-top: 35px;margin-left: 7px;'>
         <tr>
         <th style='padding-right: 8px;padding-left: 19px;'>Sr. No.</th>
         <th style='padding-right: 20px;padding-left: 15px;'>Product Image</th>
         <th style='padding-right: 20px;padding-left: 19px;'>Product Name</th>
         <th style='padding-right: 20px;padding-left: 19px;'>Product Condition</th>
         <th style='padding-right: 20px;padding-left: 19px;'>Prduct Weight</th>
         <th style='padding-right: 14px;padding-left: 12px;'>Price</th>
         <th style='padding-right: 20px;padding-left: 32px;'>Qty</th>
         <th>Action</th>

         </tr>";
            $SelectQuery=mysql_query("select * from tbl_pao_products where category_id='$cat' AND subcategory_id='$sub'");
            while($Result=mysql_fetch_array($SelectQuery))
            {
                         
               $product_id=$Result['product_id'];
               $product_name=$Result['product_name'];
               $product_cond=$Result['product_condition'];
               $product_wt=$Result['product_wt'];
               $product_price=$Result['product_discount'];
               $product_img=$Result['product_image'];
               print "<input type='hidden' value='";
               echo $product_id;
               print "'><tr style='text-align: center;'><td>";
               echo $i;
               print "</td><td><img src='";
               echo $product_img;
               print "' style='height:50px;width:50px;'></td><td>";
               echo $product_name;
               print "</td><td>";
               echo $product_cond;
               print "</td><td>";
               echo $product_wt;
               print "</td><td>";
               echo $product_price;
               print "</td><td style='padding-left: 30px;'><p><input type='button' class='down' style='display: inline-block;float: left;margin-left: -12px;margin-top: 2px;' value='-' /><input type='text' class='incdec' value='1' style='width: 29px;padding-left: 17px;'/><input type='button' class='up' value='+' style='display: inline-block;margin-left: 2px;margin-top: 2px;'/></p></td><td><input type='submit' class='alt_btn' value='+ Add' style='margin-left: 20px;'  name='btnAddProductToPackage'><input type='submit' value='Delete' style='margin-left: 15px;' class='alt_btn'></td></tr>";
               $i++;
                            
            } 
           }
       ?>
         
         </table>

         

  
                </form>
       

      </fieldset>
   

        <fieldset id="show1"style="visibility:hidden;">
          <label>Price</label>
      <h1 style="float: left;margin-left: -201px;margin-top: 22px;">Total Price</h1>
      <input type="text" name="" placeholder="Price">
          <h1 style="float: right;margin-right: 726px;">Paopack Package Price</h1>
          <input type="text" name="" placeholder="Paopack Price">
      <input type="submit" value="Add Package" style="float:right;margin-top: 22px;margin-right: 14px;">
        </fieldset>
    <div class="clear"></div>
      <?php } ?>
    </div>
        
  </form>
</article><!-- end of post new article -->




<?php }/*View Paopack Other Packages*/else if($PageView=="PaopackOtherPackages"){ ?>
        <article class="module width_full">
      <form method="post">
        <header><h3>Logged Admin Profile</h3></header>
        <div class="module_content">
          <?php $AdminDetails = json_decode($paopack->PaopackAdminDetails($_SESSION['AdminEmail']));foreach($AdminDetails as $Detail){ ?>
           <fieldset > 
              <label>Name</label>
              <input type="text" value="<?php echo $Detail->Name; ?>" readonly>
            </fieldset>
            <fieldset>
              <label>Email</label>
              <input type="text" value="<?php echo $Detail->Email; ?>" readonly>
            </fieldset>
            <div class="clear"></div>
            <?php } ?>
        </div>
        
      </form>
    </article><!-- end of post new article -->
        <?php }/*View Paopack Commercial Packages*/else if($PageView=="PaopackCommercialPackages"){ ?>  
          <article class="module width_full">
          
      <header><h3>Post New Slider Image</h3></header>
      <form method="post" enctype="multipart/form-data">
          <div class="module_content">
             <span id="MessageTxt" style="<?php echo $Style; ?>"><?php echo $MessageStatus; ?></span>
             <fieldset>
              <label>Note : </label>
              <div>1 . Image Must be (.jpg | .gif | .png) <br/> 2 . Image Resolution must be (width X height = 770 X 255 px) . <br/></div>
            </fieldset>
            <fieldset>
              <label>Add Image</label>
              <input type="file" name="slider_image" required="">
            </fieldset>
            <div class="clear"></div>
        </div>
        <footer>
          <div class="submit_link">
            <input type="submit" value="+ Add Image" class="alt_btn" name="btnAddSliderImage">
          </div>
        </footer>
      </form>
    </article><!-- end of post new article -->
        <?php }?>       
        
    <div class="spacer"></div>
  </section>

</body>

</html>