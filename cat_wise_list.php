<?php
	
	 mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
         mysql_select_db("a132cbmz_paopackfreshmarket");
         
         $json_array=array();
         
         $sub_id=$_POST['sub_id'];
         
         $QueryGetProductInfo=mysql_query("select * from tbl_pao_products where subcategory_id='$sub_id' order by product_id desc");
					if(mysql_num_rows($QueryGetProductInfo)>0)
					{
						while($row = mysql_fetch_assoc($QueryGetProductInfo))
						{

						  $json_array[] = array("status"=>"ok",
                                                                           "id"=>$row['product_id'],
                                                                           "name"=>$row['product_name'],
                                                                           "weight"=>$row['product_wt'],
                                                                           "price"=>$row['product_price'],
                                                                           "condition"=>$row['product_condition'],
"description"=>$row['product_desc'],
"disc"=>$row['product_discount'],
                                                                           "img"=>$row['product_image']
                                                                        );
						  
						}
					}

else{
$json_array[]=array("status"=>"failed","response"=>"Product not found");

}
					echo json_encode($json_array);


?>