<?php
echo CHtml::form();

echo CHtml::label("ชื่อ","fname");
echo CHtml::textField("fname",null,array("size"=>100));

echo CHtml::label("นามสกุล","lname");
echo CHtml::textField("lname",null,array("size"=>100));

echo CHtml::endform();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

