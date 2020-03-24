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
  <p>ส่วนประมาณราคางานก่อสร้างโยธา กองประมาณราคาระบบผลิตส่งน้ำและงานโยธา ฝ่ายออกแบบระบบผลิตส่งน้ำและงานโยธา </p>
  <p>
  <?php
    $link = "";
    if(Yii::app()->user->isGuest())
        $link = "";

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


