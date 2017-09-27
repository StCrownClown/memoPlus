<?php
/* @var $this Files_GenController */
/* @var $model Files_Gen */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'FilesID'); ?>
		<?php echo $form->textField($model,'FilesID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FilesName'); ?>
		<?php echo $form->textField($model,'FilesName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'html'); ?>
		<?php echo $form->textField($model,'html',array('size'=>60,'maxlength'=>100)); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->