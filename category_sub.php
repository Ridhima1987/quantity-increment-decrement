<?php
mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
mysql_select_db("a132cbmz_paopackfreshmarket");



$json_array_key=array();
$json_sub=array();
$json_final=array();
$json_fin=array();
$SelectQuery=mysql_query("select * from tbl_pao_product_categories");

if(mysql_num_rows($SelectQuery)>0){
	
	while($Result=mysql_fetch_array($SelectQuery)){
		$catagory_Ids=$Result['category_id'];
                
		$catagory_names=$Result['category_title'];
                
		$SelectQuerys=mysql_query("select * from tbl_pao_product_subcategories where category_id=$catagory_Ids");
		if(mysql_num_rows($SelectQuery)>0)
		{
			while($Result1=mysql_fetch_array($SelectQuerys))
			{
			if($catagory_names!=$new)
			{
	
				$json_sub[$Result['category_title']][]=array("sub_id"=>$Result1['subcategory_id'],"sub_title"=>$Result1['subcategory_title']);	
			}
			else
			{

			$json_sub[$Result['category_title']][]=array("sub_id"=>$Result1['subcategory_id'],"sub_title"=>$Result1['subcategory_title']);
			}          		
			}
                     
			
		}
		else
		{
			$json_sub[$Result['category_title']][]=array("sub_id"=>"null","sub_title"=>"null");
		}
       $json_array_key[]=array("category"=>$Result['category_title']); 
	$new=$Result['category_title'];	
 
    }

}else{
	echo mysql_error();
}

$json_final[]=array("key1"=>$json_array_key,"key2"=>$json_sub);
echo json_encode($json_final);
							 


?>