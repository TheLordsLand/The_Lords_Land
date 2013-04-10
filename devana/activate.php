<?php
include 'core/config.php';
include 'core/core.php';
if (isset($_GET['user'], $_GET['code']))
{
 foreach ($_GET as $key=>$value) $_GET[$key]=misc::clean($value);
 if ((($_GET['user']!=''))&&($_GET['code']!=''))
 {
  $user=new user();
  $status=$user->get('name', $_GET['user']);
  if ($status=='done')
  {
   $activation=new activation();
   $status=$activation->get($user->data['id']);
   if ($status=='done') $status=$activation->activate($_GET['code']);
   $message=$ui[$status];
  }
  else $message=$ui[$status];
 }
 else $message=$ui['insufficientData'];
}
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/activate.php'; ?>