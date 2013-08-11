<?php
$this->layout = '//layouts/mobile';

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/grid.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/version.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/detector.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/formatinf.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/errorlevel.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/bitmat.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/datablock.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/bmparser.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/datamask.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/rsdecoder.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/gf256poly.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/gf256.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/decoder.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/QRCode.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/findpat.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/alignpat.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl . "/js/qr/databr.js");



$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->idOrder,
);

$this->menu = array(
    array('label' => '', 'url' => array('qrDecode'), 'icon' => 'qrcode 2x', 'itemOptions' => array('id' => 'linkQrDecode')),
    array('label' => '', 'url' => array('map'), 'icon' => 'map-marker 2x', 'itemOptions' => array('id' => 'linkMap')),
    array('label' => '', 'url' => array('completeOrder', 'id' => $model->idOrder), 'icon' => 'check 2x'),
    array('label' => '', 'url' => array('admin'), 'icon' => 'reply 2x'),
);
?>
<script>
var products=Array();
<?php
foreach ($model->productsQty as $productQty) {
?>
products[<?php echo $productQty->product->idProduct ?>]=
    {
        'id':'<?php echo $productQty->product->idProduct ?>',
        'name':'<?php echo $productQty->product->name ?>',
        'image':'<?php echo Yii::app()->params['basePath']."upload/".$productQty->product->image ?>',
        'sku':'<?php echo $productQty->product->sku ?>',
        'description':'<?php echo $productQty->product->description ?>',
        'qty':'<?php echo $productQty->Quantity ?>',
        'picked':'<?php echo $productQty->Picked ?>'
    };
<?php
}
?>
</script>
<div class="row">

    <h1 style="font-size:24px;">Order #<?php echo $model->idOrder; ?> for <?php echo $model->userIdUser->name; ?> (<?php echo $model->date ?>) </h1>



    <table class="items table">
        <thead>
            <tr>
                <th>#</th>
                <th>Sku</th>
                <th>Name</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model->productsQty as $productQty) {
                ?>
                <tr id="product_<?php echo $productQty->product->idProduct; ?>" class="<?php echo ($productQty->Quantity==$productQty->Picked)?'success':'';?>">
                    <td><?php echo $productQty->product->idProduct ?></td>
                    <td><?php echo $productQty->product->sku ?></td>
                    <td><?php echo $productQty->product->name ?></td>
                    <td><?php echo $productQty->Quantity ?></td>
                </tr>		
            <?php }
            ?>		
        </tbody>
    </table>
</div>
<div class="map" style="right:-90%;display:none;">
    <?php
    $user = User::model()->findByPk(Yii::app()->user->id);
    $company = $user->company;

    $mapStr = "<div id='pointer_div'  onClick='point_it(event)' style='background:url(" . Yii::app()->params['basePath'] . "upload/" . $company->map . ") top center no-repeat; background-size:contain; height:100%; width:100%; ' >
    </div>";
    echo $mapStr;
    ?>

</div>
<div id="qrdecode_div" style="display: none;">
    
    <div style="padding:15px;">
        <input  type="file" id="qrfile" accept="image/*;capture=camera">

        <div id="progress_bar" class="progress progress-striped active"><div id="progress_bar_per" class="bar" style="width: 60%;"></div></div>
        <canvas width="320" height="240" id="qr-canvas" style="display:none;"></canvas>
        <div id="whatDo" class="alert"></div>
        <div class="row-fluid">
            <div class="span6"><img src="" id="imgProduct" /></div>
            <div class="span6">
                <h2 id="productName"></h2>
                <p id="productDescription" style="max-height:150px; overflow-y: auto;"></p>
            </div>
        </div>
        <div class="row-fluid" style="margin-top:8px;">
            <a href="#" class="btn btn-inverse" id="closeProduct">Close</a>
            <a href="#" class="btn btn-success" id="pickProduct">Pick Product</a>
        </div>
    </div>
