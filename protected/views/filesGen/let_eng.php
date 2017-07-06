<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */

$this->breadcrumbs=array(
	'Letter',
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
<h3>Letter</h3>
<div>
<?php
if (Yii::app()->user->role != 'user') {
			
			$this->widget('booster.widgets.TbButton', array(
				'label' => 'Create',
				'type' => 'primary',
				'buttonType' => 'link',
				'url' => array("create"),
            ));
}
            ?>
</div>


<div class="search-form" style="display:none">

</div><!-- search-form -->

<?php 
$tshow = '{view}{update}{delete}';
if (Yii::app()->user->role == 'user') {
	$tshow = '';
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'files--gen-grid',
//     'type' => 'striped bordered condensed',
	'htmlOptions'=>array('style'=>'font-size: 15px'),
	'dataProvider'=>$model->searchlet_eng(),
        //'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css',
      //  'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css'),
 	'filter'=>$model,
	'columns'=>array(
		array(    
// 			'header'=>'Name',
// 			'labelExpression'=>'$data->Name',
// 			'urlExpression'=>'array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>0)',
// 			'class'=>'CLinkColumn',
			'name'=>'Name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->Name,array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>0))',
			'filter'=>CHtml::activeTextField($model,'Name',array("placeholder"=>"Search...")),
		),
		array(
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
// 			'class'=>'CButtonColumn',
			'template'=>$tshow,
		),
	),

)); ?>