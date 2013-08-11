<?php
Yii::import('application.extensions.phpqrcode.*');
require_once('qrlib.php');


$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->name,
);

/*$this->menu = array(
    //array('label'=>'List Product','url'=>array('index')),
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Update Product', 'url' => array('update', 'id' => $model->idProduct)),
    array('label' => 'Delete Product', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->idProduct), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Product', 'url' => array('admin')),
);*/
?>

<div class="row-fluid">
    <div class="span9">
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'View Product',
            'headerIcon' => 'icon-gift',
            'htmlOptions'=>array('class'=>'fixme'),
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label' => 'Create new', 'url' => array('create')),
                        array('label' => 'Update', 'url' => array('update', 'id' => $model->idProduct)),
                        array('label' => 'Delete', 'url' => '#', 'htmlOptions' => array('submit' => array('delete', 'id' => $model->idProduct), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => 'Manage Products', 'url' => array('admin')),
                    ),
                ),
            ),
            
        ));
        ?>
        <?php
        $user = User::model()->findByPk(Yii::app()->user->id);
        $company = $user->company;

        $mapStr = "<div id='pointer_div'  onClick='point_it(event)' >
			<img style='position:absolute; top:0px: left:0px;width:auto;' id='mapImage' src='" . Yii::app()->params['basePath'] . "upload/" . $company->map . "' alt='map' />
			<div class='cursorMap' id='cursorMap' style='top:" . ($model->mapY - 6) . "px; left:" . ($model->mapX - 6) . "px;'></div>
		</div>";
        ?>


        <?php
        $fileQR = "QR_" . $model->idProduct . ".png";
        $fileQRPath = dirname(__FILE__) . "/../../../upload/" . $fileQR;
        QRcode::png('Product: ' . $model->idProduct . "_" . $model->sku, $fileQRPath, 'M', 6);
        $qrImageStr = "<img src='" . Yii::app()->params['basePath'] . "/upload/" . $fileQR . "' alt='QR Code'/>";
        ?>

        <?php
        $fileVuforia = "frameMarker_" . sprintf('%1$03d', $model->idProduct) . ".png";
        $vuforiaImage = "<img src='" . Yii::app()->params['basePath'] . "/upload/vuforia/" . $fileVuforia . "'  style='display:none;' id='vuforiaImg' alt='Vuforia Code'/>";
        $augmateImage = "<img src='" . Yii::app()->params['basePath'] . "/upload/AugmateLogo.png' width='200' style='display:none;' id='augmateImg'/>";
        echo $vuforiaImage;
        echo $augmateImage;
        ?>
        <canvas id="c2" style="display:none;"></canvas>
        <script>

            window.onload = function() {
                var img1 = document.getElementById('vuforiaImg');
                var imgLogo = document.getElementById('augmateImg');
                var c2 = document.getElementById('c2');
                var ctx2 = c2.getContext('2d');
                var zoom = 10;

                var offtx = document.createElement('canvas').getContext('2d');
                offtx.drawImage(img1, 0, 0);
                var imgData = offtx.getImageData(0, 0, img1.width, img1.height).data;

                var offtxA = document.createElement('canvas').getContext('2d');
                offtxA.drawImage(imgLogo, 0, 0);
                var imgDataA = offtxA.getImageData(0, 0, imgLogo.width, imgLogo.height).data;

                c2.width = img1.width * zoom;
                c2.height = img1.height * zoom;

                ctx2.clearRect(0, 0, c2.width, c2.height);
                for (var x = 0; x < img1.width; ++x) {
                    for (var y = 0; y < img1.height; ++y) {
                        var i = (y * img1.width + x) * 4;
                        var r = imgData[i  ];
                        var g = imgData[i + 1];
                        var b = imgData[i + 2];
                        var a = imgData[i + 3];
                        ctx2.fillStyle = "rgba(" + r + "," + g + "," + b + "," + (a / 255) + ")";
                        ctx2.fillRect(x * zoom, y * zoom, zoom, zoom);
                    }
                }
                for (var x = 0; x < imgLogo.width; ++x) {
                    for (var y = 0; y < imgLogo.height; ++y) {
                        var i = (y * imgLogo.width + x) * 4;
                        var r = imgDataA[i  ];
                        var g = imgDataA[i + 1];
                        var b = imgDataA[i + 2];
                        var a = imgDataA[i + 3];
                        ctx2.fillStyle = "rgba(" + r + "," + g + "," + b + "," + (a / 255) + ")";
                        ctx2.fillRect(x + 130, y + 167, 1, 1);
                    }
                }

                var img = c2.toDataURL("iamge/png");
                var vuforia = document.getElementById('vuforia');
                vuforia.src = img;
            };
        </script>	
        
        <div class="row-fluid">
            <div class="span6">
                <div class="row-fluid">
                    <span class="product_descr_name"><b>Name:</b> <?php echo $model->name ?></span>
                </div>
                <div class="row-fluid">
                    <div class="span6"><b>Sku:</b> <?php echo $model->sku ?></div>
                    <div class="span6"><b>Price:</b> <?php echo $model->price ?></div>
                </div>
                <div class="row-fluid">
                    <div class="span6"><b>Quantity:</b> <?php echo $model->quantity ?></div>
                    <div class="span6"><b>Min Qty Alert:</b> <?php echo $model->min_quantity_alert ?></div>
                </div>
                <div class="row-fluid">
                    <div class="span12"><b>Description:</b> <?php echo $model->description ?></div>
                    
                </div>

                <div class="row-fluid">
                    <div class="span6"><b>Qr code:</b><br><?php echo $qrImageStr ?></div>
                    <div class="span6"><b>Vuforia Code: </b><br><img style="background:#fff;" width="198" src="" id="vuforia" /></div>
                </div>
            </div>
            <div class="span6">
                <b>Image:</b><br><?php echo CHtml::image(Yii::app()->params['basePath'] . "/upload/" . $model->image) ?>
            </div>
        </div>
        
        <div class="row-fluid">
            <span class="product_view_location">Product location:</span>
            <div class="row-fluid">
                <div class="span2">
                    <b>Aisle:</b><span class="badge"><?php echo $model->aisle ?></span><br>
                    <b>Shelf:</b><span class="badge badge-success"><?php echo $model->shelf ?></span> <br>
                    <b>Shelf Unit:</b><span class="badge badge-warning"><?php echo $model->shelf_unit ?></span><br><br>
                </div>
                <div class="span10"><?php echo $mapStr ?></div>
            </div>
            
        </div>
            
    
        <script>
            $(document).ready(function() {
                $("#mapImage").attr('src','<?php echo Yii::app()->params['basePath'] . "/upload/" . $company->map ?>').load(function() {
                    $("#pointer_div").width($("#mapImage").width());
                    $("#pointer_div").height($("#mapImage").height());
                });
                /*$("#mapImage").ready(function() {
                    $("#pointer_div").width($("#mapImage").width());
                    $("#pointer_div").height($("#mapImage").height());
                });*/
            })
            
        </script>

        <?php $this->endWidget(); ?>
        
    </div>
    <div class="span3">
        <?php echo $this->renderPartial('/activity/index'); ?>
    </div>
</div>

