<?php
/*
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name=>array('view','id'=>$model->idCompany),
	'Update',
);

$this->menu=array(
	array('label'=>'List Company','url'=>array('index')),
	array('label'=>'Create Company','url'=>array('create')),
	array('label'=>'View Company','url'=>array('view','id'=>$model->idCompany)),
	array('label'=>'Manage Company','url'=>array('admin')),
);
*/
$this->pageHeader=array("Company info", "Manage your company and information. Upload your logo and map.");
$this->layout="main";
?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
