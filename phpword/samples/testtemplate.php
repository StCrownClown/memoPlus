<?php
session_start();
include_once 'Sample_Header.php';

// Template processor instance creation
echo date('H:i:s') , ' Creating new TemplateProcessor instance...' , EOL;





$objConnect = mysqli_connect("localhost","root","","test") or die("Error Connect to Database");
$strSQL = "SELECT * FROM files ";
$strSQL .="WHERE FilesID = '".$_SESSION["FilesID"]."' ";
$objQuery = mysqli_query($objConnect,$strSQL) ;

$photoID = mysqli_fetch_assoc ($objQuery) ;

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../../Work_Selection/myfiles/'.$photoID["FilesName"]);


//$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/Sample_23_TemplateBlock.docx');

// Will clone everything between ${tag} and ${/tag}, the number of times. By default, 1.
$templateProcessor->cloneBlock('CLONEME', 3);

// Everything between ${tag} and ${/tag}, will be deleted/erased.
//$templateProcessor->deleteBlock('DELETEME');

$memberNames=$_POST['name_txt']; 
$rest=$_POST['rest']; 
//$restvalue = $_POST['rest'];

$request = file_get_contents('php://input');

$input = json_decode($request);

echo "testJSON".$input;


for($i=0;$i<sizeof($memberNames);$i++)
{
	$j=$i+1;
	$templateProcessor->setValue('Value'.$j,$memberNames[$i]);
	$j=$i;
}




echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('C:/Users/chawan.aph/Desktop/'.$photoID["Name"].".docx");

// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writerss);

?>
<a href="../../Work_Selection/index.php">Return to Select</a>

<?php
if (!CLI) {
    include_once 'Sample_Footer.php';
}
?>