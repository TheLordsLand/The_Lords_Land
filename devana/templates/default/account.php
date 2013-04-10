<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <?php echo '<link rel="stylesheet" type="text/css" href="templates/'.$_SESSION[$shortTitle.'User']['template'].'/default.css">'; ?>
  <title><?php echo $title.$ui['separator'].$ui['account']; ?></title>
  <?php echo $tracker; ?>
 </head>
 <body class="body">
<?php include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/header.php'; ?>
 <div class="container">
  <div class="content">
<?php echo '
   <div style="display: inline-block;">
    <div class="row">
     <div class="cell">'.$ui['edit'].'</div>
     <div class="cell">
      <select class="dropdown" id="action" onChange="selectAction()">
       <option value="misc">'.$ui['misc'].'</option>
       <option value="password">'.$ui['password'].'</option>
       <option value="remove">'.$ui['remove'].'</option>
      </select>
     </div>
    </div>
   </div>
   <div id="misc">
    <form method="post" action="?action=misc">
     <div class="row"><div class="cell">'.$ui['email'].'</div><div class="cell"><input class="textbox" type="text" name="email" maxlength="32" value="'.$_SESSION[$shortTitle.'User']['email'].'"></div></div>
     <div class="row"><div class="cell">'.$ui['sitter'].'</div><div class="cell"><input class="textbox" type="text" name="sitter" maxlength="32" value="'.$_SESSION[$shortTitle.'User']['sitter'].'"></div></div>
     <div class="row"><div class="cell">'.$ui['locale'].'</div><div class="cell"><select class="dropdown" type="text" name="locale">'.$locales.'</select></div></div>
     <div class="row"><div class="cell">'.$ui['template'].'</div><div class="cell"><select class="dropdown" type="text" name="template">'.$templates.'</select></div></div>
     <div class="row"><div class="cell">'.$ui['password'].'</div><div class="cell"><input class="textbox" type="password" name="password"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['edit'].'"></div></div>
    </form>
   </div>
   <div id="password">
    <form method="post" action="?action=password">
     <div class="row"><div class="cell">'.$ui['oldPassword'].'</div><div class="cell"><input class="textbox" type="password" name="oldPassword"></div></div>
     <div class="row"><div class="cell">'.$ui['newPassword'].'</div><div class="cell"><input class="textbox" type="password" name="newPassword" id="newPassword" onChange=\"check("newPassword")\"></div></div>
     <div class="row"><div class="cell">'.$ui['retypePassword'].'</div><div class="cell"><input class="textbox" type="password" name="rePassword"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['edit'].'"></div></div>
    </form>
   </div>
   <div id="remove">
    <form method="post" action="?action=remove">
     <div class="row"><div class="cell">'.$ui['password'].'</div><div class="cell"><input class="textbox" type="password" name="password"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['edit'].'"></div></div>
    </form>
   </div>';
?>
  </div>
 </div>
<script type="text/javascript">
 var misc=document.getElementById("misc"), password=document.getElementById("password"), remove=document.getElementById("remove");
 function selectAction()
 {
  var action=document.getElementById("action").value;
  switch (action)
  {
   case "misc": misc.style.display="block"; password.style.display="none"; remove.style.display="none"; break;
   case "password": misc.style.display="none"; password.style.display="block"; remove.style.display="none"; break;
   case "remove": misc.style.display="none"; password.style.display="none"; remove.style.display="block"; break;
   default: misc.style.display="none"; password.style.display="none"; remove.style.display="none";
  }
 }
 function check(obj)
 {
  var str=document.getElementById(obj).value, regex=/^[0-9A-Za-z]+$/;
  if (!regex.test(str)) alert("<?php echo $ui['onlyAlphaNum']; ?>");
 }
 selectAction();
</script>
<?php include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/footer.php'; ?>
 </body>
</html>