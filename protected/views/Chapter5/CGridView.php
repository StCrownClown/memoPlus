<?php
    $this->widget('zii.widgets.grid.CGridView',array(
        'dataProvider' => $files,
        'columns' => array(
            'FilesID',
            'Name',
            'FilesName',
        
        array(
            'type' => 'html',
            'value' => 'CHtml::link("edit",array("Chapter5/Form","FilesID"=>$data->FilesID))'
        )
       )
            
    ));
?>    
  