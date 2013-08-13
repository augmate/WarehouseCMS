<div class="row-fluid">
    <div class="span9">

        	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'user-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array(
		        'class'=>'',
		      ),
		)); ?>
        
                    <?php
                    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
                        'title' => 'User',
                        'headerIcon' => 'icon-user',
                        'htmlOptions'=>array('class'=>'fixme'),
                        'headerButtons' => array(
                            array(
                                'class' => 'bootstrap.widgets.TbButtonGroup',
                                'buttons' => array(
                                    array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
                                    )
                                ),
                            ),
                        ),

                    ));
                    ?>
		
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
		
			
		
		<?php $this->endWidget(); ?>

            <?php $this->endWidget(); ?>
	</div>
	<div class="span3"><?php echo $this->renderPartial('/activity/index'); ?></div>
</div>
