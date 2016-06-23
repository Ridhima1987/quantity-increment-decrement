<?php
		       mysql_connect("localhost","a132cbmz","gV@4@1e3B6l3");
		       mysql_select_db("a132cbmz_paopackfreshmarket");
		     
                       $json_array=array();

	               $name=$_POST['name'];
                       $email=$_POST['email'];
                       $password=$_POST['password'];
                       $mobile=$_POST['mobile'];
               $checkQuery=mysql_query("select * from tbl_pao_user_registration where user_email='$email'");
if(mysql_num_rows($checkQuery)>0){
$json_array[]=array("status"=>"failed","response"=>"This email is already registered!");

}
  else{                     $insertquery=mysql_query("INSERT into tbl_pao_user_registration values('','','$name','','$email','$password','$mobile',NOW())");
                     
                      if($insertquery)
                     {
                            $json_array[]=array("status"=>"ok","response"=>"Successfully Registered");
                     }
                      else
                     {
                           echo mysql_error();
                     }
}
                     echo json_encode($json_array);

            
?>