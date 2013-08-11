<?php
/* if (Yii::app()->detectMobileBrowser->showMobile  || isset($_GET['m']) ) {
  $this->layout='//layouts/mobile';
  } */
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);
/*
$this->menu = array(
    //array('label'=>'List Order','url'=>array('index')),
    array('label' => 'Create Order', 'url' => array('create')),
);*/

$this->pageHeader = array("Manage Orders", "Create, view, update or delete your orders from this panel");
?>
<div class="row-fluid">
    <div class="span9">
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Orders',
            'headerIcon' => 'icon-th-list',
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label' => 'Create new Order', 'url' => array('create')),
                    ),
                ),
            ),
            // when displaying a table, if we include bootstra-widget-table class
            // the table will be 0-padding to the box
            'htmlOptions' => array('class' => 'bootstrap-widget-table fixme')
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'order-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'idOrder',
                //'User_idUser',
                array(
                    'name' => 'User_idUser',
                    'value' => '$data->userIdUser->name',
                    'type' => 'text',
                ),
                //'Company_idCompany',
                'date',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{delete}'
                ),
            ),
        ));
        ?>

        <?php $this->endWidget(); ?>

    </div>
    <div class="span3">
        <?php echo $this->renderPartial('/activity/index'); ?>
    </div>
</div>

