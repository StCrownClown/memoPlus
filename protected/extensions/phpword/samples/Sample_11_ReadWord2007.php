<?php
session_start();
include_once 'Sample_Header.php';
// Read contents
$objConnect = mysqli_connect("localhost","root","","test") or die("Error Connect to Database");
$strSQL = "SELECT * FROM files ";
$strSQL .="WHERE FilesID = '".$_GET["FilesID"]."' ";
$objQuery = mysqli_query($objConnect,$strSQL) ;

$photoID = mysqli_fetch_assoc ($objQuery) ;



$_SESSION["FilesID"] = $_GET["FilesID"];

echo "test234".$photoID["FilesName"];

$name = basename(__FILE__, '.php');
$source = __DIR__ . "/resources/{$name}.docx";

echo date('H:i:s'), " Reading contents from `{$source}`", EOL;
//echo "testttttttt\n".__DIR__;
$phpWord = \PhpOffice\PhpWord\IOFactory::load('../../Work_Selection/myfiles/'.$photoID["FilesName"]);


//$phpWord = \PhpOffice\PhpWord\IOFactory::load('C:/xampp/htdocs/myphp/PHPWord-master/samples/testkub.docx');





// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);


//$result = mysqli_query($objConnect,"SELECT html FROM files WHERE FilesID = ".$_SESSION["FilesID"]);


if (empty($photoID["html"])) {
	    		echo "สามารถอัพโหลดได้";
			if(!@copy('results/Sample_11_ReadWord2007.html','../../Work_Selection/myfiles/'.$photoID["Name"].'.html'))
						{
   								 $errors= error_get_last();
   								 echo "COPY ERROR: ".$errors['type'];
   								 echo "<br />\n".$errors['message'];
						} 

			else 	
			{
    							 echo "File copied from remote!";
    							 $strSQL = "UPDATE files SET ";
								$strSQL .="html = '".$photoID["Name"].'.html'."' ";
								$strSQL .="WHERE FilesID = '".$_SESSION["FilesID"]."' ";
								$objQuery = mysqli_query($objConnect,$strSQL);

				?>
				<meta http-equiv="refresh" content="0; url=../../Work_Selection/ShowWord.php?FilesID=<?php echo $_SESSION["FilesID"];?>" />
				<?php
			} 
} else {
	echo "Have Value";
		echo "เคยอัพโหลดไฟล์ Html นี้แล้วไม่สามารถ อัพโหลดได้อีก";
	print_r($result);
	?>
   <meta http-equiv="refresh" content="0; url=../../Work_Selection/ShowWord.php?FilesID=<?php echo $_SESSION["FilesID"];?>" />
				
   <?php

}











if (!CLI) {
    include_once 'Sample_Footer.php';
}
?>



<!--<a href="../../Work_Selection/index.php">Return to Select</a> 
<a href="../../Work_Selection/index.php">Return to Select</a> -->



<!--<meta http-equiv="refresh" content="0; url=results/Sample_11_ReadWord2007.html" /> -->