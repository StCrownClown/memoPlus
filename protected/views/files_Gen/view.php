<?php
/* @var $this Files_GenController */
/* @var $model Files_Gen */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	$model->Name,
);


?>

<h1>View Files#<?php echo $model->Name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'FilesID',
		'Name',
		'FilesName',
		'html',
	),
)); ?>
