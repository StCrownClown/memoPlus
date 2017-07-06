<?php
/* @var $this FilesGenController */
/* @var $model FilesGen */

$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	'Create',
);


?>
<h1>Create Files</h1>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>


<div>
			<?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => 'back to index',
                'type' => 'primary',
                'buttonType' => 'link',
                'url' => array("admin"),
            ));
            ?>
</div>