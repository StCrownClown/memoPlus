<?php
    $this->widget('zii.widgets.grid.CGridView',array(
        'dataProvider' => $files,
        'columns' => array(
            'FilesID',
            'Name',
            'FilesName'
        )
    ));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

