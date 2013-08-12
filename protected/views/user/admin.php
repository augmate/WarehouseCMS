<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	//array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create','url'=>array('create', 'role'=>$_GET['role'])),
);*/
$section="Users";
if(isset($_GET['role']) && $_GET['role']==User::EMPLOYEE){
	$this->pageHeader=array("Manage Employees", "Create, view, update or delete your employees from this panel");
        $section="Employees";
}else if(isset($_GET['role']) && $_GET['role']==User::CUSTOMER){
	$this->pageHeader=array("Manage Customers", "Create, view, update or delete your customers from this panel");
        $section="Customers";
}else{
	$this->pageHeader=array("Manage Users", "Create, view, update or delete your users from this panel");
}

?>

<div class="row-fluid">
    <div class="span9">
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => $section,
            'headerIcon' => 'icon-th-list',
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label' => 'Create new', 'url' => array('create', 'role'=>$_GET['role'])),
                    ),
                ),
            ),
            // when displaying a table, if we include bootstra-widget-table class
            // the table will be 0-padding to the box
            'htmlOptions' => array('class' => 'bootstrap-widget-table fixme')
        ));
        ?>

            <?php $this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'user-grid',
                    'dataProvider'=>$model->search(),
                    'filter'=>$model,
                    'columns'=>array(
                            'idUser',
                            'username',
                            //'password',
                            'email',
                            //'role',
                            //'perms',
                            /*
                            'name',
                            'Company_idCompany',
                            */
                            array(
                                    'class'=>'bootstrap.widgets.TbButtonColumn',
                            ),
                    ),
            )); ?>
            <?php $this->endWidget(); ?>
    </div>
    <div class="span3">
        <?php echo $this->renderPartial('/activity/index'); ?>
    </div>
</div>