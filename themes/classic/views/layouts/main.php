<?php /* @var $this Controller */ ?>


<!DOCTYPE html>
<html>
    <head>
        <?php
        $cs = Yii::app()->clientScript;

        $baseUrl = Yii::app()->request->baseUrl;
//        $cs->registerScriptFile($baseUrl.'/js/yourscript.js');
//        <script src = "..//..//extensions/formvalidation/vendor/jquery/jquery.min.js" type = "text/javascript"></script>
//  <script src="..//..//extensions/formvalidation/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
//  <script src="..//..//extensions/formvalidation/dist/js/formValidation.js" type="text/javascript"></script>
//  <script src="..//..//extensions/formvalidation/dist/js/framework/bootstrap.js" type="text/javascript"></script>

        /**
         * StyleSheets
         */
        ?>

        <?php
//$cs->registerCoreScript('jquery', CClientScript::POS_END);
        $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
        ?>


        <?php
//$cs->registerCssFile($baseUrl.'/extensions/formvalidation/vendor/bootstrap/css/bootstrap.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/dist/css/formValidation.css');
        $cs->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap-theme.css');

        /**
         * JavaScripts
         */
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vendor/jquery/jquery.min.js');
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vendor/bootstrap/js/bootstrap.min.js');
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.ui.datepicker.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.ui.datepicker.ext.be.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/dist/js/formValidation.js');
        $cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/dist/js/framework/bootstrap.js');

//$cs->registerCoreScript('vendor/jquery/jquery.min.js', CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->request->baseUrl  . '/js/bootstrap.min.js', CClientScript::POS_END);
        $cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
        ?>


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
        <?php // echo CHtml::cssFile("css/styless.css");  ?>
        <?php // echo CHtml::scriptFile("js/script.js");  ?>
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styless.css">


        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?version=1">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">

                <div id="logo" style="display: inline;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/aw_biotec.jpg" alt="" 
                         style="margin-bottom: 10px;"/>
                </div>
                <div style="display: inline;">
                    <?php if (isset($_SESSION)) {
                        echo $_SESSION['EMPLOYEEID'] . ':' . $_SESSION['GIVENNAMEENGLISH'] . ' ' . $_SESSION['FAMILYNAMEENGLISH'];
                    } ?></div>

                <div id="cssmenu">
                    <?php
                    if (Yii::app()->user->isGuest) {
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest)
                            ),
                        ));
                    } else if (Yii::app()->user->role == 'admin') {
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'จดหมาย', 'url' => array('/filesgen/let')),
                                array('label' => 'บันทึกข้อความ', 'url' => array('/filesgen/memo')),
                                array('label' => 'Letter', 'url' => array('/filesgen/let_eng')),
                                array('label' => 'Memo', 'url' => array('/filesgen/memo_eng')),
                                array('label' => 'Select', 'url' => array('/selectopt/admin')),
                                array('label' => 'รายการล่าสุด', 'url' => array('/filesgen/last_select')),
                            //array('label' => 'Logout (' . Yii::app()->session['empName'] . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                            ),
                        ));
                    } else if (Yii::app()->user->role == 'user') {
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'จดหมาย', 'url' => array('/filesgen/let')),
                                array('label' => 'บันทึกข้อความ', 'url' => array('/filesgen/memo')),
                                array('label' => 'Letter', 'url' => array('/filesgen/let_eng')),
                                array('label' => 'Memo', 'url' => array('/filesgen/memo_eng')),
                                array('label' => 'รายการล่าสุด', 'url' => array('/filesgen/last_select')),
                            //array('label' => 'Admin', 'url' => array('/site/login?u=a'), 'visible' => !Yii::app()->user->isGuest)
                            ),
                        ));
                    }
                    ?>
                </div>
            </div><!-- header -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>


            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by <br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>

            </div><!-- footer -->

        </div><!-- page -->

        <img src="/memoPlus/images/black_ribbon_bottom_right.png" class="black-ribbon stick-bottom stick-right">

    </body>
</html>
