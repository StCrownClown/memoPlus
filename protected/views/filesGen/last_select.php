<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */

$this->breadcrumbs=array(
	'รายการล่าสุด',
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

<h3>รายการล่าสุด</h3>

<div class="search-form" style="display:none">
</div>

<?php

$trashshow = '';
if (Yii::app()->user->role == 'admin') {
	$trashshow = '{delete}';
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'files--gen-grid',
//     'type' => 'striped bordered condensed',
	'htmlOptions'=>array('style'=>'font-size: 15px'),
	'dataProvider'=>$model->search(),
	//'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css',
	//  'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css'),
//   	'filter'=>$model,
	'columns'=>array(
		array(
// 			'header'=>'savedate',
// 			'labelExpression'=>'$data->savedate',
// 			'urlExpression'=>'array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>$data->ID)',
// 			'class'=>'CLinkColumn'
			'name'=>'savedate',
			'type'=>'raw',
			'value'=>'CHtml::link($data->savedate,array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>$data->ID))',
		),
		array(
// 			'header'=>'FilesID',
// 			'labelExpression'=>'FilesDetail::Model()->findByPk($data->FilesID)->Name',
// 			'urlExpression'=>'array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>$data->ID)',
// 			'class'=>'CLinkColumn'
			'name'=>'FilesID',
			'type'=>'raw',
			'value'=>'CHtml::link($data->GetFilesName(),array("showWord/showword_index","FilesID"=>$data->FilesID,"IDSave"=>$data->ID))',
		),
		array(
//  			'header'=>'UserID',
// 			'labelExpression'=>'$data->UserID',
// 			'urlExpression'=>'"https://i.nstda.or.th/search/ehr/browse/?q=".$data->UserID',
// 			'linkHtmlOptions'=>array('target'=>'"_blank"'),
// 			'class'=>'CLinkColumn',
			'name'=>'UserID',
			'type'=>'raw',
  			'value'=>'CHtml::link($data->GetFullName(),"https://i.nstda.or.th/search/ehr/browse/?q=".$data->UserID,array("target"=>"_blank"))',
		),
		array(
			'name'=>'user_ids.Center',
		),
		array(
			'name'=>'user_ids.Division',
		),
		array(
			'name'=>'user_ids.Department',
		),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
 			'template'=>$trashshow,
			'buttons' => array(
			'delete' => array(
 			'url' => 'Yii::app()->controller->createUrl("template/DeleteLastSelect", array("IDsave"=>$data["ID"]))'
				),
			)
		),
	),
));

?>

<?php
	// Code for Export GridView to Excel
	if (Yii::app()->user->role != 'user') {		
		$ExportExcel = new CWidgetFactory();
		$widget = $ExportExcel->createWidget($this, 'ext.phpexcel.Classes.EExcelView', array(
			'dataProvider' => $model->search(),
			'title'=>'รายการล่าสุด',
			'filename'=>'last_select',
			'exportType'=>'Excel2007',
			'autoWidth'=>true,
	     	'template'=>"{exportbuttons}",
			'columns'=> array(
			array(
				'name'=>'savedate',
				'value'=>'$data->savedate',
			),
			array(
				'header'=>'ชื่อไฟล์',
				'name'=>'FilesID',
				'value'=>'$data->GetFilesName()',
			),
			array(
				'header'=>'ผู้ใช้',
				'name'=>'user_ids.fullname',
			),
			array(
				'header'=>'ศูนย์',
				'name'=>'user_ids.Center',
			),
			array(
				'header'=>'ฝ่าย',
				'name'=>'user_ids.Division',
			),
			array(
				'header'=>'งาน',
				'name'=>'user_ids.Department',
			),
		),
		));
	$widget->Init();
	$widget->run();
	}
?>
		
<script type="text/javascript">


</script>