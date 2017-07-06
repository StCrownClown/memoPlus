<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */

$this->breadcrumbs = array(
    'Manage',
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


<h1>Manage</h1>
<div>

                <?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => 'Create',
                'type' => 'primary',
                'buttonType' => 'link',
                'url' => array("create"),
            ));
            ?>
</div>

<div class="search-form" style="display:none">

</div><!-- search-form -->

<div>
<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'files--gen-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    //'cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css',
    //  'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/gridViewStyle/styles.css'),
    'filter' => $model,
    'columns' => array(
        'Name',
        array(
            'header' => 'FilesName',
            'labelExpression' => '$data->FilesName',
            'urlExpression' => 'array("readWord/readword_index","FilesID"=>$data->FilesID)',
            'class' => 'CLinkColumn',

        ),

        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class' => 'booster.widgets.TbButtonColumn',
        ),



    ),
));
?>
</div>