<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <?php echo '<link rel="stylesheet" type="text/css" href="templates/'.$_SESSION[$shortTitle.'User']['template'].'/default.css">'; ?>
  <title><?php echo $title.$ui['separator'].$ui['adminPanel']; ?></title>
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
       <option value="none">'.$ui['none'].'</option>
       <option value="vars">'.$ui['vars'].'</option>
       <option value="bans">'.$ui['bans'].'</option>
       <option value="inactive">'.$ui['accounts'].'</option>
      </select>
     </div>
    </div>
   </div>
   <div style="display: table-row-group" id="vars">
    <form method="post" action="?action=vars">
     <div class="row"><div class="cell">'.$ui['name'].'</div><div class="cell"><select class="dropdown" name="name" id="varName" onChange="changeFlag()">'.$flagNames.'</select></div></div>
     <div class="row"><div class="cell">'.$ui['value'].'</div><div class="cell"><input class="textbox" type="text" name="value" id="varValue" maxlength="16" value="'.$flags[0]['value'].'"></div></div>
     <div class="row"><div class="cell">'.$ui['password'].'</div><div class="cell"><input class="textbox" type="password" name="password"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['edit'].'"></div></div>
    </form>
   </div>
   <div style="display: table-row-group" id="bans">
    <form method="post" action="?action=bans">
     <div class="row"><div class="cell">'.$ui['name'].'</div><div class="cell"><input type="text" class="textbox" name="name"></div></div>
     <div class="row"><div class="cell">'.$ui['level'].'</div><div class="cell"><input class="textbox numeric" type="text" name="level" maxlength="2" size="1"></div></div>
     <div class="row"><div class="cell">'.$ui['password'].'</div><div class="cell"><input class="textbox" type="password" name="password"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['edit'].'"></div></div>
    </form>
   </div>
   <div style="display: table-row-group" id="inactive">
    <form method="post" action="?action=inactive">
     <div class="row"><div class="cell">'.$ui['maxIdleTime'].'</div><div class="cell"><input class="textbox numeric" type="text" name="maxIdleTime" size="1"></div></div>
     <div class="row"><div class="cell">'.$ui['password'].'</div><div class="cell"><input class="textbox" type="password" name="password"></div></div>
     <div class="row"><div class="cell"><input class="button" type="submit" value="'.$ui['remove'].'"></div></div>
    </form>
   </div>';
?>
  </div>
 </div>
<script type="text/javascript">
 <?php echo 'var flagValues=new Array('.implode(', ', $flagValues).');'; ?>
 var vars=document.getElementById("vars"), bans=document.getElementById("bans"), inactive=document.getElementById("inactive");
 function changeFlag()
 {
  document.getElementById('varValue').value=flagValues[document.getElementById('varName').selectedIndex];
 }
 function selectAction()
 {
  var action=document.getElementById("action").value;
  switch (action)
  {
   case "vars": vars.style.display="block"; bans.style.display="none"; inactive.style.display="none"; break;
   case "bans": vars.style.display="none"; bans.style.display="block"; inactive.style.display="none"; break;
   case "inactive": vars.style.display="none"; bans.style.display="none"; inactive.style.display="block"; break;
   default: vars.style.display="none"; bans.style.display="none"; inactive.style.display="none";
  }
 }
 selectAction();
</script>
<?php include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/footer.php'; ?>
 </body>
</html>