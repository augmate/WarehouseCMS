<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

<?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => ($model->isNewRecord)?'Create new Product':"Update product",
            'headerIcon' => 'icon-gift',
            'htmlOptions'=>array('class'=>'fixme'),
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label'=>'Create new','url'=>array('create'), 'visible'=>!$model->isNewRecord),
                        array('label'=>'View Product','url'=>array('view','id'=>$model->idProduct), 'visible'=>!$model->isNewRecord),
                        array('label'=>'Manage Product','url'=>array('admin')),
                        array('buttonType'=>'submit','type'=>'primary','label'=>$model->isNewRecord ? 'Create' : 'Save',)
                    ),
                ),
            )
        ));
        ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row-fluid">
            <div class="span6"><?php echo $form->textFieldRow($model,'sku',array('class'=>'span12','maxlength'=>255)); ?></div>
            <div class="span6"><?php echo $form->textFieldRow($model,'name',array('class'=>'span12','maxlength'=>255)); ?></div>
        </div>
        
        
        <div class="row-fluid">
            <div class="span4"><?php echo $form->textFieldRow($model,'quantity',array('class'=>'span12')); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'min_quantity_alert',array('class'=>'span12')); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'price',array('class'=>'span12')); ?></div>
        </div>
        
	

	

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span12')); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->hiddenField($model,'Company_idCompany',array('class'=>'span5')); ?>

        <div class="row-fluid">
            <div class="span4"><?php echo $form->textFieldRow($model,'aisle',array('class'=>'span12')); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'shelf_unit',array('class'=>'span12')); ?></div>
            <div class="span4"><?php echo $form->textFieldRow($model,'shelf',array('class'=>'span12')); ?></div>
        </div>

        

	

	
        
	<p>Click on image to set localization of product</p>
	<?php 
		$user=User::model()->findByPk(Yii::app()->user->id);
		$company=$user->company;
		?>
		<div id="pointer_div"  onClick='point_it(event)' >
			<img style="position:absolute; top:0px: left:0px; max-width:none;" id='mapImage' src='<?php echo Yii::app()->params['basePath']?>/upload/<?php echo $company->map ?>' alt='map' />
			<div class="cursorMap" id="cursorMap" style="top:<?php echo $model->mapY-6;?>px; left:<?php echo $model->mapX-6;?>px;"></div>
		</div>
		<script>
			$("#mapImage").load(function(){
				$("#pointer_div").width($("#mapImage").width());
				$("#pointer_div").height($("#mapImage").height());
			});
			$("#mapImage").ready(function(){
				$("#pointer_div").width($("#mapImage").width());
				$("#pointer_div").height($("#mapImage").height());
			});
			function point_it(event){
				pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("pointer_div").offsetLeft;
				pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("pointer_div").offsetTop;
				$("#cursorMap").css('left', (pos_x-6) +"px");
				$("#cursorMap").css('top', (pos_y-6) +"px");
				//document.getElementById("cursorMap").style.visibility = "visible" ;
				$('#Product_mapX').val(pos_x);
				$('#Product_mapY').val(pos_y);
			}
		</script>
	<?php echo $form->hiddenField($model,'mapX'); ?>
	
	<?php echo $form->hiddenField($model,'mapY'); ?>

	

                <?php $this->endWidget(); ?>
                
<?php $this->endWidget(); ?>
