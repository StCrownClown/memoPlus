<?php
/* @var $this TestSelectController */
/* @var $model TestSelect */

$this->breadcrumbs = array(
    'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#test-select-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
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
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('booster.widgets.TbGridView', array(
    'id' => 'test-select-grid',
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        'Name',
        
        'Name_select',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class' => 'booster.widgets.TbButtonColumn',
            
        ),
    ),
));
?>