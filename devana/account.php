<?php
include 'core/config.php';
include 'core/core.php';
if (isset($_SESSION[$shortTitle.'User']['id']))
{
 $locales='<option value="'.$_SESSION[$shortTitle.'User']['locale'].'">'.$_SESSION[$shortTitle.'User']['locale'].'</option>';
 if ($handle=opendir('locales'))
  while (false!=($file=readdir($handle)))
  {
   $fileName=explode('.', $file); $fileName=$fileName[0];
   if (($file!='.')&&($file!='..')&&($_SESSION[$shortTitle.'User']['locale']!=$fileName))
    $locales.='<option value="'.$fileName.'">'.$fileName.'</option>';
  }
 closedir($handle);
 $templates='<option value="'.$_SESSION[$shortTitle.'User']['template'].'">'.$_SESSION[$shortTitle.'User']['template'].'</option>';
 if ($handle=opendir('templates'))
  while (false!=($file=readdir($handle)))
   if ((strpos($file, '.')===false)&&($_SESSION[$shortTitle.'User']['template']!=$file))
    $templates.='<option value="'.$file.'">'.$file.'</option>';
 closedir($handle);
 if (isset($_GET['action']))
 {
  foreach ($_POST as $key=>$value) $_POST[$key]=misc::clean($value);
  $user=new user();
  $user->get('id', $_SESSION[$shortTitle.'User']['id']);
  switch ($_GET['action'])
  {
   case 'misc':
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['password']))
    {
     $user->data['email']=$_SESSION[$shortTitle.'User']['email']=$_POST['email'];
     $user->data['sitter']=$_SESSION[$shortTitle.'User']['sitter']=$_POST['sitter'];
     $user->data['locale']=$_SESSION[$shortTitle.'User']['locale']=$_POST['locale'];
     $user->data['template']=$_SESSION[$shortTitle.'User']['template']=$_POST['template'];
     $message=$ui[$user->set()];
    }
    else $message=$ui['wrongPassword'];
   break;
   case 'password':
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['oldPassword']))
     if ($_POST['newPassword']==$_POST['rePassword'])
     {
      $user->data['password']=$_SESSION[$shortTitle.'User']['password']=md5($_POST['newPassword']);
      $message=$ui[$user->set()];
     }
     else $message=$ui['rePassNotMatch'];
    else $message=$ui['wrongPassword'];
   break;
   case 'remove':
    if ($_SESSION[$shortTitle.'User']['password']==md5($_POST['password']))
    {
     $status=user::remove($user->data['id']);
     if ($status=='done') header('Location: logout.php');
     else $message=$ui[$status];
    }
    else $message=$ui['wrongPassword'];
   break;
  }
 }
}
else header('Location: logout.php');
include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/account.php';
?>