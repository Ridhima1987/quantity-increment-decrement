<?php
		       mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
		       mysql_select_db("a132cbmz_paopackfreshmarket");

		       $json_array=array();

		       	$email=$_POST['email'];
		       	$password=$_POST['password'];

		       	$loginquery=mysql_query("select * from tbl_pao_user_registration where user_email='$email' and user_pwd='$password'");

		       	if(mysql_num_rows($loginquery)>0){
                                      while($row=mysql_fetch_assoc($loginquery))
                                  {
                               

		       		 $json_array[]=array(
                                                              "status"=>"ok",
                                                              "response"=>"Login successfully",
                                                              "id"=>$row['user_id'],
                                                              "name"=>$row['user_fn'],
                                                              "mobile"=>$row['user_dob']
                                                           );
}

		       	}
                     else{
$json_array[]=array(
                                                              "status"=>"failed",
                                                              "response"=>"Please check your Email id or Password.");
                      
                     }
                    echo json_encode($json_array);
		       
?>