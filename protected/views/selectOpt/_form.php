<?php
/* @var $this SelectOptController */
/* @var $model SelectOpt */
/* @var $form CActiveForm */
// echo $form->textArea($model,'Name',array('rows'=>6, 'cols'=>50)); 
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'test-select-form',
    'type' => 'horizontal',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'Name'); ?>
		<?php
                echo $form->textAreaRow(
			$model,
			'Name',
                        
                        array('class' => 'span4', 'rows' => 10)
		); 
                ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'Name_select'); ?>
		<?php echo $form->textFieldRow($model,'Name_select',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Name_select'); ?>
	</div>

	<div class="row buttons">
                <?php
            $form->widget('booster.widgets.TbButton', array(
                'label' => $model->isNewRecord ? 'Create' : 'Save',
                'type' => 'primary',
                'buttonType' => 'submit',
               
            ));
            ?>
		
	</div>

<?php
$this->endWidget();
unset($form);
?>

</div><!-- form -->