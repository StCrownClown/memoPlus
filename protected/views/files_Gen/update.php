<?php
/* @var $this Files_GenController */
/* @var $model Files_Gen */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	$model->Name=>array('view','id'=>$model->FilesID),
	'Update '.$model->Name,
);

?>

<h1>Update <?php echo $model->Name; ?></h1>

<?php 

$this->renderPartial('_form', array('model'=>$model));
 
?>

