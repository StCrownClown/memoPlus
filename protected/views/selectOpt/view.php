<?php
/* @var $this SelectOptController */
/* @var $model SelectOpt */

$this->breadcrumbs=array(
	'Test Selects'=>array('Manage'),
	$model->Name,
);


?>

<h1>View SelectOpt #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'Name_select',
	),
)); ?>
