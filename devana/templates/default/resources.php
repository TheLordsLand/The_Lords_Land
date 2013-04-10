<?php
$thisPage=explode('/', $_SERVER["PHP_SELF"]);
$thisPage=$thisPage[count($thisPage)-1];
if ($game['factions'][$node->data['faction']]['node']['warpResource']>-1)
 $move='<a class="link" href="node.php?action=move&nodeId='.$node->data['id'].'">'.$ui['move'].'</a> |';
else $move='';
echo '<div style="padding: 5px; border-bottom: 1px solid black; text-align: right;"><span id="label" style="color: white;"></span> | <a class="link" href="node.php?action=get&nodeId='.$node->data['id'].'">'.$node->data['name'].'</a> | <a class="link" href="grid.php?x='.$node->location['x'].'&y='.$node->location['y'].'">'.$ui['grid'].'</a> | <a class="link" href="node.php?action=set&nodeId='.$node->data['id'].'">'.$ui['edit'].'</a> | '.$move.' <a class="link" href="node.php?action=remove&nodeId='.$node->data['id'].'">'.$ui['remove'].'</a></div>';
echo '<div>';
foreach ($node->resources as $key=>$resource)
{
 $production=0;
 if ($game['resources'][$key]['type']=='dynamic')
 {
  foreach ($node->modules as $resourceModule)
   if ($resourceModule['module']==$game['resources'][$key]['module'])
    $production+=$game['modules'][$node->data['faction']][$resourceModule['module']]['ratio']*$resourceModule['input'];
 }
 echo '<div class="cell"><img class="resource" src="templates/'.$_SESSION[$shortTitle.'User']['template'].'/images/resources/'.$key.'.png" title="'.$gl['resources'][$key]['name'].'"></div><div class="cell">'.floor($resource['value']).'/'.$game['factions'][$node->data['faction']]['storage'][$key];
 if ($production) echo ' (+'.$production.$ui['perHour'].')';
 echo '</div>';
 if (($key==2)&&($thisPage!='node.php'))
  echo '</div><div style="border-bottom: 1px solid black; text-align: right;"><div style="display: inline-block;">';
}
echo '</div>';
if ($thisPage!='node.php') echo '</div>';
?>