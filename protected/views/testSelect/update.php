<?php
/* @var $this TestSelectController */
/* @var $model TestSelect */

$this->breadcrumbs=array(
	'Test Selects'=>array('Manage'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);


?>

<h1>Update TestSelect <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>