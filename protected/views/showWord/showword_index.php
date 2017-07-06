<?php
$models = SelectOpt::model()->findAll();
$data = CJSON::encode($models);
$data = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}, $data);

echo '<textarea name="hidden_json" id="select_json" style="display:none;">' . $data . '</textarea>';

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/bootstrap-timepicker/js/bootstrap-timepicker.min.js');
$cs->registerCssFile($baseUrl . '/bootstrap-timepicker/css/bootstrap-timepicker.min.css');


echo '<h4>' . $model->Name . '</h2><br/><br/>';

echo CHtml::beginForm(array("template/template", "FilesID" => $model->FilesID, "IDSave" => $IDSave), 'post', array('style' => 'padding:0 2%;', 'id' => 'form_id'));

echo file_get_contents("myfile/" . $model->FilesID . '_edit.html');
?>
<input type="hidden" name="User_id" value="<?php echo Yii::app()->user->id; ?>" >
<table>
    <tr>
        <td class="bt_send"  width="1%">
            <?php
            $this->widget('booster.widgets.TbButton', array(
                'label' => 'สร้างไฟล์',
                'buttonType' => 'submit',
                'type' => 'primary',
                'htmlOptions' => array('id' => 'send'),
            ));
            ?>
        </td>

        <?php
        if (Yii::app()->user->role == 'admin') {
            ?>
            <td class="bt_edit" width="98">
                <?php
                $this->widget('booster.widgets.TbButton', array(
                    'label' => 'Edit',
                    'type' => 'primary',
                    'buttonType' => 'link',
                    'url' => array("edit_html", "FilesID" => $model->FilesID),
                ));
                ?>
            <?php } ?>
        </td>
    </tr>
</table>

<?php // echo CHtml::submitButton("สร้างไฟล์");     ?>
<?php echo CHtml::endForm(); ?>

<?php //echo CHtml::beginForm(array("edit_html", "FilesID" => $model->FilesID, 'visible' => !Yii::app()->user->isGuest), 'post', array('style' => 'padding:0 2%;'));  ?>
<?php //echo CHtml::submitButton("แก้ไข");  ?>
<?php //echo CHtml::endForm();    ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Save Template</h4>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="post" class="form-horizontal" onsubmit="myFunction()">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Savename</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary">Send message</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bootstrap-timepicker-widget table td input{width: 35px;}
</style>

<script>

    $(document).ready(function () {
        $("[id^=Time]").timepicker({maxHours: 24, showMeridian: false});

        $(".datepicker").datepicker({
            dateFormat: 'd MM yy',
            // showOn: 'button', 
            //showOn: 'button',
            isBE: true,
            autoConversionField: false,
            //buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif',  
            //buttonImageOnly: false,  
            changeMonth: true,
            changeYear: false,
            yearRange: '-10:+10',
            dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
            dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
            monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
            monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
            constrainInput: true,
        });
// -----------------------------
<?php
foreach ($savepost as $key => $value) {

    $value = htmlentities($value, ENT_QUOTES, "UTF-8");
    echo "$('#" . $key . "').val($('<div/>').html('" . $value . "').text());\n";
}
?>
//   
    })

    $(document).ready(function () {
        $("[id^=Time]").timepicker({maxHours: 24, showMeridian: false});

        $(".datepicker_en").datepicker({
            dateFormat: 'd MM yy',
            // showOn: 'button', 
            //showOn: 'button',
            isCE: true,
            autoConversionField: true,
            //buttonImage: 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif',  
            //buttonImageOnly: false,  
            changeMonth: true,
            changeYear: true,
            yearRange: '-10:+10',
            dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            constrainInput: true,
        });
// -----------------------------
<?php
// foreach($savepost as $key_en => $value_en) {
// 	if($value_en!=""){
// 		if (substr($key_en,0,6) == 'DateEN') {            
//             $date_year = substr($value_en, -4);
//             $value_en = substr($value_en, 0, -4).$date_year;
// 		$value_en = htmlentities($value_en, ENT_QUOTES, "UTF-8");
// 		}
// 		echo "$('#".$key_en."').val($('<div/>').html('".$value_en."').text());\n";
// 	}
// }
?>
//   
    })

</script>
<script src="/memoPlus/js/NumtoText.js"></script>
<script src="/memoPlus/js/OptionSelect.js"></script>

<textarea id='en_US' class='hidden'>
__numbertext__
^0 zero
1 one
2 two
3 three
4 four
5 five
6 six
7 seven
8 eight
9 nine
10 ten
11 eleven
12 twelve
13 thirteen
15 fifteen
18 eighteen
1(\d) $1teen
20 twenty
2(\d) twenty-$1
30 thirty
3(\d) thirty-$1
40 forty
4(\d) forty-$1
50 fifty
5(\d) fifty-$1
80 eighty
8(\d) eighty-$1
(\d)0 $1ty
(\d)(\d) $1ty-$2

:0+
:0*\d?\d " and"
:\d+ ,

(\d)(\d\d) $1 hundred$(:\2) $2
(\d{1,2})([1-9]\d\d) $1 thousand $2
(\d{1,3})(\d{3}) $1 thousand$(:\2) $2
(\d{1,3})(\d{6}) $1 million$(:\2) $2
(\d{1,3})(\d{9}) $1 billion$(:\2) $2

[-−](\d+) negative |$1

0[.,] point
([-−]?\d+)[.,] $1| point
([-−]?\d+[.,]\d*)(\d) $1| |$2

us:([^,]*),([^,]*),([^,]*),([^,]*) \1
up:([^,]*),([^,]*),([^,]*),([^,]*) \2
ss:([^,]*),([^,]*),([^,]*),([^,]*) \3
sp:([^,]*),([^,]*),([^,]*),([^,]*) \4

EUR:(\D+) $(\1: euro, euro, cent, cents)
GBP:(\D+) $(\1: pound sterling, pounds sterling, penny, pence)
THB:(\D+) $(\1: baht, baht, satang, satang)
USD:(\D+) $(\1: U.S. dollar, U.S. dollars, cent, cents)

"([A-Z]{3}) ([-−]?1)([.,]00?)?" $2 $(\1:us)
"([A-Z]{3}) ([-−]?\d+)([.,]00?)?" $2 $(\1:up)

"(([A-Z]{3}) [-−]?\d+)[.,](01)" $1 and |$(1) $(\2:ss)
"(([A-Z]{3}) [-−]?\d+)[.,](\d)" $1 and |$(\30) $(\2:sp)
"(([A-Z]{3}) [-−]?\d+)[.,](\d\d)" $1 and |$3 $(\2:sp)
</textarea>