<?php
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

/*$this->menu = array(
    //array('label'=>'List Product','url'=>array('index')),
    array('label' => 'Create Product', 'url' => array('create')),
);*/

$this->pageHeader = array("Manage Products", "Create, view, update or delete your products from this panel");
?>


<div class="row-fluid">
    <div class="span9">
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Products',
            'headerIcon' => 'icon-gift',
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label' => 'Create new Product', 'url' => array('create')),
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
            'id' => 'product-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'idProduct',
                'sku',
                'name',
                'price',
                //'description',
                //'image',
                //'Company_idCompany',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
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

