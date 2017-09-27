<?php
/* @var $this TestSelectController */
/* @var $model TestSelect */

$this->breadcrumbs=array(
	'Test Selects'=>array('Manage'),
	$model->Name,
);


?>

<h1>View TestSelect #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'Name_select',
	),
)); ?>
