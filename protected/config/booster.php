<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'preload' => array('booster'),
        'aliases' => array(
            'booster' => 'application.extensions.yiibooster',
        ),
        'components' => array(
            'booster' => array(
                'class' => 'booster.components.Booster',
            ),
        ),
    )
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

