<div class="row-fluid">
    <div class="span9">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'company-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'','style'=>'','enctype'=>'multipart/form-data'),
)); ?>
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Orders',
            'headerIcon' => 'icon-th-list',
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
            // when displaying a table, if we include bootstra-widget-table class
            // the table will be 0-padding to the box
            'htmlOptions' => array('class' => 'bootstrap-widget-table fixme')
        ));
        ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span12','maxlength'=>255)); ?>

	
        <div class="row-fluid">
            <div class="span4"><?php echo $form->textFieldRow($model,'phone',array('class'=>'span12','maxlength'=>45)); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'state',array('class'=>'span12','maxlength'=>255)); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'country',array('class'=>'span12','maxlength'=>255)); ?></div>
        </div>
	

        <div class="row-fluid">
            <div class="span6">
	<?php echo $form->fileFieldRow($model,'logotype'); ?>
	<?php if($model->logotype!=""): ?>
        <br><img src="<?php echo Yii::app()->params['basePath']; ?>/upload/<?php echo $model->logotype; ?>" width="250px" />
	<?php endif; ?>
            </div>
            <div class="span6">
	<?php echo $form->fileFieldRow($model,'map'); ?>
	<?php if($model->map!=""): ?>
        <br><img src="<?php echo Yii::app()->params['basePath']; ?>/upload/<?php echo $model->map; ?>" width="250px" />
	<?php endif; ?>
            </div>
        </div>
        
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
    </div>
    <div class="span3"><?php echo $this->renderPartial('/activity/index'); ?></div>
</div>