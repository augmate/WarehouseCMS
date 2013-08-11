
<?php
//$this->layout="main_home";
$this->pageTitle = Yii::app()->name;
$this->pageHeader = array("Augmate Warehouse", "We are building the next generation internet software company");
?>



<section id="Augmate" style="width:1024px; margin: 0 auto; margin-top: 100px;" >
    
    <div class="row-fluid hr">
        <div class="span6">
            Introducing the worlds first CMS+AR (Content Management System + Augmented Reality) software platform 
        that will allow the placement of digital overlay information on top of the physical world, thus optimizing 
        a workers field of view.  Our software will allow warehouse companies or organizations personal manage 
        and deliver content efficiently and saving time and money. This system is made up of the following sections:
        </div>
        <div class="span6"><img style="margin-left:10px;float:right;" src="<?php echo Yii::app()->baseUrl; ?>/images/banner_1.jpg">
</div>
    </div>
    
    
    <img style="margin-left:10px;float:right;" src="http://www.augmate.net/augmate/images/warehouse/logo-high.png">


    <img style="margin-right:10px;float:left;" src="http://www.augmate.net/augmate/images/warehouse/android-intro-1c.png">
    
    <div class="row" style="">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Download',));
        ?>
        &nbsp;
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'primary',
            'size' => 'large',
            'label' => 'Login',));
        ?>
    </div>

    <img style="margin-left:10px;float:right;" src="http://www.augmate.net/augmate/images/warehouse/android-intro-3d.png">
    <b>Login:</b> The users can login with a user and password or with face recognition with camera capture
    <br /><br />
    <b>Orders:</b> Users can easily access all pending orders, in green are completed orders, in blue are orders in progress and in gray are the orders that have not started. With upper menu tab users can access to help and chat/message to other users/clients
    <br /><br />
    <b>Product List:</b> When users selects an order they can access the list of all the products for that order and then can pick each product. In gray are the products that are not picked, the green are picked and blue is the next product to be picked. Users can access a map to show what is the best way to pick each product.
    <br /><br />
    <b>Map and path to pick products:</b> On the map with an GPS system you can locate each product on the map and the location of each user. The map drawing is the most optimal way to locate all products.
    <br /><br />

    <img style="margin-right:10px;float:left;" src="http://www.augmate.net/augmate/images/warehouse/android-intro-2c.png"> 
    <b>Interactive Indicators and Picking:</b> The user can use indications to pick each product and locate best way to get the next product to pick.
    <br /><br />
    <b>Interactive Product Detection:</b> The mobile device can alert the user that he or she is near the product and proceed to detect the product from the barcode or QR code. When the product is picked a system alert is sent to the user with a dialog box and a icon will appear informing that the product was picked from the shelf.
    <br /><br />
    For more details contact to <a href="mailto:info@augmate.com">info@Augmate.com</a> or visit <a href="http://www.augmate.com" target="_blank">Augmate.com</a></p>

</section>
