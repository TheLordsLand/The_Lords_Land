<?php
include 'core/config.php';
include 'core/core.php';
if ((isset($_SESSION[$shortTitle.'User']['level']))&&($_SESSION[$shortTitle.'User']['level']>=3))
{
 if (isset($_GET['action']))
 {
  foreach ($_POST as $key=>$value)
   if ($key=='maxIdleTime') $_POST[$key]=misc::clean($value, 'numeric');
   else $_POST[$key]=misc::clean($value);
  switch ($_GET['action'])
  {
   case 'vars':
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['password'])) $message=$ui[flags::set($_POST['name'], $_POST['value'])];
    else $message=$ui['wrongPassword'];
   break;
   case 'bans':
    $user=new user();
    $status=$user->get('name', $_POST['name']);
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['password']))
     if ($status=='done')
     {
      if ($_POST['level']>-1)
      {
       $user->data['level']=$_POST['level'];
       $message=$ui[$user->set()];
      }
      else $message=$ui[user::remove($user->data['id'])];
     }
     else $message=$ui[$status];
    else $message=$ui['wrongPassword'];
   break;
   case 'inactive':
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['password']))
     if ($_POST['maxIdleTime']>0)
     {
      $output=user::removeInactive($_POST['maxIdleTime']);
      $message=$output['found'].' '.$ui['accountsFound'].', '.$output['removed'].' '.$ui['removed'];
     }
     else $message=$ui['insufficientData'];
    else $message=$ui['wrongPassword'];
   break;
  }
 }
 $flags=flags::get('id'); $flagNames=''; $flagValues=array();
 foreach ($flags as $key=>$flag)
 {
  $flagNames.='<option value="'.$flag['name'].'">'.$ui[$flag['name']].'</option>';
  $flagValues[$key]='"'.$flag['value'].'"';
 }
}
else header('Location: logout.php');
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/admin.php';
?>