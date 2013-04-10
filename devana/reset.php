<?php
include 'core/config.php';
include 'core/core.php';
include 'core/game.php';
if (isset($_POST['name'], $_POST['email']))
{
 foreach ($_POST as $key=>$value) $_POST[$key]=misc::clean($value);
 if ((($_POST['name']!=''))&&($_POST['email']!=''))
 {
  $user=new user();
  $status=$user->get('name', $_POST['name']);
  if ($status=='done')
  {
   $newPass=rand(1000000000, 9999999999);
   $status=$user->resetPassword($_POST['email'], $newPass);
   include 'core/email/email.php';
   $body=$title.' '.$ui['newPassword'].': '.$newPass;
   if ($status=='done')
    $status=email($title, $user->data['email'], $title.' '.$ui['resetPassword'], $body);
   $message=$ui[$status];
  }
  else $message=$ui[$status];
 }
 else $message=$ui['insufficientData'];
}
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/reset.php'; ?>