<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id' => 'files--gen-form',
        'type' => 'inline',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'Name'); ?>
<?php echo $form->textFieldRow($model, 'Name', array('size' => 60, 'maxlength' => 100, 'style'=>'width:400px')); ?>
<?php echo $form->error($model, 'Name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'FilesName'); ?>
        <?php echo $form->fileField($model, 'FilesName'); ?>
        <?php echo $form->error($model, 'FilesName'); ?>
    </div>

    <div class="row">
<?php echo $form->checkBox($model, 'chkOverwrite', array('checked'=>'checked')); ?>
ใช้งานรูปแบบจดหมายเดิม
    </div>	
	
	
      <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
       <?php 
       
       echo $form->dropDownListRow(
            $model,
            'type',
               
            array('1'=>'จดหมาย','2'=>'บันทึกข้อความ','3'=>'Letter','4'=>'Memo'),
               array('1'=>'จดหมาย')
        );
       ?>
          
         <?php echo $form->error($model,'type'); ?>
         </div>
    <br>
    <div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        
           <div class="row buttons">
                <?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => $model->isNewRecord ? 'Create' : 'Save',
                'type' => 'primary',
                'buttonType' => 'submit',
            ));
            ?>
               

    </div>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->