<?php

$this->layout = '//layouts/mobile';

$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

$data=$model->search();
$dataArray=$data->getData();
$first=$dataArray[0];

$this->menu = array(
    //array('label'=>'List Order','url'=>array('index')),
    //array('label' => 'Create Order', 'url' => array('create')),
    array('label'=>'','url'=>array('view','id'=>$first->idOrder),'icon'=>'signin 2x')
);

$this->pageHeader = array("Manage Orders", "Create, view, update or delete your orders from this panel");
?>


<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'order-grid',
    'dataProvider' => $data,
    //'filter' => $model,
    'columns' => array(
        'idOrder',
        //'User_idUser',
        array(
            'name' => 'User_idUser',
            'value' => '$data->userIdUser->name',
            'type' => 'text',
        ),
        //'Company_idCompany',
        'date',
        /*array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),*/
    ),
));
?>
