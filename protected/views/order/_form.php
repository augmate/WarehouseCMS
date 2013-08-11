<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
	$user=User::model()->findByPk(Yii::app()->user->id);
	$condition='role='.User::CUSTOMER. ' and Company_idCompany='.$user->Company_idCompany;
	echo $form->dropDownListRow($model,'User_idUser',CHtml::listData(User::model()->findAll($condition), 'idUser', 'name'),array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'Company_idCompany',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
