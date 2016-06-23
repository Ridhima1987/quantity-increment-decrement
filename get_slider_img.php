<?php
	
	 mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
         mysql_select_db("a132cbmz_paopackfreshmarket");
		     
      
	$QueryToFetchSliderImages = mysql_query("select * from tbl_paopack_slider_images");
	if(mysql_num_rows($QueryToFetchSliderImages)>0)
        {
	$ImageJson = array();
       
	while($Image = mysql_fetch_array($QueryToFetchSliderImages))
        {
	$st=$Image['img_status'];
        if($st=="active")
        {
        $base64=$Image['img_data'];
     
        $ImageJson[]=array("status"=>"ok","ImageData"=>$base64);
        }
        }
					
        }
        else{
        $ImageJson[]=array("status"=>"failed");
        }
echo json_encode($ImageJson);			
?>