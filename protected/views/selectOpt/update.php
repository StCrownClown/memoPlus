<?php
/* @var $this SelectOptController */
/* @var $model SelectOpt */

$this->breadcrumbs=array(
	'Test Selects'=>array('Manage'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);


?>

<h1>Update SelectOpt <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>