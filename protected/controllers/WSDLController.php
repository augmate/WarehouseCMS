<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WSDLController
 *
 * @author damiles
 */
class WSDLController extends CController {
    
    //put your code here
    public function actions()
    {
        return array(
            'api'=>array(
                'class'=>'CWebServiceAction',
                'classMap'=>array(
                    'Company',
                    'Order',
                    'Product',
                    'OrderHasProduct'
                )
            ),
        );
    }
    
    private function checkAuth($auth){
        return true;
    }
    
    /**
     * 
     * @param int $id
     * @param string $auth
     * @return Company
     * @soap
     */
    public function getCompany($id,$auth){
        if($this->checkAuth($auth)){
            $model = Company::model() -> findByPk($id);
            if ($model === null)
                    return null;
            return $model;
        }
    }
    
    /**
     * 
     * @param int $idCompany
     * @param string $auth
     * @return Order[]
     * @soap
     */
    public function getOrders($idCompany, $auth){
        if($this->checkAuth($auth)){
            $models = Order::model()->findAllByAttributes(array('Company_idCompany'=>$idCompany),'status < 2');
            return $models;
        }
    }
    
    /**
     * 
     * @param int $idOrder
     * @param string $auth
     * @return Product[]
     * @soap
     */
    public function getProducts($idOrder,$auth){
        if($this->checkAuth($auth)){
            $order = Order::model()->findByPk($idOrder);
            return $order->products;
        }
    }
    
    /**
     * 
     * @param int $idProduct
     * @param string $auth
     * @return Product
     * @soap
     */
    public function getProduct($idProduct, $auth){
        if($this->checkAuth($auth)){
            $model=Product::model()->findByPk($idProduct);
            if($model===null)
              return null;
            return $model;
        }
    }
    
    /**
     * 
     * @param int $idOrder
     * @param int $idProduct
     * @param string $auth
     * @return OrderHasProduct
     * @soap
     */
    public function getProductQty($idOrder, $idProduct, $auth){
        if($this->checkAuth($auth)){
            $model=OrderHasProduct::model()->findByPk(array('Order_idOrder'=>$idOrder,'Product_idProduct'=>$idProduct));
            if($model===null)
              return null;
            return $model;
        }
    }
    
}

?>
