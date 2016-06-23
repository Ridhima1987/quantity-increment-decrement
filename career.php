<?php
mysql_connect("localhost","root","");
mysql_select_db("career");




?>
 <!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
   
   <?php include_once'header_files.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script>
 
$(document).ready(function(){
    var allPanels = $('.show_me').hide();
    var allPanel = $('.apply_now').hide();
    var app=$('.click').removeClass("rotate_me");
    var allPane=$('.click').parent().find('i').removeClass("rotate_me");
  $('.click').click(function() {
    allPanels.slideUp();
    allPanel.hide();
    app.removeClass("rotate_me");
    allPane.removeClass("rotate_me");
    $(this).next().stop(true).slideToggle();
    return false;
  });

   
  $('.click').click(function() {
     allPane.removeClass("rotate_me");
    if(!$('.click').parent().find('i').hasClass("rotate_me"))
    {
     
        $(this).parent().find('i').addClass("rotate_me");
   }
   
    return false;
  });






  // $('.click').click(function() {
  //   if($(this).parent().find('i').hasClass("rotate_me"))
  //   {
  //       $(this).parent().find('i').removeClass("rotate_me");
  //   }
  //   else{
  //       $(this).parent().find('i').addClass("rotate_me");
  //   }
  // });






  var allPanel = $('.apply_now').fadeOut();
  $('.apply').click(function() {
    allPanel.fadeOut();
   
    $(this).parent().next().stop(true).slideDown(1000);
    return false;
  });
  var all = $('.apply_now').slideDown(1000);
  $('.cross').click(function() {
    all.fadeOut();
    $(this).parent().next().stop(true).fadeOut();
    return false;
  });
  


// $(".apply").click(function(){
//      $('.apply_now').hide();
//     $(".apply_now").stop(true).show();
//     return false;
// });
});

</script>

<style type="text/css">

td
{
  border:2px solid #323A45;
}
.show_me{
    display: none;
}
.apply_now{
    display: none;
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 999999999;
    background: rgba(2, 2, 2,.4);
    top: 0;
    padding: 30px;
    left: 0;

}
.rotate_me{
    transform: rotate(180deg);
    transition: all .3s linear;

}
.cross{
    /*//display: none;*/
}
.any{
    background: #fff;
        width: 40%;
        left: 50%;
    margin-left: -20%;
        position: absolute;
            top: 36%;
    margin-top: -15%;
    border: 2px solid  #009966;

}
.heading
{
        padding: 20px;
    text-align: center;
    font-size: 40px;
    color: rgba(52,73,94,1);
    font-family: 'Open Sans', Arial, sans-serif;
    width: 100%;
    margin-left: -8px;
    font-weight: 500;
    margin-top: 20px;
}
.txt{
    padding: 10px;
    width: 100%;
    border: 1px solid gray;
    border-radius: 4px;
    margin-bottom: 10px;
}
.click:hover{
    background: #009966!important;
    cursor: pointer;
}
.click:hover h5{
    color: white!important;
    text-decoration: underline!important;
}
.click:hover h3{
    color: white!important;
    text-decoration: underline!important;
}
.click:hover i{
    color: white!important;
    
}
/*@media (min-width: 992px){
.container {
    width: 100%;
}
}*/
 </style>


</head>
<body>
<header id="header">
       
        <?php include_once'slide.php'; ?>

</header>
<!--End Header-->
<section>
<div class="container" >
<div class="row" style="margin-top: 450px">
<div class="col-lg-12 col-sm-12" >
<div class="heading">
WE ARE HIRING
</div>
</div>
</div>
<?php
$q=mysql_query("SELECT * from jobs");
if(mysql_num_rows($q)>0)
{
    while($row=mysql_fetch_assoc($q))
    {
        $id=$row['id'];
        $cat=$row['category'];
        $post=$row['post'];
        $n_post=$row['n_post'];
        $qual=$row['qual'];
        $loc=$row['location'];
        print "<div class='row' >
        <div class='col-lg-12 col-sm-12' style='background: #FFFFFF;
    border-bottom: 1px solid #BBBCBC;    margin-bottom: 5px;'><h2 style='color: #009966;    '>".$cat."</h2></div>
        <div class='col-md-12 click' style='background: white' id='".$id."' onclick='slideToggle(this.id)'>
             <h3 style='color: #34495E;    margin-top: 10px;
    margin-bottom: 10px;'><i class='fa fa-chevron-circle-down' style='color:#009966'></i>  ".$post." - ".$n_post." Posts</h3>
             <h5 style='color: #34495E;margin-bottom: 0px;    margin-top: -10px;
    margin-left: 19px;    margin-top: 10px;
    margin-bottom: 10px;'>".$loc."</h5>

        </div>
        <div class='col-md-12 show_me' id='img-".$id."' style='border:1px solid #009966;    margin-left: 34px;
    width: 937px;
    margin-top: 10px;'>
           <h2 style='color: #34495E;border-bottom: 1px solid #BBBCBC;padding-bottom: 5px;'>  ".$post." - ".$n_post." Posts</h2>
           <h4>Qualification</h4>
           <ul><li>".$qual."</li></ul>
           <h4>Number of Posts</h4>
           <ul><li>".$n_post."</li></ul>
           <h4>Requirements</h4>
           <ul style='margin-bottom: 15px;'>";
        $r=mysql_query("SELECT * from req_job where j_id=".$id);
        if(mysql_num_rows($r)>0)
        {
            while ($ro=mysql_fetch_assoc($r)) 
            {
                $req=$ro['j_req'];         
                print "<li style='list-style: initial;
    margin-left: 30px;padding: 5px;'>".$req."</li>";
            }   
        }   
        print" </ul>
        <p style='margin-bottom:20px!important'><a href='' style='padding: 10px;background: #009966;border-radius: 5px;color: white;font-size: 15px;' class='apply'>Apply Now</a></p>
        <div class='row apply_now'>
        <div class='col-sm-12 any'>
        <p style='float: right;font-size: 20px;margin-top: 11px;color:#009966;font-weight:600;cursor:pointer' class='cross'>X</p>
        <center><h2>Apply Now</h2></center>

        <form action='' method='post' enctype='multipart/form-data'>
        <input type='textbox' class='txt' name='name' placeholder='Enter Name' required>
        <input type='textbox' class='txt' placeholder='Enter Email' name='email' required>
        <input type='textbox' class='txt' name='mobile' placeholder='Enter Mobile Number' required>
        <input type='file' name='fileToUpload' class='txt' id='fileToUpload' value='Upload Resume'>
        <textarea class='txt' style='resize:none' placeholder='About Yourself 200 words'></textarea>
        <input type='submit' value='Submit' name='submit' style='width:100%;background:#009966;color:white;border: 1px solid #009966;font-size:15px;padding:10px;border-radius: 4px;margin-bottom:20px'>
        </form>
        </div>
        </div>
        </div>
        </div>
        ";
    }
}
?>
</section>
</div>
<?php include_once 'footer_files.php'; ?>
</body>
</html>