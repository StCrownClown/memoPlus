<?php $form = $this->beginWidget('CActiveForm',array());?>

<div>
    <?php echo $form->labelEx($files,"Name");?>
    <?php echo $form->textField($files,"Name");?>
</div>


<div>
    <?php echo $form->labelEx($files,"FilesName");?>
    <?php echo $form->fileField($files,"FilesName");?>
</div>


<?php echo $form->hiddenField($files,"FilesID"); ?>


<input type="submit" value="บันทึก"/>
<?php $this->endWidget() ;?>
