<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->idOrder=>array('view','id'=>$model->idOrder),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Order','url'=>array('index')),
	array('label'=>'Create Order','url'=>array('create')),
	array('label'=>'View Order','url'=>array('view','id'=>$model->idOrder)),
	array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<h1>Update Order <?php echo $model->idOrder; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
