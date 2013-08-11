<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idOrder')); ?>:</b>
	#<?php echo CHtml::link(CHtml::encode($data->idOrder),array('view','id'=>$data->idOrder)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_idUser')); ?>:</b>
	<?php echo CHtml::encode($data->userIdUser->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />


</div>