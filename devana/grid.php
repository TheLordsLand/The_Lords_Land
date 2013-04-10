<?php
include 'core/config.php';
include 'core/core.php';
if (isset($_GET['x'], $_GET['y']))
{
 $x=misc::clean($_GET['x'], 'numeric');
 $y=misc::clean($_GET['y'], 'numeric');
 $vars='x='.$x.'&y='.$y;
}
$grid=new grid();
$grid->getAll();
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/grid.php';
?>