<?php /* @var $this Controller */ 
Yii::app()->bootstrap->init();
?>
<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript">
    $(function() {

         $('.tree-toggle').click(function () {
        
            $(this).parent().children('ul.tree').toggle(200);
        });
    });

   
</script>

<style type="text/css">
    .nav-header {
        font-size: 16px;
    }
</style>

<?php

if(!Yii::app()->user->isGuest)
{

?>
<div class="row">
   
    <div class="span3">
      <div class="well">
        <div>
            <ul class="nav nav-list">
        <?php
          
          
            // $menugroups = MenuGroup::model()->findAll();

         
            // foreach ($menugroups as $key => $group) {
            //     $menutrees = MenuTree::model()->findAll(array('order'=>'', 'condition'=>'menu_group_id=:gid', 'params'=>array(':gid'=>$group->id)));
                
            //     $menutrees = Yii::app()->db->createCommand()
            //                                 ->select('*')
            //                                 ->from('menus')
            //                                 ->join('authens','authens.menu_id=menus.id')
            //                                 ->where('menu_group_id=:gid AND  user_group_id=:user', array(':gid'=>$group->id,':user'=>Yii::app()->user->group))
            //                                 ->queryAll();

                          
            //     if(!empty($menutrees))
            //     {                            
            //         echo  '<li><label class="tree-toggle nav-header" style="color:black">'.$group->name.'</label>';
            //         echo  '<ul class="nav nav-list tree">';
            //         foreach ($menutrees as $key => $menu) {
                 
            //             echo '<li>'.CHtml::link($menu["name"],array($menu["url"])).'</li>';
            //         }
            //         echo '</ul>';
            //     }
            // }
            
           
        ?>
            </ul>
        </div>
      </div><!-- well -->

   

   
    </div>


     <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php 
}
?>

<?php $this->endContent(); ?>


