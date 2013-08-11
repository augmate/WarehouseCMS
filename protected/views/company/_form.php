<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well','style'=>'margin-top:30px;','enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span12','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'state',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'country',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->fileFieldRow($model,'logotype'); ?>
	<?php if($model->logotype!=""): ?>
	<img src="<?php echo Yii::app()->params['basePath']; ?>/upload/<?php echo $model->logotype; ?>" width="250px" />
	<?php endif; ?>
	
	<?php echo $form->fileFieldRow($model,'map'); ?>
	<?php if($model->map!=""): ?>
	<img src="<?php echo Yii::app()->params['basePath']; ?>/upload/<?php echo $model->map; ?>" width="250px" />
	<?php endif; ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
