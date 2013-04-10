<?php
include 'core/config.php';
include 'core/core.php';
if (isset($_POST['x'], $_POST['y']))
{
 $x=misc::clean($_POST['x']);
 $y=misc::clean($_POST['y']);
}
else
{
 $x=rand(0, 49);
 $y=rand(0, 49);
}
$grid=new grid();
$grid->get($x, $y);
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/getGrid.php';
?>
