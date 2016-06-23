<?php include_once'inc/autoload.php'; ?>

<!doctype html>
<html class="no-js" lang="">
    <head>
<link rel="shortcut icon" type="image/png" href="images/p_paopack.png"/>
    	<title>Paopack - Fresh Market</title>
    	
        <?php $layout->HeaderFiles(); ?>
        
        <script type="text/javascript">
        
            $(document).ready(function(){
               
                $(".hamburger i").click(function(){
                    $(".sub_nav_bar").slideToggle(700);
                    return false;
                });
                $("#show_location_popup").click(function(){
                   $("#loaction_popup").show();
                 });
                $(".fa-times,#skip_popup").click(function(){
                   $("#loaction_popup").hide();
                });
               
            });

        </script>
<script>
        $(document).ready(function () {
            var parentDivs = $('#nestedAccordion div'),
                childDivs = $('#nestedAccordion h3').siblings('div');

            $('#nestedAccordion h2').click(function () {
                parentDivs.slideUp();
                if ($(this).next().is(':hidden')) {
                    $(this).next().slideDown();
                } else {
                    $(this).next().slideUp();
                }
            });

            $('#nestedAccordion a').click(function () {
                childDivs.slideUp();
                if ($(this).next().is(':hidden')) {
                    $(this).next().slideDown();
                } else {
                    $(this).next().slideUp();
                }
            });
        });
        </script>
 <script>
        $(document).ready(function () {
  var $nav = $('.t_header,.nav_bar,.cart,.logo a h1 img,.nav_bar ul li a,.logo,.nav_bar ul li,.cart a,.hamburger'),
      posTop = $nav.position().top;
  $(window).scroll(function () {
    var y = $(this).scrollTop();
    if (y > posTop) { $nav.addClass('fixed'); }
    else { $nav.removeClass('fixed'); }
  });
});
</script>

        <style>
			.dropbtn {
			    cursor: pointer;
			    background: transparent;
			    border: none;
			}
			
			.dropdown {
			    position: relative;
			    display: inline-block;
			}
			
			.dropdown-content {
			    display: none;
			    position: absolute;
			    z-index: 999;
			    right: 0;
			    min-width: 240px;
			}
			
			.dropdown-content a {
			    display: block;
			}
			
			
			.dropdown:hover .dropdown-content {
			    display: block;
			}
		</style>

    </head>






<body>

 <?php $layout->ShowHeader(); ?>

    <div class="container">
       
        <section class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 section_one">
            	
                <?php $layout->LeftSidebarMenu();$layout->HomepagePrimarySlider(); ?>
                     
            </div>
            
            <?php $layout->HomepageSecondarySlider();?>

            <div class="col-lg-12 col-md-12 col-sm-12 section_two">
                <div class="col-lg-3 col-md-3 col-sm-3 section_side_bar" style="padding-left: 0px;margin-top: 30px;">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 section_products" style="padding-right: 0px;">
                    <div class='row product_row_one'> <h3 style='margin-bottom: 10px;'>Recent Added Products<p><a href='paopack_view.php?view=<?php echo base64_encode("PaopackViewMoreProducts"); ?>'>View More</a></p></h3>    
                   
                    <?php $layout->LoadingProducts("Limit"); ?>
                   
                    <div class="row sub_banner">
                        <div class="col-lg-6 col-md-6 col-sm-6 b_one">
                            <a href="#"><img src="images/sub-banner-1.png"></a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 b_one">
                            <a href="#"><img src="images/sub-banner-2.png"></a>
                        </div>
                    </div>
                </div>
            </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 app_store">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 app_part text-center">
                <h1>Payment Options</h1>
                <ul>
                    <li><img style="width: 90px;" src="images/cash-on-delivery.jpg" alt=""></li>
                    <li><img style="width: 70px;" src="images/payment-card-icon.png" alt=""></li>
                    <li><img style="width: 70px;" src="images/Maestro-icon.png" alt=""></li>
                   
                </ul>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 app_part_right text-center">
                <h1>Download Mobile App Now!!</h1>
                <ul>
                    <li><img src="images/Google-App-store-icon.png" alt=""></li>
                    <li><img src="images/Apple-App-store-icon.png" alt=""></li>
                    
                   
                </ul>
              </div>
            </div>
        </section>
<!-- section end here
 -->

<!-- footer starts here
 -->
      
      


    </div>

<?php $layout->ShowFooter(); ?>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<script>
  $('#combo').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }

    ]
  });


</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5768d8b9537e1db952f16485/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>