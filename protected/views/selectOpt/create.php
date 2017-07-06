<?php
/* @var $this SelectOptController */
/* @var $model SelectOpt */

$this->breadcrumbs=array(
	'Test Selects'=>array('Manage'),
	'Create',
);


?>

<h1>Create SelectOpt</h1>

<div>

             
</div>
<br>
<?php $this->renderPartial('_form', array('model'=>$model)); 
  
            $this->widget('booster.widgets.TbButton', array(
                'label' => 'Back To Manage',
                'type' => 'primary',
                'buttonType' => 'link',
                'url' => array("admin"),
            ));
            ?>