<?php
/* @var $this Files_GenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'List File',
);

//
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#files--gen-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>List</h1>

<?php $this->widget('booster.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
        'type' => 'striped bordered condensed',
        //'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css',
        //'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css'),
        'filter'=>$model,
        'columns' => array(
            'Name',
                array(   
                    
                    'header'=>'FilesName',
                    'labelExpression'=>'$data->FilesName',
                    'urlExpression'=>'array("readWord/readword_index","FilesID"=>$data->FilesID)',
                    'class'=>'CLinkColumn'         
                     ),
                    
            )
)); ?>
