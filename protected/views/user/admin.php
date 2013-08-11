<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create','url'=>array('create', 'role'=>$_GET['role'])),
);

if(isset($_GET['role']) && $_GET['role']==User::EMPLOYEE)
	$this->pageHeader=array("Manage Employees", "Create, view, update or delete your employees from this panel");
else if(isset($_GET['role']) && $_GET['role']==User::CUSTOMER)
	$this->pageHeader=array("Manage Customers", "Create, view, update or delete your customers from this panel");
else
	$this->pageHeader=array("Manage Users", "Create, view, update or delete your users from this panel");


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
