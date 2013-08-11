<?php
$this->breadcrumbs=array(
	'Companies'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Company','url'=>array('index')),
	array('label'=>'Create Company','url'=>array('create')),
	array('label'=>'Update Company','url'=>array('update','id'=>$model->idCompany)),
	array('label'=>'Delete Company','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idCompany),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Company','url'=>array('admin')),
);
?>

<h1>View Company #<?php echo $model->idCompany; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'idCompany',
		'name',
		'address',
		'phone',
		'state',
		'country',
		'logotype',
	),
)); ?>
