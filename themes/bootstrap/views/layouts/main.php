<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
   
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<script type="text/javascript" src="/engstd/themes/bootstrap/js/jquery.yiigridview.js"></script>
	<?php 
       /* Yii::app()->getClientScript()->reset(); 
        Yii::app()->bootstrap->register();   */

        
        Yii::app()->bootstrap->init();
        //$cs = Yii::app()->clientScript;
        //$cs->registerScriptFile(Yii::app()->theme->getBaseUrl().'/js/jquery.yiigridview.js');
  ?>
</head>
<link rel="shortcut icon" href="/engstd/favicon.ico">
<style>

.dropdown-menu {
   /*background-color: #cccccc;*/
   
}
.navbar .nav > li > .dropdown-menu:after {
  /*border-bottom: 6px solid #cccccc;*/
}
.dropdown-menu > li > a {
  /*color: white;*/

}
.dropdown-menu > li > a:hover {
  background-color: white;
  
}

.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus,
.dropdown-submenu:hover > a,
.dropdown-submenu:focus > a {
  color: #ffffff;
  text-decoration: none;
  background-color: #000000;
  background-image: -moz-linear-gradient(top, #333333, #000000);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#333333), to(#000000));
  background-image: -webkit-linear-gradient(top, #333333, #000000);
  background-image: -o-linear-gradient(top,  #333333, #000000);
  background-image: linear-gradient(to bottom ,#333333, #000000);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
}

.dropdown-menu > .active > a,
.dropdown-menu > .active > a:hover,
.dropdown-menu > .active > a:focus {
  color: #ffffff;
  text-decoration: none;
  background-color: #ffffff;
  background-image: -moz-linear-gradient(top, #ffffff, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#51a351));
  background-image: -webkit-linear-gradient(top, #ffffff, #51a351);
  background-image: -o-linear-gradient(top,  #ffffff, #51a351);
  background-image: linear-gradient(to bottom ,#ffffff, #51a351);
  background-repeat: repeat-x;
  outline: 0;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
}

.navbar .brand {
display: block;
float: left;
padding: 10px 20px 10px;
/*margin-left: -20px;*/
font-size: 25px;
font-weight: 200;
color: #fff;
/*text-shadow: 0 0 0 #ffffff;*/
}        

        
.navbar .nav > li > a{
float: none;
padding: 20px 15px 10px;
color: #fff;
text-decoration: none;
text-shadow: 0 0 0 #ffffff;
height: 35px;
}       

.navbar .nav > li > a >  i{
float: none;
/*margin-top: 5px;*/
}

.navbar .btn, .navbar .btn-group {
   /*margin-top: 15px;*/
}
.navbar .nav  > li > a:hover, .nav > li > a:focus {
    float: none;
    /*padding: 20px 15px 10px;*/
    color: #fff;
    text-decoration: none;
    text-shadow: 0 0 0 #ffffff;
    background-color: #cccccc;
}
.navbar .nav  > .active > a, .navbar .nav > .active > a:hover, .navbar .nav > .active > a:focus {
    color: #ffffff;
    background-color: #499249;

}       
 .navbar-inner {
	background-color:#F59416;
    color:#ffffff;
  	border-radius:0;
}
  
.navbar-inner .navbar-nav > li > a {
  	color:#fff;
  	padding-left:20px;
  	padding-right:20px;
}
.navbar-inner .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus {
    color: #ffffff;
     background-color: #cccccc;
	background-color:transparent;
}
      
.navbar-inner .navbar-nav > li > a:hover, .nav > li > a:focus {
    text-decoration: none;
    background-color: #cccccc;
}
      
.navbar-inner .navbar-brand {
  	color:#eeeeee;
}
.navbar-inner .navbar-toggle {
  	background-color:#eeeeee;
}
.navbar-inner .icon-bar {
  	background-color:#cccccc;
}

.nav .open>a, .nav .open>a:hover, .nav .open>a:focus {
	background-color: #cccccc;
	border-color: #428bca;
}

.navbar-inner {
    min-height: 0px;
}

.navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle {
  color: white;  
  background-color: #cccccc;
  border-color: #428bca;
}


 .navbar .brand2 {
      display: block;
      float: left;
      padding: 10px 20px 10px;
      margin-left: -20px;
      font-size: 18px;
      font-weight: 200;
      color: white;
      text-shadow: 0 1px 0 #ffffff;
      font-family: 'sukhumvitreg', sans-serif;
      letter-spacing: 2px;
  }

  .navbar-inner2 {
      background-color: #090909;
      color: #ffffff;
      border-radius: 4px;
      padding-right: 20px;
      padding-left: 20px;
      margin-top: -40px;
  }

  
nav .badge {
  background: #67c1ef;
  border-color: #30aae9;
  background-image: -webkit-linear-gradient(top, #acddf6, #67c1ef);
  background-image: -moz-linear-gradient(top, #acddf6, #67c1ef);
  background-image: -o-linear-gradient(top, #acddf6, #67c1ef);
  background-image: linear-gradient(to bottom, #acddf6, #67c1ef);
}

nav .badge.green {
  background: #77cc51;
  border-color: #59ad33;
  background-image: -webkit-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: -moz-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: -o-linear-gradient(top, #a5dd8c, #77cc51);
  background-image: linear-gradient(to bottom, #a5dd8c, #77cc51);
}

nav .badge.yellow {
  background: #faba3e;
  border-color: #f4a306;
  background-image: -webkit-linear-gradient(top, #fcd589, #faba3e);
  background-image: -moz-linear-gradient(top, #fcd589, #faba3e);
  background-image: -o-linear-gradient(top, #fcd589, #faba3e);
  background-image: linear-gradient(to bottom, #fcd589, #faba3e);
}

nav .badge.red {
  background: #fa623f;
  border-color: #fa5a35;
  background-image: -webkit-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: -moz-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: -o-linear-gradient(top, #fc9f8a, #fa623f);
  background-image: linear-gradient(to bottom, #fc9f8a, #fa623f);
}

@font-face {
    font-family: 'sukhumvitreg';
    src: url('/mtr/fonts/sukhumvitreg-webfont.eot');
    src: url('/mtr/fonts/sukhumvitreg-webfont?#iefix') format('embedded-opentype'),
         url('/mtr/fonts/sukhumvitreg-webfont.woff') format('woff'),
         url('/mtr/fonts/sukhumvitreg-webfont.ttf') format('truetype'),
         url('/mtr/fonts/sukhumvitreg-webfont.svg#quarkbold') format('svg');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'Boon400';
    src: url('/mtr/fonts/boon-400.eot');
    src: url('/mtr/fonts/boon-400.eot') format('embedded-opentype'),
         url('/mtr/fonts/boon-400.woff') format('woff'),
         url('/mtr/fonts/boon-400.ttf') format('truetype'),
         url('/mtr/fonts/boon-400.svg#Boon400') format('svg');
}

@font-face {
    font-family: 'Boon700';
    src: url('/mtr/fonts/boon-700.eot');
    src: url('/mtr/fonts/boon-700.eot') format('embedded-opentype'),
         url('/mtr/fonts/boon-700.woff') format('woff'),
         url('/mtr/fonts/boon-700.ttf') format('truetype'),
         url('/mtr/fonts/boon-700.svg#Boon700') format('svg');
}

@font-face {
    font-family: 'THSarabunPSK';
    src: url('/mtr/fonts/thsarabunnew-webfont.eot');
    src: url('/mtr/fonts/thsarabunnew-webfont.eot') format('embedded-opentype'),
         url('/mtr/fonts/thsarabunnew-webfont.woff') format('woff'),
         url('/mtr/fonts/thsarabunnew-webfont.ttf') format('truetype');
       
}

body{
    
    
     width:100%;
     /*min-height:340px;*/
      height: 100%;
     position: relative;
     /*background: url(../images/intro-bg.jpg) no-repeat center center;*/
     background-size: cover;
     font: 14px/1.4em 'Boon400',sans-serif;
     font-weight: normal;
     padding-bottom: 30px;
}

input, select, textarea {
font-family: 'Boon400', sans-serif;
}

.navbar .brand {
   font-family: 'sukhumvitreg', sans-serif;
       font-weight: normal;
}  

h1,h2,h3,h4{
        font-family: 'Boon700',sans-serif;
        font-weight: normal;
}

table tr .tr_white {
  background-color: #ffffff;
}

#footer {
    background-color: #F0EFEF;
}
.credit {
    margin: 6px 0;
    color: #ccc;
    text-align: center;
}
#wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        /*margin: 0 auto -60px;*/
}

hr {
    margin: 5px 0;
    border: 0;
    border-top: 1px solid #999999;
    border-bottom: 1px solid #ffffff;
}
.well {
    background-color: #eeeeee;
}

.form-actions {
    padding: 10px 5px 10px 5px;
    background-color: rgba(171, 168, 168, 0.25);
    border: 1px solid #999999;
    border-radius: 4px;
}

.table-bordered th{
  background-color: rgba(171, 168, 168, 0.25);
  text-align:center;
} 

.main_title{
  font-weight: bold;
  font-size: 18px;
  margin-top: 20px;
  padding-left: 20px;
}

select, input[type="file"] {
    height: 30px;
    line-height: 30px;
}

.menunav{
  padding-top: 40px;
}

.nav-header2{
    display: block;
    padding: 3px 15px;
    font-size: 16px;
    font-weight: bold;
    line-height: 20px;
    color: #999999;
   
}

.nav-list2 > li > a {
  
    margin-left: 20px;
    color: #73cdfb;
    padding: 5px;
    /* text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5); */
}

</style>     
     
<body class="body">

<?php 
 //echo Yii::app()->theme->getBaseUrl(); 


if(!Yii::app()->user->isGuest)
{
  
 

   $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noPrint'),
    //'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '../images/mwa_logo.png', 'Logo', array('width' => '320', 'height' => '20')),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>false,
            'items'=>array(
                //array('label'=>'หน้าแรก','icon'=>'home', 'url'=>array('/site/index')),
               
              ),
        ),    
        array(
            'class'=>'bootstrap.widgets.TbButtonGroup',           
            'htmlOptions'=>array('class'=>'pull-right'),
            'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'=>array(
                    //array('label'=>Yii::app()->user->title.Yii::app()->user->firstname." ".Yii::app()->user->lastname,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('label'=>Yii::app()->user->name,'icon'=>"icon-white icon-user", 'url'=>'#'),
                    //array('label'=>Yii::app()->user->username,'icon'=>Yii::app()->user->usertype, 'url'=>'#'),
                    array('items'=>array(
                        array('label'=>'เปลี่ยนรหัสผ่าน','icon'=>'cog', 'url'=>array('/user/password/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest()),
                        '---',
                        array('label'=>'ออกจากระบบ','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                ),
            
        ),
        ),
    ));

   
}
else{
    $this->widget('bootstrap.widgets.TbNavbar',array(
    'fixed'=>'top',
    'collapse'=>true,    
    'htmlOptions'=>array('class'=>'noprint'),
    //'brand' =>  CHtml::image(Yii::app()->getBaseUrl() . '../images/pea_logo.png', 'Logo', array('width' => '260', 'height' => '30')),
   
    ));
}   
 
   ?>


<style type="text/css">
  .vertical-nav {
  min-width: 17rem;
  width: 17rem;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.8);
  box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.4s;
}

.page-content {
  width: calc(100% - 17rem);
  margin-left: 17rem;
  transition: all 0.4s;
}


.nav-link{
  color : white;
}

/* for toggle behavior */

#sidebar.active {
  margin-left: -17rem;
}

#content.active {
  width: 100%;
  margin: 0;
}

@media (max-width: 768px) {
  #sidebar {
    margin-left: -17rem;
  }
  #sidebar.active {
    margin-left: 0;
  }
  #content {
    width: 100%;
    margin: 0;
  }
  #content.active {
    margin-left: 17rem;
    width: calc(100% - 17rem);
  }
}
</style>

<?php   
  if(!empty(Yii::app()->user->id))
  {
?>

        <div class="vertical-nav bg-dark" id="sidebar">
         
          <ul class="nav flex-column" style="padding-top: 80px">
                <?php
                            

                            echo  '<li><label class="tree-toggle nav-header2" style="color:white">เมนู<hr></hr></label>';
                            echo  '<ul class="nav nav-list2 tree">';
                          
                              
                                echo '<li>'.CHtml::link('<i class="icon-book icon-white"></i>  สืบค้นราคาวัสดุในงานก่อสร้าง',Yii::app()->baseUrl.'/specdoc/search').'</li>';
                                echo '<li>'.CHtml::link('<i class="icon-thumbs-up icon-white"></i>  สืบค้นราคาค่าแรงงานและค่าดำเนินการ',Yii::app()->baseUrl.'/laborcost/index').'</li>';
                                echo '<li>'.CHtml::link('<i class="icon-hdd icon-white"></i>  จัดเก็บ Spec. วัสดุในงานก่อสร้าง',Yii::app()->baseUrl.'/specdoc/index').'</li>';
                                echo '<li>'.CHtml::link('<i class="icon-list-alt icon-white"></i>  จัดทำ Spec. วัสดุในงานก่อสร้าง',Yii::app()->baseUrl.'/writespec/index').'</li>';
                                echo '<li>'.CHtml::link('<i class="icon-bullhorn icon-white"></i>  กฎ ระเบียบ พรบ. หลักเกณฑ์เกี่ยวกับงานก่อสร้าง',Yii::app()->baseUrl.'/regulation/index').'</li>';
                                echo '<li>'.CHtml::link('<i class="icon-shopping-cart icon-white"></i>  Contact List สินค้าและบริการ ',Yii::app()->baseUrl.'/contact/index').'</li>';
                          
                            echo '</ul>';
                            
                  
                    
                   
                ?>
                    </ul>
        </div>
<?php } ?>

<div id="wrap">
    <div class="container" id="page" >

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; 

// if(Yii::app()->user->isGuest())
// echo "guest";
  ?>

	<div class="clear"></div>


</div><!-- page -->
</div>


<div class="navbar navbar-fixed-bottom">
    <div class="navbar-inner" style="background-color: rgba(0, 0, 0, 0.76);">
        <div class="width-constraint clearfix">
             <p class="muted credit">พัฒนาโดย กองพัฒนาระบบงานผลิตและวิศวกรรม ฝ่ายพัฒนาและสนับสนุนเทคโนโลยี การประปานครหลวง</p>
     
        </div>
    </div>
</div>
</body>

</html>
<script type="text/javascript">
function checkFile(electObject){

  
  if((/\.(doc|docx|xls|xlsx|pdf)$/i).test(electObject.value) ) {
      
   }else {
     alert("Invalid file!!!!!");  
   } 
}
</script>