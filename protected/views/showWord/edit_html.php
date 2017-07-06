

<?php
Yii::import('ext.ckeditor.ckeditor');

$this->breadcrumbs = array(
    'Manage' => array('FilesGen/admin'),
    'Edit HTML',
);
?>




    <div class="form">

    <?php echo CHtml::beginForm('', 'post', array('style' => 'padding:0 2%;')); ?>
    <?php


$this->widget(
	'booster.widgets.TbCKEditor',
	array(
		'name' => 'name',
		'id'=> 'name',
		'value' => $html,
		'editorOptions' => array(
			'height' => '400',
		),
	)
); 
    ?>
    <div class="row buttons">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'label' => 'Save',
        'type' => 'primary',
        'buttonType' => 'submit',
    ));
    ?>
        <?php echo CHtml::endForm(); ?>