</div>
<script>
    var MapVisible=false;
    var canvas = document.getElementById('qr-canvas');
    var context = canvas.getContext('2d');
    var progress;
    
    function QRReaded(data){
        $("#pickProduct").click(function(){return false;});
        //Check if data is on product list
        //The pattern of product is: Product: ID_SKU
        var d=data.split("_");
        if(d.length==2){
            //var buttonHtml='<button type="button" class="close" data-dismiss="alert">&times;</button>';
            var buttonHtml="";
            var sku=d[1];
            var id=d[0].substr(9);
            if(products[id]!=null){
                $("#whatDo").removeClass("alert-error");
                if(products[id].qty!=products[id].picked){
                    $("#whatDo").addClass("alert-success");//"ID:"+id+" SKU:"+sku
                    $("#whatDo").html("The product #"+id+" and sku "+sku+" is in the order list. <strong>Pick "+products[id].qty+" itmes</strong>"+buttonHtml);
                }else{
                    $("#whatDo").addClass("alert-warning");//"ID:"+id+" SKU:"+sku
                    $("#whatDo").html("The product #"+id+" and sku "+sku+" is in the order list but <strong>it's Picked </strong>"+buttonHtml);
                }
                $("#imgProduct").attr("src",products[id].image);
                $("#productName").html(products[id].name);
                $("#productDescription").html(products[id].description);
                if(products[id].qty!=products[id].picked){
                    $("#pickProduct").show();
                }
                $("#pickProduct").click(function(){
                    $.ajax({
                        type:"POST",
                        url:"<?php echo CHtml::normalizeUrl(array('/order/pickProduct'))?>",
                        data:{idProd:id,idOrder:<?php echo $model->idOrder;?>}
                    }).done(function(data){
                        if(data=="Ok"){
                            //Check if all products are picked
                            var allPicked=true;
                            for(var i=0; i< products.length; i++){
                                if(products[i]!=undefined){
                                    if(products[i].picked!=products[i].qty){
                                        allPicked=false;
                                    }
                                }
                            }
                            if(allPicked){
                                alert("Order Finished");
                            }
                            $("#product_"+id).addClass('success');
                            $("#qrdecode_div").hide();
                        }
                    });
                    
                    return false;
                });
            }else{
                $("#whatDo").removeClass("alert-success");
                $("#whatDo").addClass("alert-error");
                $("#whatDo").html("The product is not in the order list."+buttonHtml);
            }
        }else{
            $("#list").html(data);
            $("#whatDo").removeClass("alert-success");
            $("#whatDo").addClass("alert-error");
            $("#whatDo").html("Error decoding code"+data);
        }
        
        
    }
    function errorHandler(evt) {
        switch(evt.target.error.code) {
          case evt.target.error.NOT_FOUND_ERR:
            alert('File Not Found!');
            break;
          case evt.target.error.NOT_READABLE_ERR:
            alert('File is not readable');
            break;
          case evt.target.error.ABORT_ERR:
            break; // noop
          default:
            alert('An error occurred reading this file.');
        };
      }

      function updateProgress(evt) {
        // evt is an ProgressEvent.
        if (evt.lengthComputable) {
          var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
          // Increase the progress bar length.
          if (percentLoaded < 100) {
            $("#progress_bar_per").css("width", percentLoaded + '%');
          }
        }
      }
    $(function(){
        
        qrcode.callback = QRReaded;
        progress= $("#progress_bar");
        
        $("#linkMap a").click(function(){
            if(MapVisible){
                $(".map").animate({'right':"-90%"},500,function(){$(".map").hide()});
                MapVisible=false;
            }else{
                $(".map").show();
                $(".map").animate({'right':"0%"},500);
                MapVisible=true;
            }
            return false;
        });
        
        $("#linkQrDecode").click(function(){
            $("#qrdecode_div").show();
            $("#pickProduct").hide();
            $("#progress_bar").hide();
            return false;
        });
        $("#closeProduct").click(function(){
            $("#qrdecode_div").hide();
            return false;
        })
        $("#qrfile").change(function(evt){
            var files = evt.target.files; // FileList object

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                // Only process image files.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();
                reader.onerror = errorHandler;
                reader.onprogress = updateProgress;
                
                var imageObj = new Image();

                imageObj.onload = function() {
                    context.drawImage(imageObj, 0, 0,320,240);
                    try{
                        qrcode.decode();
                    }catch(iae){
                        $("#whatDo").removeClass("alert-success");
                        $("#whatDo").addClass("alert-error");
                        $("#whatDo").html("Error decoding. "+iae);
                    }
                };
                reader.onloadstart = function(e) {
                    $("#progress_bar").show();
                    $("#progress_bar_per").css("width", '0%');
                  };
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                         //imageObj.src = e.target.result;
                         imageObj.src = "data:image/jpeg;base64,"+window.btoa(e.target.result);
                         $("#progress_bar_per").css("width", '100%');
                         $("#progress_bar").hide();
                    };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsBinaryString(f);
                 
             
                
                
               
            }
           
        });
        
    });
</script>

