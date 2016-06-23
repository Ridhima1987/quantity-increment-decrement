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
