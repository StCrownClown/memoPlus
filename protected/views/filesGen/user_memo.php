<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */

$this->breadcrumbs=array(
	'user_memo',
);


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

<h1>บันทึกข้อความ</h1>




<div class="search-form" style="display:none">

</div>search-form 

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'files--gen-grid',
        'type' => 'striped bordered condensed',
	'dataProvider'=>$model->searchmemo(),
        //'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css',
      //  'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css'),
	'filter'=>$model,
	'columns'=>array(
            array(    
                    'header'=>'Name',
                    'labelExpression'=>'$data->Name',
                    'urlExpression'=>'array("readWord/readword_index","FilesID"=>$data->FilesID)',
                    'class'=>'CLinkColumn'         
                     ),
            //'html',

	),
    
)); ?>
