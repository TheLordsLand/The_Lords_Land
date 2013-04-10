<?php session_start();
//config
$dbHost='localhost';
$dbUser='root';
$dbPass='admin';
$dbName='devana';
$title='devana';
$shortTitle='devana';
$location='http://localhost/devana/';
//misc vars
$tracker='';
$ads='<div class="ad">ads</div>';
if (!isset($_SESSION[$shortTitle.'User']['id']))
{
 $_SESSION[$shortTitle.'User']['template']='default';
 $_SESSION[$shortTitle.'User']['locale']='en';
}
else if ($_SESSION[$shortTitle.'User']['level']>2) $tracker=$ads='';
include 'locales/'.$_SESSION[$shortTitle.'User']['locale'].'/ui.php';
?>
