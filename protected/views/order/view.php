<?php
$this->breadcrumbs=array(
	'Orders'=>array('index'),
	$model->idOrder,
);

$this->menu=array(
	//array('label'=>'List Order','url'=>array('index')),
	array('label'=>'Create Order','url'=>array('create')),
	array('label'=>'Update Order','url'=>array('update','id'=>$model->idOrder)),
	array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idOrder),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Order','url'=>array('admin')),
);
?>

<h1>View Order #<?php echo $model->idOrder; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
	        'name'=>'User_idUser',
	        'value'=>$model->userIdUser->name,
	        'type'=>'text',
        ),
		//'Company_idCompany',
		'date',
                'status',
                'partial_shipment_allowed'
	),
)); ?>



<div class="row">
	<div class="span8">
		<h2>Products</h2>
		<table class="items table">
			<thead>
				<tr>
					<th>#</th>
					<th>Sku</th>
					<th>Name</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach($model->productsQty as $productQty){
				?>
				<tr>
					<td><?php echo $productQty->product->idProduct ?></td>
					<td><?php echo $productQty->product->sku ?></td>
					<td><?php echo $productQty->product->name ?></td>
					<td><?php echo $productQty->Quantity ?></td>
				</tr>		
			<?php }
			?>		
			</tbody>
		</table>
	</div>
	<div class="span4">
		<h2>Add product to Order</h2>

		<?php /** @var BootActiveForm $form */
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'verticalForm',
		    'htmlOptions'=>array('class'=>'well'),
		)); ?>
		 
		<?php 
		$modelProductQty->Order_idOrder=$model->idOrder;
		echo $form->hiddenField($modelProductQty, 'Order_idOrder'); ?>
		<?php 
		$user=User::model()->findByPk(Yii::app()->user->id);

		echo $form->dropDownListRow($modelProductQty, 'Product_idProduct', CHtml::listData($user->company->products, 'idProduct', 'name')); ?>
		<?php echo $form->textFieldRow($modelProductQty, 'Quantity', array('class'=>'span3')); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Add')); ?>
		<?php $this->endWidget(); ?>
	</div>
</div>
