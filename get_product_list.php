<?php
	
	 mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
         mysql_select_db("a132cbmz_paopackfreshmarket");
		     
         $json_array=array();
	
	$type=$_POST['type'];
	
	switch($type)
	{
		case "All":
					$QueryGetProductInfo=mysql_query("select * from tbl_pao_products order by product_id desc");
					if(mysql_num_rows($QueryGetProductInfo)>0)
					{
						while($row = mysql_fetch_assoc($QueryGetProductInfo))
						{

						  $json_array[] = array("status"=>"ok",
                                                                           "id"=>$row['product_id'],
                                                                           "name"=>$row['product_name'],
                                                                           "weight"=>$row['product_wt'],
                                                                           "price"=>$row['product_price'],
                                                                           "disc"=>$row['product_discount'],
"condition"=>$row['product_condition'],
"description"=>$row['product_desc'],
                                                                           "img"=>$row['product_image']
                                                                        );
						  
						}
					}
else{
$json_array[]=array("status"=>"failed","response"=>"Product not found");

}
					echo json_encode($json_array);
					break;
		case "Hot":
					
                                       $QueryGetProductInfo=mysql_query("select * from tbl_pao_products where product_type='Hot Offers' order by product_id desc");
					if(mysql_num_rows($QueryGetProductInfo)>0)
					{
						while($row = mysql_fetch_assoc($QueryGetProductInfo))
						{

						  $json_array[] = array("status"=>"ok",
                                                                           "id"=>$row['product_id'],
                                                                           "name"=>$row['product_name'],
                                                                           "weight"=>$row['product_wt'],
                                                                           "price"=>$row['product_price'],
                                                                           "disc"=>$row['product_discount'],
"condition"=>$row['product_condition'],
"description"=>$row['product_desc'],
                                                                           "img"=>$row['product_image']
                                                                        );
						  
						}
					}
else{
$json_array[]=array("status"=>"failed","response"=>"Product not found");

}
					echo json_encode($json_array);
					break;

		case "Combo":
					$QueryGetProductInfo=mysql_query("select * from tbl_pao_products where product_type='Combo Offers' order by product_id desc");
					if(mysql_num_rows($QueryGetProductInfo)>0)
					{
						while($row = mysql_fetch_assoc($QueryGetProductInfo))
						{

						  $json_array[] = array("status"=>"ok",
                                                                           "id"=>$row['product_id'],
                                                                           "name"=>$row['product_name'],
                                                                           "weight"=>$row['product_wt'],
                                                                           "price"=>$row['product_price'],
                                                                           "disc"=>$row['product_discount'],
"condition"=>$row['product_condition'],
"description"=>$row['product_desc'],
                                                                           "img"=>$row['product_image']
                                                                        );
						  
						}
					}
else{
$json_array[]=array("status"=>"failed","response"=>"Product not found");

}
					echo json_encode($json_array);
					break;
		case "Sasta":
					$QueryGetProductInfo=mysql_query("select * from tbl_pao_products where product_type='Sabse Sasta' order by product_id desc");
					if(mysql_num_rows($QueryGetProductInfo)>0)
					{
						while($row = mysql_fetch_assoc($QueryGetProductInfo))
						{

						  $json_array[] = array("status"=>"ok",
                                                                           "id"=>$row['product_id'],
                                                                           "name"=>$row['product_name'],
                                                                           "weight"=>$row['product_wt'],
                                                                           "price"=>$row['product_price'],
                                                                           "disc"=>$row['product_discount'],
"condition"=>$row['product_condition'],
"description"=>$row['product_desc'],
                                                                           "img"=>$row['product_image']
                                                                        );
						  
						}
					}
else{
$json_array[]=array("status"=>"failed","response"=>"Product not found");

}
					echo json_encode($json_array);
					break;
		default:
echo "Type not found";
		break;
	}