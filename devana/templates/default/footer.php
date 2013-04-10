</div>
<?php
if ((isset($_SESSION[$shortTitle.'User']['level']))&&($_SESSION[$shortTitle.'User']['level']>=3)) $adminPanel=' | <a class="small" href="'.$location.'admin.php">'.$ui['adminPanel'].'</a>';
else $adminPanel='';
echo '<div class="container"><div style="text-align: center; font-size: x-small; color: #000; margin-top: 15px;">devana created by Andrei Busuioc<br /><a class="small" href="devanapedia.php?action=list&view=modules&faction=0">'.$ui['devanapedia'].'</a> | <a class="small" href="simulator.php">'.$ui['combatSimulator'].'</a> | <a class="small" href="'.$location.'terms.php">'.$ui['terms'].'</a> | <a class="small" href="'.$location.'credits.php">'.$ui['credits'].'</a> | <a class="small" href="'.$location.'contact.php">'.$ui['contact'].'</a>'.$adminPanel.'</div></div>';
?>
</div></div>