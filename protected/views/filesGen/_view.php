<?php
/* @var $this FilesGenController */
/* @var $data FilesGen */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FilesID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FilesID), array('view', 'id'=>$data->FilesID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FilesName')); ?>:</b>
	<?php echo CHtml::encode($data->FilesName); ?>
	<br />



</div>