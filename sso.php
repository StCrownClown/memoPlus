<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"].'/saml/lib/_autoload.php');
$sso = new SimpleSAML_Auth_Simple('idm');  
$sso->requireAuth(); 
$attributes = $sso->getAttributes();

$_SESSION['EMPLOYEEID'] = trim($attributes['EMPLOYEEID'][0]);
$_SESSION['GIVENNAMEENGLISH'] = trim($attributes['GIVENNAMEENGLISH'][0]);
$_SESSION['FAMILYNAMEENGLISH'] = trim($attributes['FAMILYNAMEENGLISH'][0]);
$_SESSION['CENTERSHORTNAMETHAI'] = trim($attributes['CENTERSHORTNAMETHAI'][0]);
$_SESSION['DIVISIONNAMETHAI'] = trim($attributes['DIVISIONNAMETHAI'][0]);
$_SESSION['DEPARTMENTNAMETHAI'] = trim($attributes['DEPARTMENTNAMETHAI'][0]);

header('Location: https://app.biotec.or.th:444/memoplus/index.php/Site/login');

?>
