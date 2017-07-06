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
<?php $form=$this->beginWidget( 'booster.widgets.TbActiveForm', array(
	'id'=>'login-form',
    
        'type' => 'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

<!--	<div class="row">-->
		
		<?php echo $form->textFieldRow($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	<!--</div>-->

	<!--<div class="row">-->
		
		<?php echo $form->passwordFieldRow($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>

	<!--</div>-->

	<!--<div class="row rememberMe">-->
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
		
		<?php echo $form->error($model,'rememberMe'); ?>
	<!--</div>-->

        
 <div class="row buttons">

                <?php
            $form->widget('booster.widgets.TbButton', array(
                'label' => 'Login',
                'type' => 'primary',
                'buttonType' => 'submit',
            ));
            ?>
                     <?php
            /*$form->widget('booster.widgets.TbButton', array(
                'label' => 'Register',
                'type' => 'primary',
                'buttonType' => 'link',
                'url' => array("users/register"),
            ));*/
            ?>
</div>
        

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>