<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->idOrder,
);

/* $this->menu=array(
  //array('label'=>'List Order','url'=>array('index')),
  array('label'=>'Create Order','url'=>array('create')),
  array('label'=>'Update Order','url'=>array('update','id'=>$model->idOrder)),
  array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idOrder),'confirm'=>'Are you sure you want to delete this item?')),
  array('label'=>'Manage Order','url'=>array('admin')),
  ); */
?>

<div class="row-fluid">
    <div class="span9">
        <?php
        $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'View Order #' . $model->idOrder,
            'headerIcon' => 'icon-th-list',
            'headerButtons' => array(
                array(
                    'class' => 'bootstrap.widgets.TbButtonGroup',
                    'buttons' => array(
                        array('label'=>'Create Order','url'=>array('create')),
                        //array('label'=>'Update Order','url'=>array('update','id'=>$model->idOrder)),
                        array('label'=>'Delete Order','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->idOrder),'confirm'=>'Are you sure you want to delete this item?')),
                        array('label'=>'Manage Order','url'=>array('admin')),
                    ),
                ),
            ),
            // when displaying a table, if we include bootstra-widget-table class
            // the table will be 0-padding to the box
            'htmlOptions' => array('class' => 'fixme')
        ));
        ?>


        <?php
        
        $status="<span class='label'>Not started</span>";
        if($model->status==Order::IN_PROGRESS)
            $status="<span class='label label-info'>In progress</span>";
        else if($model->status==Order::DELIVERY_TO_PACKAGING)
            $status="<span class='label label-warning'>Delivery to packaging</span>";
        else if($model->status==Order::COMPLETED)
            $status="<span class='label label-success'>Completed</span>";
        
        $partial_shipment_allowed="<span class='label label-important'>No allowed</span>";
        if($model->partial_shipment_allowed)
            $partial_shipment_allowed="<span class='label label-success'>Allowed</span>";
        
        
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                array(
                    'name' => 'User_idUser',
                    'value' => $model->userIdUser->name,
                    'type' => 'text',
                ),
                //'Company_idCompany',
                'date',
                array(
                    'name' => 'status',
                    'value' => $status,
                    'type' => 'raw',
                ),
                array(
                    'name' => 'partial_shipment_allowed',
                    'value' => $partial_shipment_allowed,
                    'type' => 'raw',
                ),
            ),
        ));
        ?>



        <div class="row">
            <div class="span7">
                <?php
                $this->beginWidget('bootstrap.widgets.TbBox', array(
                    'title' => 'Products',
                    'headerIcon' => 'icon-th-list',
                ));
                ?>
                    <table class="items table">
                    <thead>
                        <tr>
                            <th>Sku</th>
                            <th>Name</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($model->productsQty as $productQty) {
                            ?>
                            <tr>
                                <td><?php echo $productQty->product->sku ?></td>
                                <td><?php echo $productQty->product->name ?></td>
                                <td><?php echo $productQty->Quantity ?></td>
                            </tr>		
<?php }
?>		
                    </tbody>
                </table>
                <?php $this->endWidget(); ?>
            </div>
            <div class="span5">
                

                <?php
                /** @var BootActiveForm $form */
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'verticalForm',
                    'htmlOptions' => array('class' => ''),
                ));
                ?>
                <?php
                $this->beginWidget('bootstrap.widgets.TbBox', array(
                    'title' => 'Add product',
                    'headerIcon' => 'icon-th-list',
                    'headerButtons' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbButtonGroup',
                            'buttons' => array(
                                array('buttonType' => 'submit', 'icon' => 'ok', 'label' => 'Add')
                            ),
                        ),
                    ),
                    // when displaying a table, if we include bootstra-widget-table class
                    // the table will be 0-padding to the box
                    'htmlOptions' => array('class' => '')
                ));
                ?>
                <?php
                $modelProductQty->Order_idOrder = $model->idOrder;
                echo $form->hiddenField($modelProductQty, 'Order_idOrder');
                ?>
                <div class="row-fluid">
                    <div class="span9">
                        <?php
                        $user = User::model()->findByPk(Yii::app()->user->id);

                        echo $form->dropDownListRow($modelProductQty, 'Product_idProduct', CHtml::listData($user->company->products, 'idProduct', 'name'), array('class' => 'span12'));
                        ?>
                    </div>
                    <div class="span3">
                        <?php echo $form->textFieldRow($modelProductQty, 'Quantity', array('class' => 'span12')); ?>
                    </div>
                </div>
                
                
                    
                <?php $this->endWidget(); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>

<?php $this->endWidget() ?>
    </div>
    <div class="span3">
        <?php echo $this->renderPartial('/activity/index'); ?>
    </div>
</div>



