<script type="text/javascript">

    $(function(){
        //autocomplete search on focus
        $("#prot_id,#prot_id2,#cust_id,#cust_id2").autocomplete({

            minLength: 0
        }).bind('focus', function () {
            $(this).autocomplete("search");
        });

        //--------คู่สัญญาทั้งหมด------------
        $('#cust_id_all').click(function() {
            if($('#cust_id_all') .attr( 'checked' ) )
            {
                $("#cust_id").prop('disabled', true);
                $("#cust_id2").prop('disabled', true);
            }
            else
            {

                $("#cust_id").prop('disabled', false);
                $("#cust_id2").prop('disabled', false);
            }
        });

        //--------ท่ออุปกรณ์ทั้งหมด------------
        $('#prot_id_all').click(function() {
            if($('#prot_id_all') .attr( 'checked' ) )
            {
                $("#prot_id").prop('disabled', true);
                $("#prot_id2").prop('disabled', true);
            }
            else
            {

                $("#prot_id").prop('disabled', false);
                $("#prot_id2").prop('disabled', false);
            }
        });

    });


</script>
<?php
$this->breadcrumbs = array(
    'รายงาน',  //--------ไม่ต้องแก้----------
);
?>

<style>

    .reportTable thead th {
        text-align: center;
        font-weight: bold;
        background-color: #eeeeee;
        vertical-align: middle;
    }

    .reportTable td {

    }

</style>
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdf.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/compatibility.js"></script> -->


<h4>รายงานผลรวมการผลิตแยกตามคู่สัญญา</h4>
<div class="well">
    <div class="row-fluid">

        <div class="span2">
        <?php
        echo CHtml::label('วันที่ดำเนินการเริ่มต้น', 'date_start');
        echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
        $this->widget('zii.widgets.jui.CJuiDatePicker',
                array(
                    'name' => 'date_start',
                    'attribute' => 'date_start',
                    'options' => array(
                        'mode' => 'focus',
                        //'language' => 'th',
                        'format' => 'dd/mm/yyyy', //กำหนด date Format
                        'showAnim' => 'slideDown',
                    ),
                    'htmlOptions' => array('class' => 'span12'), // ใส่ค่าเดิม ในเหตุการ Update
                )
        );
        echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
        ?>
        </div>

        <div class="span2 offset1">
            <?php
            echo CHtml::label('วันที่ดำเนินการสิ้นสุด', 'date_end');
            echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
            $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'name' => 'date_end',
                        'attribute' => 'date_end',
                        'options' => array(
                            'mode' => 'focus',
                            //'language' => 'th',
                            'format' => 'dd/mm/yyyy', //กำหนด date Format
                            'showAnim' => 'slideDown',
                        ),
                        'htmlOptions' => array('class' => 'span12'), // ใส่ค่าเดิม ในเหตุการ Update
                    )
            );
            echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
            ?>
        </div>
    </div>

    <!--  แถว 2 //// -->

    <div class="row-fluid">
        <div class="span3">
            <?php
            echo CHtml::label('คู่สัญญาทั้งหมด', 'workcat');
            echo '<label class="checkbox span5">';
            echo '<input type="checkbox" id="cust_id_all" name="mm" value="mm">';
            echo '</label>';
            ?>
        </div>
        <div class="span3">
<?php
            echo CHtml::label('รหัสคู่สัญญาเริ่มต้น', 'workcat');
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'cust_id',
                'id' => 'cust_id',
                //'value'=>$model->cust_id,
                // 'source'=>$this->createUrl('Ajax/GetDrug'),
                'source' => 'js: function(request, response) {
                                $.ajax({
                                    url: "' . $this->createUrl('Contractor/GetContractor') . '",
                                    dataType: "json",
                                    data: {
                                        term: request.term,

                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                // additional javascript options for the autocomplete plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'minLength' => 0,
                    'select' => 'js: function(event, ui) {

                                     }',
                ),
                'htmlOptions' => array(
                    'class' => 'span13'
                ),
            ));
