<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);
/*
$this->menu=array(
	//array('label'=>'List User','url'=>array('index')),
	//array('label'=>'Manage User','url'=>array('admin')),
);*/
if(isset($_GET['role']) && $_GET['role']==User::EMPLOYEE)
	$this->pageHeader=array("Create Employees","");
else if(isset($_GET['role']) && $_GET['role']==User::CUSTOMER)
	$this->pageHeader=array("Create Customers","");
else
	$this->pageHeader=array("Create Users","");


?>


<br/><br/>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>