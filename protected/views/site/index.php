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

  <?php

$this->widget('ext.EFullCalendar.EFullCalendar', array(
    // polish version available, uncomment to use it
    // 'lang'=>'pl',
    // you can create your own translation by copying locale/pl.php
    // and customizing it

    // remove to use without theme
    // this is relative path to:
    // themes/<path>
    //'themeCssFile'=>'cupertino/theme.css',

    // raw html tags
    'htmlOptions'=>array(
        // you can scale it down as well, try 80%
        'style'=>'width:100%'
    ),
    // FullCalendar's options.
    // Documentation available at
    // http://arshaw.com/fullcalendar/docs/
    'options'=>array(
        'header'=>array(
            'left'=>'prev,next',
            'center'=>'title',
            'right'=>'today'
        ),
        'lazyFetching'=>true,
        //'events'=>$calendarEventsUrl, // action URL for dynamic events, or
        'events'=>array(['title'=>'Meeting',
        'start'=>'2020-02-08',
        'color'=>'#CC0000',
        'allDay'=>false,
        'url'=>'http://anyurl.com']) // pass array of events directly

        // event handling
        // mouseover for example
        //'eventMouseover'=>new CJavaScriptExpression("js_function_callback"),
    )
));

  ?>
</div>


<div id="modal-content" class="hide">
    <div id="modal-body">
<!-- put whatever you want to show up on bootbox here -->
    	<?php 
    	
   





    	?>
    </div>
</div>


