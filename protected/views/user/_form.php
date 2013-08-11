<div class="row">
	<div class="span4"></div>
	<div class="span4">


		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'user-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
		        'class'=>'well',
		      ),
		)); ?>
		
			<p class="help-block">Fields with <span class="required">*</span> are required.</p>
		
			<?php echo $form->errorSummary($model); ?>
		
			<?php echo $form->textFieldRow($model,'username',array('class'=>'span12','maxlength'=>45)); ?>
		
			<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span12')); ?>
		
			<?php echo $form->textFieldRow($model,'email',array('class'=>'span12','maxlength'=>45)); ?>
		
			<?php echo $form->hiddenField($model,'role',array('value'=>(isset($_GET['role']))?$_GET['role']:'')); ?>
		
			<?php echo $form->hiddenField($model,'perms',array('value'=>'0')); ?>
		
			<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>45)); ?>
		
			<?php 
			$user=User::model()->findByPk(Yii::app()->user->id);
			echo $form->hiddenField($model,'Company_idCompany',array('value'=>$user->Company_idCompany)); ?>
		
			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
		
		<?php $this->endWidget(); ?>

		
	</div>
	<div class="span4"></div>
</div>
