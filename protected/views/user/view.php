<?php
Yii::import('application.extensions.phpqrcode.*');
require_once('qrlib.php');

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name,
);
/*
$this->menu = array(
    //array('label'=>'List User','url'=>array('index')),
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Update User', 'url' => array('update', 'id' => $model->idUser)),
    array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idUser), 'confirm' => 'Are you sure you want to delete this item?')),
        //array('label'=>'Manage User','url'=>array('admin')),
);*/
?>

<div class="row-fluid">
    <div class="span9">

        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'View User',
            'headerIcon' => 'icon-user',
            'htmlOptions'=>array('class'=>'fixme'),
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label' => 'Create User', 'url' => array('create')),
                        array('label' => 'Update User', 'url' => array('update', 'id' => $model->idUser)),
                        array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idUser), 'confirm' => 'Are you sure you want to delete this item?')),
                    ),
                ),
            ),
            
        ));
        ?>
        
            

    
    
        <div class="row-fluid">
            <div class="span6">
                <?php
                $this->widget('bootstrap.widgets.TbDetailView', array(
                    'data' => $model,
                    'attributes' => array(
                        'idUser',
                        'username',
                        //'password',
                        'email',
                        //'role',
                        //'perms',
                        'name',
                    //'Company_idCompany',
                    ),
                ));
                ?>

            </div>
            <div class="span6">
                <?php
                $fileQR = "QR_user_" . $model->idUser . ".png";
                $fileQRPath = dirname(__FILE__) . "/../../../upload/" . $fileQR;
                QRcode::png($model->username.":".$model->password, $fileQRPath, 'M', 6);
                $qrImageStr = "<img src='" . Yii::app()->params['basePath'] . "/upload/" . $fileQR . "' alt='QR Code'/>";
                echo $qrImageStr;
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="span3">
<?php echo $this->renderPartial('/activity/index'); ?>
    </div>
</div>
