<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'idOrder',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'User_idUser',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Company_idCompany',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