?>

        </div>
        <div class="span3">
            <?php
            echo CHtml::label('รหัสคู่สัญญาสิ้นสุด', 'workcat');
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'cust_id2',
                'id' => 'cust_id2',
                //'value'=>$model->cust_id,
                // 'source'=>$this->createUrl('Ajax/GetDrug'),
                'source' => 'js: function(request, response) {
                                $.ajax({
                                    url: "' . $this->createUrl('Contractor/GetContractor') . '",
                                    dataType: "json",
                                    data: {
                                        term: request.term,

                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                // additional javascript options for the autocomplete plugin
                'options' => array(
                    'showAnim' => 'fold',
                    'minLength' => 0,
                    'select' => 'js: function(event, ui) {

                                     }',
                ),
                'htmlOptions' => array(
                    'class' => 'span13'
                ),
            ));
            ?>

        </div>
    </div>

    <!--  แถว 3 //// -->
    <div class="row-fluid">

        <div class="span3">
            <?php
            echo CHtml::label('ท่ออุปกรณ์ทั้งหมด', 'workcat');
            echo '<label class="checkbox span5">';
            echo '<input type="checkbox" id="prot_id_all" name="mm" value="mm">';
            echo '</label>';
            ?>
        </div>
        <div class="span3">

            <?php
            echo CHtml::label('รหัสท่อ/อุปกรณ์เริ่มต้น', 'workcat');
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'prot_id',
                'id' => 'prot_id',
                // 'value'=>$model->prot_id,    //-----------------เปิดเปล่า-----

                'source' => 'js: function(request, response) {
                                                $.ajax({
                                                    url: "' . $this->createUrl('Prodtype/GetType') . '",
                                                    dataType: "json",
                                                    data: {
                                                        term: request.term,

                                                    },
                                                    success: function (data) {
                                                            response(data);

                                                    }
                                                })
                                             }',
                'options' => array(
                    'showAnim' => 'fold',
                    'minLength' => 0,
                    'select' => 'js: function(event, ui) {

                                                     }',
                ),
                'htmlOptions' => array(
                    'class' => 'span13'
                ),
            ));
            ?>
        </div>
        <div class="span3">

            <?php
            echo CHtml::label('รหัสท่อ/อุปกรณ์สิ้นสุด', 'workcat');

            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'prot_id2',
                'id' => 'prot_id2',
                // 'value'=>$model->prot_id,    //-----------------เปิดเปล่า-----

                'source' => 'js: function(request, response) {
                                                $.ajax({
                                                    url: "' . $this->createUrl('Prodtype/GetType') . '",
                                                    dataType: "json",
                                                    data: {
                                                        term: request.term,

                                                    },
                                                    success: function (data) {
                                                            response(data);
                                                    }
                                                })
                                             }',
                'options' => array(
                    'showAnim' => 'fold',
                    'minLength' => 0,
                    'select' => 'js: function(event, ui) {

                                                     }',
                ),
                'htmlOptions' => array(
                    'class' => 'span13'
                ),
            ));
            ?>

        </div>
    </div>


    <!--  แถว 4 //// -->
    <div class="row-fluid">
        <div class="span3">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'type' => 'inverse',
                'label' => 'view',
                'icon' => 'list-alt white',
                'htmlOptions' => array(
                    'class' => 'span4',
                    'style' => 'margin:25px 10px 0px 0px;',
                    'id' => 'gentReport'
                ),
            ));
            ?>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'type' => 'success',
                'label' => 'Excel',
                'icon' => 'excel',
                'htmlOptions' => array(
                    'class' => 'span4',
                    'style' => 'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
                    'id' => 'exportExcel'
                ),
            ));

            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'type' => 'info',
                'label' => '',
                'icon' => 'print white',
                'htmlOptions' => array(
                    'class' => 'span3',
                    'style' => 'margin:25px 0px 0px 0px;',
                    'id' => 'printReport'
                ),
            ));
            ?>
        </div>
    </div>


</div>


<div id="printcontent" style=""></div>



            <?php
//Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();

       
        $.ajax({
            url: "GenR7",
            cache:false,
                        data: {date_start:$("#date_start").val(),date_end:$("#date_end").val()
            },
            success:function(response){
               
               $("#printcontent").html(response);                 
            }

        });
    
});
', CClientScript::POS_END);

            Yii::app()->clientScript->registerScript('printReport', '
$("#printReport").click(function(e){
    e.preventDefault();

    $.ajax({
        url: "printVendor",
        data: {fiscalyear:$("#fiscalyear").val(),project: $("#project").val(),monthEnd:$("#monthEnd").val(),yearEnd:$("#yearEnd").val(),workcat:$("#workcat").val()
              },
        success:function(response){
            window.open("../tempReport.pdf", "_blank", "fullscreen=yes");              
            
        }

    });

});
', CClientScript::POS_END);

            Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();
    window.location.href = "genVendorExcel?fiscalyear="+$("#fiscalyear").val()+"&project="+$("#project").val()+"&monthEnd="+$("#monthEnd").val()+"&yearEnd="+$("#yearEnd").val()+"&workcat="+$("#workcat").val();
              


});
', CClientScript::POS_END);
            ?>