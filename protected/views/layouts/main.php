<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,500|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
       
        <?php 
        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/main.css');
        ?>
        
        <link rel="shortcut icon" href="http://www.nexweb.net/augmate/cms/warehouse/css/images/favicon.ico" type="image/x-icon" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <script>
        $(function(){
            $(window).scroll(function(){
                    var actualScrollPos=$(window).scrollTop();
                    if(actualScrollPos >= 40 ){
                        $(".fixme .bootstrap-widget-header").addClass("fixmetop");
                    }else{
                        $(".fixme  .bootstrap-widget-header").removeClass("fixmetop");
                    }
            });
        })
        </script>
        
    </head>
    <?php
    $bodyStyle = "";
    if ($this->menu)
        $bodyStyle = "class='subnav'";
    ?>
    <body <?php echo $bodyStyle; ?> > 
        <?php
        $user = User::model()->findByPk(Yii::app()->user->getId());
        $company = "";
        if ($user)
            $company = $user->Company_idCompany;
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => 'inverse',
            'brand' => CHtml::encode(Yii::app()->name),
            'brandUrl' => '#',
            'collapse' => true,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        //array('label' => 'Home', 'url' => array('/site/index')),
                        //array('label' => 'About', 'url' => array('/site/page', 'view' => 'about'), 'visible' => Yii::app()->user->isGuest),
                        //array('label' => 'Contact', 'url' => array('/site/contact'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Orders','icon'=>'icon-list', 'url' => array('/order/admin'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->role != 1),
                        array('label' => 'Products','icon'=>'icon-gift', 'url' => array('/product/admin'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->role != 1),
                        array('label' => 'Employees', 'icon'=>'icon-user','url' => array('/user/admin', 'role' => '4'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->role != 1),
                        array('label' => 'Customers', 'icon'=>'icon-user', 'url' => array('/user/admin', 'role' => '8'), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->role != 1),
                        array('label' => 'Company','icon'=>'icon-asterisk', 'url' => array('/company/update', 'id' => $company), 'visible' => !Yii::app()->user->isGuest && Yii::app()->user->role == 2),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')','icon'=>'icon-off', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    )
                )
            ),
        ));
        ?> 

        <?php if (isset($this->pageHeader) && count($this->pageHeader) > 0 && false): ?>
            <header class="jumbotron">
                <div class="container">
                    <h1><?php echo $this->pageHeader[0]; ?></h1>
                    <p><?php echo $this->pageHeader[1]; ?></p>
                </div>
            </header>
        <?php endif; ?>


        <?php
        if ($this->menu) {

            $this->widget('bootstrap.widgets.TbNavbar', array(
                'htmlOptions' => array('id' => 'subnav'),
                'brand' => '',
                'brandOptions' => array('style' => 'padding:0px;'),
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => $this->menu
                    )
                ),
            ));
        }
        ?>


        <div class="container-fluid" id="page">
            <?php if (isset($this->breadcrumbs) && false): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>  
        </div><!-- page -->

       <!-- <footer class="footer">
            <div class="container">
                Copyright &copy; <?php echo date('Y'); ?> by Augmate.<br/>
                All Rights Reserved.<br/>
            </div>
        </footer>
       -->

    </body>
</html>
