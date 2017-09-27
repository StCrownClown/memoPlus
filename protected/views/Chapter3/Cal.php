<?php

echo CHtml::form(); ?>
x = <?php echo CHtml::textField("x",$x);?><br/>
y = <?php echo CHtml::textField("y",$y);?><br/>
y = <?php echo CHtml::textField("y",$y);?><br/>
<?php echo CHtml::submitButton("คำนวน");?><br/>


x+y = <?php echo CHtml::textField("result",$result); ?>
<?php echo CHtml::endForm(); ?>