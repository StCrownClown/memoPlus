<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>



<div align = "left">
<div class="form">
<?php 

//echo($_SERVER["DOCUMENT_ROOT"].'/saml/lib/_autoload.php');
//die();

//require_once($_SERVER["DOCUMENT_ROOT"].'/saml/lib/_autoload.php');
//$sso = new SimpleSAML_Auth_Simple('indm');  
//$sso->requireAuth(); 

Yii::app()->setComponent("simplesamlphp", null);
//Yii::app()->simplesamlphp->requireAuth();
//$attributes = $sso->getAttributes();




$form=$this->beginWidget( 'booster.widgets.TbActiveForm', array(
	'id'=>'login-form',
    
        'type' => 'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>