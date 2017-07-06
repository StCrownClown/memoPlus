<?php
/* @var $this TblUserController */
/* @var $model TblUser */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'users-register-form',
        'type' => 'inline',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'fullname'); ?>
        <?php echo $form->textFieldGroup($model, 'fullname'); ?>
<?php echo $form->error($model, 'fullname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textFieldGroup($model, 'username'); ?>
<?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordFieldGroup($model, 'password'); ?>
<?php echo $form->error($model, 'password'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'repassword'); ?>
        <?php echo $form->passwordFieldGroup($model, 'repassword'); ?>
        <?php echo $form->error($model, 'repassword'); ?>
        
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'group'); ?>
        <?php //echo $form->dropDownList($model, 'user_type', array('1' => 'Admin', '2' => 'User'), array('empty' => 'เลือกประเภทสมาชิก')); 
        echo $form->dropDownListGroup(
			$model,
			'group',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
				'widgetOptions' => array(
					'data' => array('เลือกประเภทสมาชิก','3' => 'Admin', '2' => 'User'),
					'htmlOptions' => array(),
				)
			)
		);
        
        
        ?>
<?php echo $form->error($model, 'group'); ?>
    </div>




    <div class="row buttons">
                <?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => 'Submit',
                'context' => 'primary',
                'buttonType' => 'submit',
            ));
            ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->