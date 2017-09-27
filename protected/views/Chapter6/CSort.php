<?php
    $this->widget('zii.widgets.grid.CGridView',array(
        'dataProvider' => $files,
        'columns' => array(
            'FilesID',
            'Name',
            'FilesName',
        
        array(
            'header' => 'edit',
            'class' => 'CLinkColumn',
            'imageUrl' => 'images/edit.png',
       
            'htmlOptions' => array(
                'width' => '35px',
                'align' => 'center'
            )
        ),
        array(
            'header' => 'delete',
            'class' => 'CLinkColumn',
            'imageUrl'=> 'images/delete.jpg',
          
            'htmlOptions' => array(
                'width' => '35px',
                'align' => 'center',
                'onclick' => 'return confirm("ยืนยันการลบ")'
                )
        )
      )
    ));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

