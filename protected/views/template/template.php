<?php
/* @var $this ReadWordController */
    $this->breadcrumbs=array(
        'Files Gens'=>array('FilesGen/let'),
		'Template',
	);

?>


<?php
echo "Save Complate";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script type="text/javascript">
        
$(document).ready(function() {
 //   myFunction();
});

var a =0;
                    

function myFunction() {
                    
                    if(a==0)
                    {
                        

                            a++;
                            var input = $(":input");
                            //openModal("#myModal");
                            // var input2 = $("#name_txt").val()
                            //alert($(":input")[0].name);
                            var i;
                            var obj_input = [];
                            //alert(input.length);
                            for (i = 0; i < input.length; i++)
                            {
               
                                            obj_input.push(input[i].value);

                                
                            }
                            <?php
                            $js_array = json_encode($save_last_select);
                           // echo "var javascript_array = ". $js_array . ";\n";
                            ?>
                            //var FilesID = $("‪#‎Emp_ID‬").val();
                            console.log(JSON.stringify(<?php echo $js_array ?>));

                            $.ajax({
                                type: "POST",
                                url: '<?php echo Yii::app()->createUrl('Template/save_html'); ?>',
                                dataType: "json",
                                // contentType: "application/json; charset=utf-8",
                                data: {textJson: JSON.stringify(<?php echo $js_array ?>)
                                    , FileID:<?php echo $model->FilesID; ?>,
                                     
                                //,savename: $('#loginForm')[0][0].value },
                                success: function () {
                                   // alert("Success");
                                    //location.reload();
                                },
                                error: function () {
                                  //  alert("เซฟเสร็จแล้วจ้า");
                                    //location.reload();
                                }
                            }});
                        
                        }


                    }

</script>
