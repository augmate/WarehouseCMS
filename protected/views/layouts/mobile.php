<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  
  $cs = Yii::app()->getClientScript(); 
  $cs->registerCSSFile(Yii::app()->request->baseUrl."/css/mobile.css");
  $cs->registerCSSFile(Yii::app()->request->baseUrl."/css/font-awesome.min.css");
  ?>
  <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome-ie7.min.css">
    <![endif]-->
  <link rel="shortcut icon" href="http://www.nexweb.net/augmate/cms/warehouse/css/images/favicon.ico" type="image/x-icon" />
 
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php 
$bodyStyle="";
if($this->menu)
  $bodyStyle="class='subnav'";
?>
<body <?php echo $bodyStyle; ?> > 
  <?php 
  $user=User::model()->findByPk(Yii::app()->user->getId());
  $company="";
  if($user)
    $company=$user->Company_idCompany;
  
  if(Yii::app()->user->isGuest==false){
    $this->widget('bootstrap.widgets.TbNavbar',array(
        'type'=>'inverse',
        'brand'=>CHtml::encode(Yii::app()->name),
        'brandUrl'=>'#',
        'collapse'=>false,
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>$this->menu
            ),
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => array(
                    array('label' => '', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest,'icon'=>'off white 2x')
                )
            )
        ),
        )); 
  }
  ?> 
    

<?php 
  if($this->menu){

    $this->widget('bootstrap.widgets.TbNavbar',array(
      'htmlOptions'=>array( 'id'=>'subnav'),
      'brand'=>'', 
  'brandOptions'=>array('style'=>'padding:0px;'),
      'items'=>array(
         array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>$this->menu
          )
      ),
    ));

} ?>

<?php 
if(Yii::app()->user->isGuest==false){
?> 
<div class="container" id="page">
<?php }else{ ?>
    <h1 style="display:block;text-align: center; padding:10px; margin:0px; background:#fff; ">Augmate CMS</h1>
<div class="container" id="page"  style="padding-top:30px; margin-left:0px; background:transparent;">
<?php } ?>
  <?php echo $content; ?>  
</div><!-- page -->

</body>
</html>
