<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$theme = Yii::app()->theme;
$cs = Yii::app()->clientScript;
$cs->registerScriptFile( $theme->getBaseUrl() . '/js/highcharts.js' );
//$cs->registerCssFile($theme->getBaseUrl() . '/css/ProgressTracker.css');

?>
<div class="hero-unit">
  <h3>ยินดีต้อนรับเข้าสู่</h3>
  <h2><?php echo Yii::app()->name; ?></h2>
  <p>ส่วนทดสอบคุณสมบัติวัสดุ กองมาตรฐานวิศวกรรม ฝ่ายมาตรฐานวิศวกรรมและสารสนเทศภูมิศาสตร์ </p>
  <p>
  <?php
    $link = "http://172.16.184.93/engstd/ENG_UD_ADMIN_1.0.pdf";
    if(Yii::app()->user->isGuest())
        $link = "http://172.16.184.93/engstd/ENG_UD_GUEST_1.0.pdf";

       echo '<a class="btn btn-primary btn-large" href="'.$link.'">';
    
  
  ?>
       <span class="icon-book white" aria-hidden="true"></span>  คู่มือการใช้งาน
    </a>
  </p>
</div>


<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	
   

    	?>
    </div>
</div>


