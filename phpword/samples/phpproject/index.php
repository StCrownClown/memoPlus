<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here<?php
include_once 'Sample_Header.php';
// Read contents
$name = basename(__FILE__, '.php');
$source = __DIR__ . "/resources/{$name}.docx";

echo date('H:i:s'), " Reading contents from `{$source}`", EOL;
echo "testttttttt\n".__DIR__;
$phpWord = \PhpOffice\PhpWord\IOFactory::load('C:/xampp/htdocs/myphp/testkub.docx');




// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
        ?>
    </body>
</html>
