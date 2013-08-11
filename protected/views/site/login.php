<?php
$minSpan=4;
$maxSpan=4;
if (Yii::app()->mobileDetect->isMobile() || Yii::app()->mobileDetect->isTablet()  || isset($_GET['m']) ) {
        $this->layout='//layouts/mobile';
        $minSpan=1;
        $maxSpan=10;
}
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
  'Login',
);
$this->pageHeader=array("Login", "Please fill out the following form with your login credentials")
?>
<section id="login">
<div class="row-fluid">
  <div class="span<?php echo $minSpan ?>"></div>
  <div class="span<?php echo $maxSpan ?>">
    <div class="row-fluid">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
      'id'=>'login-form',
      'enableClientValidation'=>true,
      'clientOptions'=>array(
        'validateOnSubmit'=>true,
      ),
      'htmlOptions'=>array(
        'class'=>'well',
      ),
    )); ?>
    
      
      <?php echo $form->textFieldRow($model,'username',array('class'=>'span12','maxlength'=>45,'placeholder'=>'Username')); ?>

      <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span12','placeholder'=>'Password')); ?>
    
      <?php
        if (!Yii::app()->mobileDetect->isMobile() && !Yii::app()->mobileDetect->isTablet()   && !isset($_GET['m']) ) {   
       ?>
      <div class=" rememberMe">
        <?php echo $form->checkBoxRow($model,'rememberMe'); ?>
      </div>
        <?php } ?>
      <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
          'buttonType'=>'submit',
          'type'=>'primary',
          'label'=>'Login',
        )); ?>
      </div>
    
    <?php $this->endWidget(); ?>
    </div><!-- form -->
  </div>
  <div class="span<?php echo $minSpan ?>"></div>
</div>
</section>