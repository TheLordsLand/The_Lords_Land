<?php
$db=new db();
$db->create($dbHost, $dbUser, $dbPass, $dbName);
class db
{
 private $db;
 public function create($dbHost, $dbUser, $dbPass, $dbName)
 {
  $this->db=new mysqli($dbHost, $dbUser, $dbPass, $dbName);
  if ($this->db->connect_error) die('Connect Error ('.$this->db->connect_errno .') '.$mysqli->connect_error);
  //$this->db->query("set global transaction isolation level serializable", $this->db);
 }
 public function query($query)
 {
  return $this->db->query($query);
 }
 public static function fetch($result)
 {
  return $result->fetch_array(MYSQLI_ASSOC);
 }
 public function real_escape_string($string)
 {
  return $this->db->real_escape_string($string);
 }
 public function affected_rows()
 {
  return $this->db->affected_rows;
 }
}
 
class misc
{
 public static function clean($string, $type=0)
 {
  global $db;
  if ($type)
   if ($type=='numeric')
    if (!is_numeric($string)) $string=0;
    else $string=floor(abs($string));
  $cleaned=$db->real_escape_string($string);
  $cleaned=htmlspecialchars($cleaned);
  return $cleaned;
 }
 public static function showMessage($message)
 {
  return '<div class="container" style="cursor: pointer;" onClick="this.style.display=\'none\'"><div class="message">'.$message.'</div></div>';
 }
 public static function newId($type)
 {
  global $db;
  $result=$db->query('select min(id) as id from free_ids where type="'.$type.'"');
  $id=db::fetch($result);
  if (isset($id['id']))
  {
   $db->query('delete from free_ids where id="'.$id['id'].'" and type="'.$type.'"');
   return $id['id'];
  }
  else
  {
   $result=$db->query('select max(id) as id from '.$type);
   $id=db::fetch($result);
   if (isset($id['id'])) return $id['id']+1;
   else return 1;
  }
 }
 public static function sToHMS($seconds)
 {
  $h=floor($seconds/3600);
  $m=floor($seconds%3600/60);
  $s=$seconds%3600%60;
  return array($h, $m, $s);
 }
}

class flags
{
 public static function get($index)
 {
  global $db;
  $result=$db->query('select * from flags');
  $flags=array();
  if ($index=='name')
   while ($row=db::fetch($result))
   {
    $flags[$row['name']]=$row['value'];
   }
  else
   for ($i=0; $row=db::fetch($result); $i++) $flags[$i]=$row;
  return $flags;
 }
 public static function set($name, $value)
 {
  global $db;
  $db->query('update flags set value="'.$value.'" where name="'.$name.'"');
  if ($db->affected_rows()>-1) $status='done';
  else $status='error';
  return $status;
 }
}

class activation
{
 public $data;
 public function get($user)
 {
  global $db;
  $result=$db->query('select * from activations where user="'.$user.'"');
  $this->data=db::fetch($result);
  if (isset($this->data['user'])) $status='done';
  else $status='noActivation';
  return $status;
 }
 public function add()
 {
  global $db;
  $db->query('start transaction');
  $db->query('insert into activations (user, code) values ("'.$this->data['user'].'", "'.$this->data['code'].'")');
  if ($db->affected_rows()>-1) $status='done';
  else $status='error';
  $db->query('commit');
  return $status;
 }
 public function activate($code)
 {
  global $db;
  $db->query('start transaction');
  if ($this->data['code']==$code)
  {
   $ok=1;
   $db->query('update users set level=level+1 where id="'.$this->data['user'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from activations where user="'.$this->data['user'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
   $db->query('commit');
  }
  else $status='wrongCode';
  return $status;
 }
}

class grid
{
 public $data=array();
 public function get($x, $y)
 {
  global $db;
  $result=$db->query('select * from grid where (y between '.($y-3).' and '.($y+3).')  and (x between '.($x-3).' and '.($x+3).') order by y desc, x asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->data[$i]=$row;
 }
 public function getAll()
 {
  global $db;
  $result=$db->query('select * from grid order by y desc, x asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->data[$i]=$row;
 }
 public static function getSector($x, $y)
 {
  global $db;
  $result=$db->query('select * from grid where x="'.$x.'" and y="'.$y.'"');
  $sector=db::fetch($result);
  return $sector;
 }
 public function getSectorImage($x, $y, &$i)
 {
  global $shortTitle;
  if ((isset($this->data[$i]))&&($this->data[$i]['x']==$x)&&($this->data[$i]['y']==$y))
   if ($this->data[$i]['type']!=2)
   {
    $output='templates/'.$_SESSION[$shortTitle.'User']['template'].'/images/grid/env_'.$this->data[$i]['type'].$this->data[$i]['id'].'.png';
    if ($i<count($this->data)-1) $i++;
   }
   else
   {
    $output='templates/'.$_SESSION[$shortTitle.'User']['template'].'/images/grid/env_'.$this->data[$i]['type'].'2.png';
    if ($i<count($this->data)-1) $i++;
   }
  else $output='templates/'.$_SESSION[$shortTitle.'User']['template'].'/images/grid/env_x.png';
  return $output;
 }
 public function getSectorLink($x, $y, &$i)
 {
  if ((isset($this->data[$i]))&&($this->data[$i]['x']==$x)&&($this->data[$i]['y']==$y))
  {
   if ($this->data[$i]['type']!=2) $output='href="javascript: getContent(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')" onMouseOver="setSectorData(labels['.$this->data[$i]['type'].'], \'-\', \'-\')" onMouseOut="setSectorData(\'-\', \'-\', \'-\')"';
   else
   {
    $node=new node(); $node->get('id', $this->data[$i]['id']);
    $user=new user(); $user->get('id', $node->data['user']);
    $output='href="javascript: getContent(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')" onMouseOver="setSectorData(\''.$node->data['name'].'\', \''.$user->data['name'].'\', \'-\')" onMouseOut="setSectorData(\'-\', \'-\', \'-\')"';
   }
   if ($i<count($this->data)-1) $i++;
  }
  else $output='href="javascript: getContent(\'getGrid.php\', \'x='.$x.'&y='.$y.'\')"';
  return $output;
 }
}

class user
{
 public $data;
 public function get($idType, $id)
 {
  global $db;
  $result=$db->query('select * from users where '.$idType.'="'.$id.'"');
  $this->data=db::fetch($result);
  if (isset($this->data['id'])) $status='done';
  else $status='noUser';
  return $status;
 }
 public function set()
 {
  global $db;
  $db->query('start transaction');
  $user=new user();
  if ($user->get('id', $this->data['id'])=='done')
  {
   $db->query('update users set name="'.$this->data['name'].'", password="'.$this->data['password'].'", email="'.$this->data['email'].'", level="'.$this->data['level'].'", joined="'.$this->data['joined'].'", lastVisit="'.$this->data['lastVisit'].'", ip="'.$this->data['ip'].'", template="'.$this->data['template'].'", locale="'.$this->data['locale'].'", sitter="'.$this->data['sitter'].'" where id="'.$this->data['id'].'"');
   if ($db->affected_rows()>-1) $status='done';
   else $status='error';
  }
  else $status='noUser';
  $db->query('commit');
  return $status;
 }
 public function add()
 {
  global $db;
  $db->query('start transaction');
  $user=new user();
  if ($user->get('name', $this->data['name'])=='noUser')
   if ($user->get('email', $this->data['email'])=='noUser')
   {
    $this->data['id']=misc::newId('users');
    $db->query('insert into users (id, name, password, email, level, joined, lastVisit, ip, template, locale) values ("'.$this->data['id'].'", "'.$this->data['name'].'", "'.$this->data['password'].'", "'.$this->data['email'].'", "'.$this->data['level'].'", "'.$this->data['joined'].'", "'.$this->data['lastVisit'].'", "'.$this->data['ip'].'", "'.$this->data['template'].'", "'.$this->data['locale'].'")');
    if ($db->affected_rows()>-1) $status='done';
    else $status='error';
   }
   else $status='emailInUse';
  else $status='nameTaken';
  $db->query('commit');
  return $status;
 }
 public static function remove($id)
 {
  global $db;
  $user=new user();
  if ($user->get('id', $id)=='done')
  {
   $result=$db->query('select id from nodes where user="'.$id.'"');
   while ($row=db::fetch($result)) node::remove($row['id']);
   $db->query('start transaction');
   $ok=1;
   $db->query('delete from activations where user="'.$id.'"');
   $messagesResult=$db->query('select id from messages where recipient="'.$id.'" or sender="'.$id.'"');
   while ($row=db::fetch($messagesResult))
   {
    $db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
    if ($db->affected_rows()==-1) $ok=0;
    $db->query('delete from messages where id="'.$row['id'].'"');
    if ($db->affected_rows()==-1) $ok=0;
   }
   $db->query('insert into free_ids (id, type) values ("'.$id.'", "users")');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from users where id="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
   $db->query('commit');
  }
  else $status='noUser';
  return $status;
 }
 public static function removeInactive($maxIdleTime)
 {
  global $db;
  $fromWhen=time()-$maxIdleTime*86400;
  $fromWhen=strftime('%Y-%m-%d %H:%M:%S', $fromWhen);
  $usersResult=$db->query('select id from users where (lastVisit<"'.$fromWhen.'" or level=0) and level<2');
  $pendingCount=$removedCount=0;
  while ($userRow=db::fetch($usersResult))
  {
   $pendingCount++;
   $result=$db->query('select id from nodes where user="'.$userRow['id'].'"');
   while ($row=db::fetch($result)) node::remove($row['id']);
   $db->query('start transaction');
   $ok=1;
   $db->query('delete from activations where user="'.$userRow['id'].'"');
   $messagesResult=$db->query('select id from messages where recipient="'.$userRow['id'].'" or sender="'.$userRow['id'].'"');
   while ($row=db::fetch($messagesResult))
   {
    $db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
    if ($db->affected_rows()==-1) $ok=0;
    $db->query('delete from messages where id="'.$row['id'].'"');
    if ($db->affected_rows()==-1) $ok=0;
   }
   $db->query('insert into free_ids (id, type) values ("'.$userRow['id'].'", "users")');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from users where id="'.$userRow['id'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
   $db->query('commit');
   if ($ok) $removedCount++;
  }
  return array('found'=>$pendingCount, 'removed'=>$removedCount);
 }
 public function resetPassword($email, $newPass)
 {
  global $db, $game;
  $db->query('start transaction');
  if ($this->data['email']==$email)
   if (time()-strtotime($this->data['lastVisit'])>=$game['users']['passwordResetIdle']*60)
   {
    $this->data['lastVisit']=strftime('%Y-%m-%d %H:%M:%S', time());
    $db->query('update users set password=md5("'.$newPass.'"), lastVisit="'.$this->data['lastVisit'].'" where id="'.$this->data['id'].'"');
    if ($db->affected_rows()>-1) $status='done';
    else $status='error';
   }
   else $status='tryAgain';
  else $status='wrongEmail';
  $db->query('commit');
  return $status;
 }
}

class node
{
 public $data, $location, $resources, $technologies, $modules, $components, $queue=array('research', 'build', 'craft', 'train', 'trade');
 public function get($idType, $id)
 {
  global $db;
  $result=$db->query('select * from nodes where '.$idType.'="'.$id.'"');
  $this->data=db::fetch($result);
  if (isset($this->data['id'])) $status='done';
  else $status='noNode';
  return $status;
 }
 public function set()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $setResource=$game['factions'][$this->data['faction']]['node']['setResource'];
  $setCost=$game['factions'][$this->data['faction']]['node']['setCost'];
  if ($this->resources[$setResource]['value']>=$setCost)
  {
   $node=new node();
   if ($node->get('id', $this->data['id'])=='done')
    if ($node->get('name', $this->data['name'])=='noNode')
    {
     $ok=1;
     $db->query('update resources set value=value-'.$setCost.' where node="'.$this->data['id'].'" and id="'.$setResource.'"');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update nodes set name="'.$this->data['name'].'" where id="'.$this->data['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     if ($ok) $status='done';
     else $status='error';
    }
    else $status='nameTaken';
   else $status='noNode';
  }
  else $status='notEnoughResources';
  $db->query('commit');
  return $status;
 }
 public function add()
 {
  global $db, $game, $shortTitle;
  $db->query('start transaction');
  $sector=grid::getSector($this->location['x'], $this->location['y']);
  $node=new node(); $status=0;
  if ($sector['type']==1)
   if ($node->get('name', $this->data['name'])=='noNode')
   {
    $nodes=node::getList($_SESSION[$shortTitle.'User']['id']);
    if (count($nodes)<$game['users']['nodes'])
    {
     $ok=1;
     $this->data['id']=misc::newId('nodes');
     $db->query('insert into nodes (id, faction, user, name, lastCheck) values ("'.$this->data['id'].'", "'.$this->data['faction'].'", "'.$this->data['user'].'", "'.$this->data['name'].'", now())');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update grid set type="2", id="'.$this->data['id'].'" where x="'.$this->location['x'].'" and y="'.$this->location['y'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $query=array();
     $nr=count($game['resources']);
     for ($i=0; $i<$nr; $i++) $query[$i]='("'.$this->data['id'].'", "'.$i.'", "'.$game['factions'][$this->data['faction']]['storage'][$i].'")';
     $db->query('insert into resources (node, id, value) values '.implode(', ', $query));
     if ($db->affected_rows()==-1) $ok=0;
     $query=array();
     $nr=count($game['technologies'][$this->data['faction']]);
     for ($i=0; $i<$nr; $i++) $query[$i]='("'.$this->data['id'].'", "'.$i.'", "0")';
     $db->query('insert into technologies (node, id, value) values '.implode(', ', $query));
     if ($db->affected_rows()==-1) $ok=0;
     $query=array();
     for ($i=0; $i<$game['factions'][$this->data['faction']]['modules']; $i++) $query[$i]='("'.$this->data['id'].'", "'.$i.'", "-1", "0")';
     $db->query('insert into modules (node, slot, module, input) values '.implode(', ', $query));
     if ($db->affected_rows()==-1) $ok=0;
     $query=array();
     $nr=count($game['components'][$this->data['faction']]);
     for ($i=0; $i<$nr; $i++) $query[$i]='("'.$this->data['id'].'", "'.$i.'", "0")';
     $db->query('insert into components (node, id, value) values '.implode(', ', $query));
     if ($db->affected_rows()==-1) $ok=0;
     $query=array();
     $nr=count($game['units'][$this->data['faction']]);
     for ($i=0; $i<$nr; $i++) $query[$i]='("'.$this->data['id'].'", "'.$i.'", "0")';
     $db->query('insert into units (node, id, value) values '.implode(', ', $query));
     if ($db->affected_rows()==-1) $ok=0;
     if ($ok) $status="done";
     else $status='error';
    }
    else $status='maxNodesReached';
   }
   else $status='nameTaken';
  else $status='invalidGridSector';
  $db->query('commit');
  return $status;
 }
 public static function remove($id)
 {
  global $db;
  $db->query('start transaction');
  $node=new node();
  if ($node->get('id', $id)=='done')
  {
   $ok=1;
   $node->getLocation();
   $db->query('delete from research where node="'.$id.'"');
   $db->query('delete from build where node="'.$id.'"');
   $db->query('delete from craft where node="'.$id.'"');
   $db->query('delete from train where node="'.$id.'"');
   $db->query('delete from trade where node="'.$id.'"');
   $db->query('delete from resources where node="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from technologies where node="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from modules where node="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from components where node="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from units where node="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('insert into free_ids (id, type) values ("'.$id.'", "nodes")');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from nodes where id="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('update grid set type="1", id=floor(1+rand()*9) where x="'.$node->location['x'].'" and y="'.$node->location['y'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status="done";
   else $status='error';
  }
  else $status='noNode';
  $db->query('commit');
  return $status;
 }
 public static function getList($userId)
 {
  global $db;
  $result=$db->query('select * from nodes where user="'.$userId.'"');
  $nodes=array();
  for ($i=0; $row=db::fetch($result); $i++)
  {
   $nodes[$i]=new node();
   $nodes[$i]->data=$row;
  }
  return $nodes;
 }
 public function getLocation()
 {
  global $db;
  $result=$db->query('select x, y from grid where type="2" and id="'.$this->data['id'].'"');
  $row=db::fetch($result);
  if (isset($row['x']))
  {
   $this->location=$row;
   $status='done';
  }
  else $status='noNode';
  return $status;
 }
 public function getResources()
 {
  global $db;
  $this->resources=array();
  $result=$db->query('select * from resources where node="'.$this->data['id'].'" order by id asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->resources[$i]=$row;
 }
 public function getTechnologies()
 {
  global $db;
  $this->technologies=array();
  $result=$db->query('select * from technologies where node="'.$this->data['id'].'" order by id asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->technologies[$i]=$row;
 }
 public function getModules()
 {
  global $db;
  $this->modules=array();
  $result=$db->query('select * from modules where node="'.$this->data['id'].'" order by slot asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->modules[$i]=$row;
 }
 public function getComponents()
 {
  global $db;
  $this->components=array();
  $result=$db->query('select * from components where node="'.$this->data['id'].'" order by id asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->components[$i]=$row;
 }
 public function getUnits()
 {
  global $db;
  $this->units=array();
  $result=$db->query('select * from units where node="'.$this->data['id'].'" order by id asc');
  for ($i=0; $row=db::fetch($result); $i++) $this->units[$i]=$row;
 }
 public function getAll()
 {
  $this->getLocation();
  $this->getResources();
  $this->getTechnologies();
  $this->getModules();
  $this->getComponents();
  $this->getUnits();
 }
 public function getQueue($type, $field=0, $values=0)
 {
  global $db;
  $this->queue[$type]=array();
  if ($field)
  {
   $values='('.implode(', ', $values).')';
   $result=$db->query('select * from '.$type.' where node="'.$this->data['id'].'" and '.$field.' in '.$values.' order by start asc');
  }
  else $result=$db->query('select * from '.$type.' where node="'.$this->data['id'].'" order by start asc');
  for ($i=0; $row=db::fetch($result); $i++)
  {
   $this->queue[$type][$i]=$row;
   $this->queue[$type][$i]['start']=strtotime($this->queue[$type][$i]['start']);
  }
 }
 public function addTechnology($technologyId)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $this->getTechnologies();
  $this->getModules();
  $this->getComponents();
  $technology=array();
  if (isset($this->technologies[$technologyId]))
  {
   $okModule=0;
   foreach ($this->modules as $module)
    if ($module['module']==$game['technologies'][$this->data['faction']][$technologyId]['module'])
    {
     $okModule=1;
     break;
    }
   if ($okModule)
    if ($this->technologies[$technologyId]['value']<$game['technologies'][$this->data['faction']][$technologyId]['maxTier'])
    {
     $result=$db->query('select count(*) as count from research where node="'.$this->data['id'].'" and technology="'.$technologyId.'"');
     $row=db::fetch($result);
     if (!$row['count'])
     {
      $technology['requirementsData']=$this->checkRequirements($game['technologies'][$this->data['faction']][$technologyId]['requirements']);
      if ($technology['requirementsData']['ok'])
      {
       $technology['costData']=$this->checkCost($game['technologies'][$this->data['faction']][$technologyId]['cost'], 'research');
       if ($technology['costData']['ok'])
       {
        $technologyList=array();
        $moduleId=$game['technologies'][$this->data['faction']][$technologyId]['module'];
        foreach ($game['technologies'][$this->data['faction']] as $key=>$item)
         if ($item['module']==$moduleId) $technologyList[]=$key;
        $this->getQueue('research', 'technology', $technologyList);
        $lastResearch=count($this->queue['research'])-1;
        if ($lastResearch>-1) $start=strftime('%Y-%m-%d %H:%M:%S', $this->queue['research'][$lastResearch]['start']+floor($this->queue['research'][$lastResearch]['duration']*60));
        else $start=strftime('%Y-%m-%d %H:%M:%S', time());
        $ok=1;
        foreach ($game['technologies'][$this->data['faction']][$technologyId]['cost'] as $cost)
        {
         $db->query('update resources set value=value-'.($cost['value']*$game['users']['cost']['research']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
         if ($db->affected_rows()==-1) $ok=0;
        }
        foreach ($game['technologies'][$this->data['faction']][$technologyId]['requirements'] as $requirement)
         if ($requirement['type']=='components')
         {
          $db->query('update resources set value=value+'.$game['components'][$this->data['faction']][$requirement['id']]['storage'].' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
          if ($db->affected_rows()==-1) $ok=0;
          $db->query('update components set value=value-'.$requirement['value'].' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
          if ($db->affected_rows()==-1) $ok=0;
         }
        $totalIR=0;
        foreach ($this->modules as $key=>$item)
         if ($item['module']==$moduleId) $totalIR+=$item['input']*$game['modules'][$this->data['faction']][$item['module']]['ratio'];
        $duration=$game['technologies'][$this->data['faction']][$technologyId]['duration'];
        $duration=($duration-$duration*$totalIR)*$game['users']['speed']['research'];
        $db->query('insert into research (node, technology, start, duration) values ("'.$this->data['id'].'", "'.$technologyId.'", "'.$start.'", "'.$duration.'")');
        if ($db->affected_rows()==-1) $ok=0;
        if ($ok) $status='done';
        else $status='error';
       }
       else $status='notEnoughResources';
      }
      else $status='requirementsNotMet';
     }
     else $status='technologyBusy';
    }
    else $status='maxTechnologyTierMet';
   else $status='requirementsNotMet';
  }
  else $status='noTechnology';
  $db->query('commit');
  return $status;
 }
 public function cancelTechnology($technologyId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from research where node="'.$this->data['id'].'" and technology="'.$technologyId.'"');
  $entry=db::fetch($result);
  if (isset($entry['start']))
  {
   $entry['start']=strtotime($entry['start']);
   $ok=1;
   foreach ($game['technologies'][$this->data['faction']][$entry['technology']]['cost'] as $cost)
   {
    $db->query('update resources set value=value+'.($cost['value']*$game['users']['cost']['research']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
    if ($db->affected_rows()==-1) $ok=0;
   }
   foreach ($game['technologies'][$this->data['faction']][$entry['technology']]['requirements'] as $requirement)
    if ($requirement['type']=='components')
    {
     $db->query('update resources set value=value-'.$game['components'][$this->data['faction']][$requirement['id']]['storage'].' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update components set value=value+'.$requirement['value'].' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   $technologyList=array();
   $moduleId=$game['technologies'][$this->data['faction']][$technologyId]['module'];
   foreach ($game['technologies'][$this->data['faction']] as $key=>$item)
    if ($item['module']==$moduleId) $technologyList[]=$key;
   $this->getQueue('research', 'technology', $technologyList);
   $entry['duration']=floor($entry['duration']*60);
   foreach ($this->queue['research'] as $queueEntry)
   {
    if ($queueEntry['start']>$entry['start'])
    {
     $db->query('update research set start="'.strftime('%Y-%m-%d %H:%M:%S', $queueEntry['start']-$entry['duration']).'" where node="'.$this->data['id'].'" and technology="'.$queueEntry['technology'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   }
   $db->query('delete from research where node="'.$this->data['id'].'" and technology="'.$technologyId.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
  }
  else $status='noEntry';
  $db->query('commit');
  return $status;
 }
 public function setModule($slotId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from modules where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
  $module=db::fetch($result);
  if (isset($module['module']))
   if ($module['module']>-1)
   {
    $result=$db->query('select * from resources where node="'.$this->data['id'].'" and id="'.$game['modules'][$this->data['faction']][$module['module']]['inputResource'].'"');
    $resource=db::fetch($result);
    if ($resource['value']+$module['input']>=$this->modules[$slotId]['input'])
     if ($this->modules[$slotId]['input']<=$game['modules'][$this->data['faction']][$module['module']]['maxInput'])
     {
      $ok=1;
      $db->query('update resources set value=value+'.$module['input'].'-'.$this->modules[$slotId]['input'].' where node="'.$this->data['id'].'" and id="'.$resource['id'].'"');
      if ($db->affected_rows()==-1) $ok=0;
      $db->query('update modules set input="'.$this->modules[$slotId]['input'].'" where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
      if ($db->affected_rows()==-1) $ok=0;
      $this->checkModuleDependencies($module['module'], $slotId, 1);
      if ($ok) $status='done';
      else $status='error';
     }
     else $status='maxInputExceeded';
    else $status='notEnoughResources';
   }
   else $status='emptySlot';
  else $status='noSlot';
  $db->query('commit');
  return $status;
 }
 public function addModule($slotId, $moduleId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from modules where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
  $module=db::fetch($result);
  if (isset($module['module']))
   if ($module['module']==-1)
   {
    $result=$db->query('select count(*) as count from build where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
    $row=db::fetch($result);
    if (!$row['count'])
    {
     $result=$db->query('select count(*) as count from build where node="'.$this->data['id'].'" and module="'.$moduleId.'"');
     $row=db::fetch($result);
     if ($row['count']<$game['modules'][$this->data['faction']][$moduleId]['maxInstances'])
     {
      $this->getResources();
      $this->getTechnologies();
      $this->getModules();
      $this->getComponents();
      $module['requirementsData']=$this->checkRequirements($game['modules'][$this->data['faction']][$moduleId]['requirements']);
      if ($module['requirementsData']['ok'])
      {
       $module['costData']=$this->checkCost($game['modules'][$this->data['faction']][$moduleId]['cost'], 'build');
       if ($module['costData']['ok'])
       {
        $this->getQueue('build');
        $lastBuild=count($this->queue['build'])-1;
        if ($lastBuild>-1) $start=strftime('%Y-%m-%d %H:%M:%S', $this->queue['build'][$lastBuild]['start']+floor($this->queue['build'][$lastBuild]['duration']*60));
        else $start=strftime('%Y-%m-%d %H:%M:%S', time());
        $ok=1;
        foreach ($game['modules'][$this->data['faction']][$moduleId]['cost'] as $cost)
        {
         $db->query('update resources set value=value-'.($cost['value']*$game['users']['cost']['build']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
         if ($db->affected_rows()==-1) $ok=0;
        }
        foreach ($game['modules'][$this->data['faction']][$moduleId]['requirements'] as $requirement)
         if ($requirement['type']=='components')
         {
          $db->query('update resources set value=value+'.$game['components'][$this->data['faction']][$requirement['id']]['storage'].' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
          if ($db->affected_rows()==-1) $ok=0;
          $db->query('update components set value=value-'.$requirement['value'].' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
          if ($db->affected_rows()==-1) $ok=0;
         }
        $db->query('insert into build (node, slot, module, start, duration) values ("'.$this->data['id'].'", "'.$slotId.'", "'.$moduleId.'", "'.$start.'", "'.($game['modules'][$this->data['faction']][$moduleId]['duration']*$game['users']['speed']['build']).'")');
        if ($db->affected_rows()==-1) $ok=0;
        if ($ok) $status='done';
        else $status='error';
       }
       else $status='notEnoughResources';
      }
      else $status='requirementsNotMet';
     }
     else $status='maxModuleInstancesMet';
    }
    else $status='slotBusy';
   }
   else $status='notEmptySlot';
  else $status='noSlot';
  $db->query('commit');
  return $status;
 }
 public function removeModule($slotId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from modules where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
  $module=db::fetch($result);
  if (isset($module['module']))
   if ($module['module']>-1)
   {
    $result=$db->query('select count(*) as count from build where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
    $row=db::fetch($result);
    if (!$row['count'])
    {
     $this->getQueue('build');
     $lastBuild=count($this->queue['build'])-1;
     if ($lastBuild>-1) $start=strftime('%Y-%m-%d %H:%M:%S', $this->queue['build'][$lastBuild]['start']+floor($this->queue['build'][$lastBuild]['duration']*60));
     else $start=strftime('%Y-%m-%d %H:%M:%S', time());
     $ok=1;
     $db->query('insert into build (node, slot, module, start, duration) values ("'.$this->data['id'].'", "'.$slotId.'", "'.$module['module'].'", "'.$start.'", "'.($game['modules'][$this->data['faction']][$module['module']]['removeDuration']*$game['users']['speed']['build']).'")');
     if ($db->affected_rows()==-1) $ok=0;
     if ($ok) $status='done';
     else $status='error';
    }
    else $status='slotBusy';
   }
   else $status='emptySlot';
  else $status='noSlot';
  $db->query('commit');
  return $status;
 }
 public function cancelModule($slotId)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getModules();
  $result=$db->query('select * from build where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
  $entry=db::fetch($result);
  if (isset($entry['start']))
  {
   $entry['start']=strtotime($entry['start']);
   $ok=1;
   if ($this->modules[$slotId==-1])
   {
    foreach ($game['modules'][$this->data['faction']][$entry['module']]['cost'] as $cost)
    {
     $db->query('update resources set value=value+'.($cost['value']*$game['users']['cost']['build']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
    foreach ($game['modules'][$this->data['faction']][$entry['module']]['requirements'] as $requirement)
     if ($requirement['type']=='components')
     {
      $db->query('update resources set value=value-'.$game['components'][$this->data['faction']][$requirement['id']]['storage'].' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
      if ($db->affected_rows()==-1) $ok=0;
      $db->query('update components set value=value+'.$requirement['value'].' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
      if ($db->affected_rows()==-1) $ok=0;
     }
   }
   $this->getQueue('build');
   $entry['duration']=floor($entry['duration']*60);
   foreach ($this->queue['build'] as $queueEntry)
   {
    if ($queueEntry['start']>$entry['start'])
    {
     $db->query('update build set start="'.strftime('%Y-%m-%d %H:%M:%S', $queueEntry['start']-$entry['duration']).'" where node="'.$this->data['id'].'" and slot="'.$queueEntry['slot'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   }
   $db->query('delete from build where node="'.$this->data['id'].'" and slot="'.$slotId.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
  }
  else $status='noEntry';
  $db->query('commit');
  return $status;
 }
 public function addComponent($componentId, $quantity)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $this->getTechnologies();
  $this->getModules();
  $this->getComponents();
  $component=array();
  if (isset($this->components[$componentId]))
  {
   $okModule=0;
   foreach ($this->modules as $module)
    if ($module['module']==$game['components'][$this->data['faction']][$componentId]['module'])
    {
     $okModule=1;
     break;
    }
   if ($okModule)
   {
    $component['requirementsData']=$this->checkRequirements($game['components'][$this->data['faction']][$componentId]['requirements'], $quantity);
    if ($component['requirementsData']['ok'])
     if ($this->resources[$game['components'][$this->data['faction']][$componentId]['storageResource']]>=$game['components'][$this->data['faction']][$componentId]['storage']*$quantity)
     {
      $component['costData']=$this->checkCost($game['components'][$this->data['faction']][$componentId]['cost'], 'craft', $quantity);
      if ($component['costData']['ok'])
      {
       $componentList=array();
       $moduleId=$game['components'][$this->data['faction']][$componentId]['module'];
       foreach ($game['components'][$this->data['faction']] as $key=>$item)
        if ($item['module']==$moduleId) $componentList[]=$key;
       $this->getQueue('craft', 'component', $componentList);
       $lastCraft=count($this->queue['craft'])-1;
       if ($lastCraft>-1) $start=strftime('%Y-%m-%d %H:%M:%S', $this->queue['craft'][$lastCraft]['start']+floor($this->queue['craft'][$lastCraft]['duration']*60));
       else $start=strftime('%Y-%m-%d %H:%M:%S', time());
       $ok=1;
       $db->query('update resources set value=value-'.($game['components'][$this->data['faction']][$componentId]['storage']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$componentId]['storageResource'].'"');
       if ($db->affected_rows()==-1) $ok=0;
       foreach ($game['components'][$this->data['faction']][$componentId]['cost'] as $cost)
       {
        $db->query('update resources set value=value-'.($cost['value']*$quantity*$game['users']['cost']['craft']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
        if ($db->affected_rows()==-1) $ok=0;
       }
       foreach ($game['components'][$this->data['faction']][$componentId]['requirements'] as $requirement)
        if ($requirement['type']=='components')
        {
         $db->query('update resources set value=value+'.($game['components'][$this->data['faction']][$requirement['id']]['storage']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
         if ($db->affected_rows()==-1) $ok=0;
         $db->query('update components set value=value-'.($requirement['value']*$quantity).' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
         if ($db->affected_rows()==-1) $ok=0;
        }
       $totalIR=0;
       foreach ($this->modules as $key=>$item)
        if ($item['module']==$moduleId) $totalIR+=$item['input']*$game['modules'][$this->data['faction']][$item['module']]['ratio'];
       $duration=$game['components'][$this->data['faction']][$componentId]['duration']*$quantity;
       $duration=($duration-$duration*$totalIR)*$game['users']['speed']['craft'];
       $result=$db->query('select max(id) as id from craft where node="'.$this->data['id'].'"');
       $row=db::fetch($result);
       $id=$row['id']+1;
       $db->query('insert into craft (id, node, component, quantity, start, duration) values ("'.$id.'", "'.$this->data['id'].'", "'.$componentId.'", "'.$quantity.'", "'.$start.'", "'.$duration.'")');
       if ($db->affected_rows()==-1) $ok=0;
       if ($ok) $status='done';
       else $status='error';
      }
      else $status='notEnoughResources';
     }
     else $status='notEnoughStorageResource';
    else $status='requirementsNotMet';
   }
   else $status='requirementsNotMet';
  }
  else $status='noComponent';
  $db->query('commit');
  return $status;
 }
 public function removeComponent($componentId, $quantity)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getComponents();
  $component=array();
  if (isset($this->components[$componentId]))
   if ($this->components[$componentId]['value']>=$quantity)
   {
    $ok=1;
    $this->components[$componentId]['value']-=$quantity;
    if ($this->components[$componentId]['value']<0) $this->components[$componentId]['value']=0;
    $db->query('update resources set value=value+'.($game['components'][$this->data['faction']][$componentId]['storage']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$componentId]['storageResource'].'"');
    if ($db->affected_rows()==-1) $ok=0;
    $db->query('update components set value="'.$this->components[$componentId]['value'].'" where node="'.$this->data['id'].'" and id="'.$componentId.'"');
    if ($db->affected_rows()==-1) $ok=0;
    if ($ok) $status='done';
    else $status='error';
   }
   else $status='notEnoughComponents';
  else $status='noComponent';
  $db->query('commit');
  return $status;
 }
 public function cancelComponent($craftId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from craft where id="'.$craftId.'"');
  $entry=db::fetch($result);
  if (isset($entry['start']))
  {
   $entry['start']=strtotime($entry['start']);
   $ok=1;
   $db->query('update resources set value=value+'.($game['components'][$this->data['faction']][$entry['component']]['storage']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$entry['component']]['storageResource'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   foreach ($game['components'][$this->data['faction']][$entry['component']]['cost'] as $cost)
   {
    $db->query('update resources set value=value+'.($cost['value']*$entry['quantity']*$game['users']['cost']['craft']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
    if ($db->affected_rows()==-1) $ok=0;
   }
   foreach ($game['components'][$this->data['faction']][$entry['component']]['requirements'] as $requirement)
    if ($requirement['type']=='components')
    {
     $db->query('update resources set value=value-'.($game['components'][$this->data['faction']][$requirement['id']]['storage']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update components set value=value+'.($requirement['value']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   $componentList=array();
   $moduleId=$game['components'][$this->data['faction']][$entry['component']]['module'];
   foreach ($game['components'][$this->data['faction']] as $key=>$item)
    if ($item['module']==$moduleId) $componentList[]=$key;
   $this->getQueue('craft', 'component', $componentList);
   $entry['duration']=floor($entry['duration']*60);
   foreach ($this->queue['craft'] as $queueEntry)
   {
    if ($queueEntry['start']>$entry['start'])
    {
     $db->query('update craft set start="'.strftime('%Y-%m-%d %H:%M:%S', $queueEntry['start']-$entry['duration']).'" where id="'.$queueEntry['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   }
   $db->query('delete from craft where id="'.$craftId.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
  }
  else $status='noEntry';
  $db->query('commit');
  return $status;
 }
 public function addUnit($unitId, $quantity)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $this->getTechnologies();
  $this->getModules();
  $this->getUnits();
  $unit=array();
  if (isset($this->units[$unitId]))
  {
   $okModule=0;
   foreach ($this->modules as $module)
    if ($module['module']==$game['units'][$this->data['faction']][$unitId]['module'])
    {
     $okModule=1;
     break;
    }
   if ($okModule)
   {
    $unit['requirementsData']=$this->checkRequirements($game['units'][$this->data['faction']][$unitId]['requirements'], $quantity);
    if ($unit['requirementsData']['ok'])
     if ($this->resources[$game['units'][$this->data['faction']][$unitId]['upkeepResource']]>=$game['units'][$this->data['faction']][$unitId]['upkeep']*$quantity)
     {
      $unit['costData']=$this->checkCost($game['units'][$this->data['faction']][$unitId]['cost'], 'train', $quantity);
      if ($unit['costData']['ok'])
      {
       $unitList=array();
       $moduleId=$game['units'][$this->data['faction']][$unitId]['module'];
       foreach ($game['units'][$this->data['faction']] as $key=>$item)
        if ($item['module']==$moduleId) $unitList[]=$key;
       $this->getQueue('train', 'unit', $unitList);
       $lastTrain=count($this->queue['train'])-1;
       if ($lastTrain>-1) $start=strftime('%Y-%m-%d %H:%M:%S', $this->queue['train'][$lastTrain]['start']+floor($this->queue['train'][$lastTrain]['duration']*60));
       else $start=strftime('%Y-%m-%d %H:%M:%S', time());
       $ok=1;
       $db->query('update resources set value=value-'.($game['units'][$this->data['faction']][$unitId]['upkeep']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['units'][$this->data['faction']][$unitId]['upkeepResource'].'"');
       if ($db->affected_rows()==-1) $ok=0;
       foreach ($game['units'][$this->data['faction']][$unitId]['cost'] as $cost)
       {
        $db->query('update resources set value=value-'.($cost['value']*$quantity*$game['users']['cost']['train']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
        if ($db->affected_rows()==-1) $ok=0;
       }
       foreach ($game['units'][$this->data['faction']][$unitId]['requirements'] as $requirement)
        if ($requirement['type']=='components')
        {
         $db->query('update resources set value=value+'.($game['components'][$this->data['faction']][$requirement['id']]['storage']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
         if ($db->affected_rows()==-1) $ok=0;
         $db->query('update components set value=value-'.($requirement['value']*$quantity).' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
         if ($db->affected_rows()==-1) $ok=0;
        }
       $totalIR=0;
       foreach ($this->modules as $key=>$item)
        if ($item['module']==$moduleId) $totalIR+=$item['input']*$game['modules'][$this->data['faction']][$item['module']]['ratio'];
       $duration=$game['units'][$this->data['faction']][$unitId]['duration']*$quantity;
       $duration=($duration-$duration*$totalIR)*$game['users']['speed']['train'];
       $result=$db->query('select max(id) as id from train where node="'.$this->data['id'].'"');
       $row=db::fetch($result);
       $id=$row['id']+1;
       $db->query('insert into train (id, node, unit, quantity, start, duration) values ("'.$id.'", "'.$this->data['id'].'", "'.$unitId.'", "'.$quantity.'", "'.$start.'", "'.$duration.'")');
       if ($db->affected_rows()==-1) $ok=0;
       if ($ok) $status='done';
       else $status='error';
      }
      else $status='notEnoughResources';
     }
     else $status='notEnoughUpkeepResource';
    else $status='requirementsNotMet';
   }
   else $status='requirementsNotMet';
  }
  else $status='noUnit';
  $db->query('commit');
  return $status;
 }
 public function removeUnit($unitId, $quantity)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getunits();
  $unit=array();
  if (isset($this->units[$unitId]))
   if ($this->units[$unitId]['value']>=$quantity)
   {
    $ok=1;
    $this->units[$unitId]['value']-=$quantity;
    if ($this->units[$unitId]['value']<0) $this->units[$unitId]['value']=0;
    $db->query('update resources set value=value+'.($game['units'][$this->data['faction']][$unitId]['upkeep']*$quantity).' where node="'.$this->data['id'].'" and id="'.$game['units'][$this->data['faction']][$unitId]['upkeepResource'].'"');
    if ($db->affected_rows()==-1) $ok=0;
    $db->query('update units set value="'.$this->units[$unitId]['value'].'" where node="'.$this->data['id'].'" and id="'.$unitId.'"');
    if ($db->affected_rows()==-1) $ok=0;
    if ($ok) $status='done';
    else $status='error';
   }
   else $status='notEnoughUnits';
  else $status='noUnit';
  $db->query('commit');
  return $status;
 }
 public function cancelUnit($trainId)
 {
  global $db, $game;
  $db->query('start transaction');
  $result=$db->query('select * from train where id="'.$trainId.'"');
  $entry=db::fetch($result);
  if (isset($entry['start']))
  {
   $entry['start']=strtotime($entry['start']);
   $ok=1;
   $db->query('update resources set value=value+'.($game['units'][$this->data['faction']][$entry['unit']]['upkeep']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$game['units'][$this->data['faction']][$entry['unit']]['upkeepResource'].'"');
   if ($db->affected_rows()==-1) $ok=0;
   foreach ($game['units'][$this->data['faction']][$entry['unit']]['cost'] as $cost)
   {
    $db->query('update resources set value=value+'.($cost['value']*$entry['quantity']*$game['users']['cost']['train']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
    if ($db->affected_rows()==-1) $ok=0;
   }
   foreach ($game['units'][$this->data['faction']][$entry['unit']]['requirements'] as $requirement)
    if ($requirement['type']=='components')
    {
     $db->query('update resources set value=value-'.($game['components'][$this->data['faction']][$requirement['id']]['storage']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$game['components'][$this->data['faction']][$requirement['id']]['storageResource'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update components set value=value+'.($requirement['value']*$entry['quantity']).' where node="'.$this->data['id'].'" and id="'.$requirement['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   $unitList=array();
   $moduleId=$game['units'][$this->data['faction']][$entry['unit']]['module'];
   foreach ($game['units'][$this->data['faction']] as $key=>$item)
    if ($item['module']==$moduleId) $unitList[]=$key;
   $this->getQueue('train', 'unit', $unitList);
   $entry['duration']=floor($entry['duration']*60);
   foreach ($this->queue['train'] as $queueEntry)
   {
    if ($queueEntry['start']>$entry['start'])
    {
     $db->query('update train set start="'.strftime('%Y-%m-%d %H:%M:%S', $queueEntry['start']-$entry['duration']).'" where id="'.$queueEntry['id'].'"');
     if ($db->affected_rows()==-1) $ok=0;
    }
   }
   $db->query('delete from train where id="'.$trainId.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
  }
  else $status='noEntry';
  $db->query('commit');
  return $status;
 }
 public function checkResources()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $this->getModules();
  foreach ($game['resources'] as $key=>$resource)
   if ($resource['type']=='dynamic')
   {
    $elapsed=(time()-strtotime($this->data['lastCheck']))/3600;
    $production=0;
    foreach ($this->modules as $module)
     if ($module['module']==$resource['module']) $production+=$game['modules'][$this->data['faction']][$module['module']]['ratio']*$module['input'];
    $this->resources[$key]['value']+=$production*$elapsed;
    if ($this->resources[$key]['value']>$game['factions'][$this->data['faction']]['storage'][$key]) $this->resources[$key]['value']=$game['factions'][$this->data['faction']]['storage'][$key];
    $db->query('update resources set value="'.$this->resources[$key]['value'].'" where node="'.$this->data['id'].'" and id="'.$key.'"');
    $db->query('update nodes set lastCheck="'.strftime('%Y-%m-%d %H:%M:%S', time()).'" where id="'.$this->data['id'].'"');
   }
  $db->query('commit');
 }
 public function checkResearch()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getTechnologies();
  $this->getQueue('research');
  foreach ($this->queue['research'] as $entry)
  {
   $entry['end']=$entry['start']+floor($entry['duration']*60);
   if ($entry['end']<=time())
   {
    $this->technologies[$entry['technology']]['value']++;
    $db->query('update technologies set value=value+1 where node="'.$this->data['id'].'" and id="'.$entry['technology'].'"');
    $db->query('delete from research where node="'.$this->data['id'].'" and technology="'.$entry['technology'].'"');
   }
  }
  $db->query('commit');
 }
 public function checkBuild()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getModules();
  $this->getQueue('build');
  foreach ($this->queue['build'] as $entry)
  {
   $entry['end']=$entry['start']+floor($entry['duration']*60);
   if ($entry['end']<=time())
   {
    if ($this->modules[$entry['slot']]['module']==-1)//build module
    {
     $this->modules[$entry['slot']]['module']=$entry['module'];
     $db->query('update modules set module="'.$entry['module'].'" where node="'.$this->data['id'].'" and slot="'.$entry['slot'].'"');
    }
    else//destroy module
    {
     foreach ($game['modules'][$this->data['faction']][$entry['module']]['cost'] as $cost)
      $db->query('update resources set value=value+'.($cost['value']*$game['users']['cost']['build']*$game['modules'][$this->data['faction']][$entry['module']]['salvage']).' where node="'.$this->data['id'].'" and id="'.$cost['resource'].'"');
     if ($this->modules[$entry['slot']]['input']>0)
      $db->query('update resources set value=value+'.$this->modules[$entry['slot']]['input'].' where node="'.$this->data['id'].'" and id="'.$game['modules'][$this->data['faction']][$entry['module']]['input'].'"');
     $this->modules[$entry['slot']]['module']=-1;
     $this->checkModuleDependencies($entry['module'], $entry['slot']);
     $db->query('update modules set module="-1", input="0" where node="'.$this->data['id'].'" and slot="'.$entry['slot'].'"');
    }
    $db->query('delete from build where node="'.$this->data['id'].'" and slot="'.$entry['slot'].'"');
   }
  }
  $db->query('commit');
 }
 public function checkCraft()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getComponents();
  $this->getQueue('craft');
  foreach ($this->queue['craft'] as $entry)
  {
   $entry['end']=$entry['start']+floor($entry['duration']*60);
   if ($entry['end']<=time())
   {
    $this->components[$entry['component']]['value']+=$entry['quantity'];
    $db->query('update components set value=value+'.$entry['quantity'].' where node="'.$this->data['id'].'" and id="'.$entry['component'].'"');
    $db->query('delete from craft where id="'.$entry['id'].'"');
   }
  }
  $db->query('commit');
 }
 public function checkTrain()
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getUnits();
  $this->getQueue('train');
  foreach ($this->queue['train'] as $entry)
  {
   $entry['end']=$entry['start']+floor($entry['duration']*60);
   if ($entry['end']<=time())
   {
    $this->units[$entry['unit']]['value']+=$entry['quantity'];
    $db->query('update units set value=value+'.$entry['quantity'].' where node="'.$this->data['id'].'" and id="'.$entry['unit'].'"');
    $db->query('delete from train where id="'.$entry['id'].'"');
   }
  }
  $db->query('commit');
 }
 public function checkAll()
 {
  $this->checkResources();
  $this->checkResearch();
  $this->checkBuild();
  $this->checkCraft();
  $this->checkTrain();
  //$this->checkTrade();
  //$this->checkCombat();
 }
 public function checkRequirements($requirements, $quantity=1)
 {
  $data=array('ok'=>1, 'requirements'=>$requirements);
  foreach ($data['requirements'] as $key=>$requirement)
   if ($requirement['value'])
    switch ($requirement['type'])
    {
     case 'technologies':
      if ($this->technologies[$requirement['id']]['value']<$requirement['value'])
      {
       $data['requirements'][$key]['ok']=0;
       $data['ok']=0;
      }
      else $data['requirements'][$key]['ok']=1;
     break;
     case 'modules':
      $moduleCount=0;
      foreach ($this->modules as $module)
       if ($module['module']==$requirement['id']) $moduleCount++;
      if ($moduleCount<$requirement['value'])
      {
       $data['requirements'][$key]['ok']=0;
       $data['ok']=0;
      }
      else $data['requirements'][$key]['ok']=1;
     break;
     case 'components':
      if ($this->components[$requirement['id']]['value']<$requirement['value']*$quantity)
      {
       $data['requirements'][$key]['ok']=0;
       $data['ok']=0;
      }
      else $data['requirements'][$key]['ok']=1;
     break;
    }
   else $data['requirements'][$key]['ok']=1;
  return $data;
 }
 public function checkCost($cost, $costType, $quantity=1)
 {
  global $game;
  $data=array('ok'=>1, 'cost'=>$cost);
  foreach ($data['cost'] as $key=>$cost)
   if ($this->resources[$cost['resource']]['value']<$cost['value']*$quantity*$game['users']['cost'][$costType])
   {
    $data['cost'][$key]['ok']=0;
    $data['ok']=0;
   }
   else $data['cost'][$key]['ok']=1;
  return $data;
 }
 private function checkModuleDependencies($moduleId, $slotId, $useOldIR=0)
 {
  global $db, $game;
  switch ($game['modules'][$this->data['faction']][$moduleId]['type'])
  {
   case 'research':
    $technologyList=array();
    foreach ($game['technologies'][$this->data['faction']] as $key=>$technology)
     if ($technology['module']==$moduleId) $technologyList[]=$key;
    $this->getQueue('research', 'technology', $technologyList);
    $nr=count($this->queue['research']);
    if ($nr)
    {
     $newIR=$oldIR=0;
     foreach ($this->modules as $key=>$module)
      if ($module['module']==$moduleId)
      {
       if ($module['slot']!=$slotId) $newIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
       $oldIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
      }
     if ($useOldIR) $newIR=$oldIR;
     for ($i=0; $i<$nr; $i++)
     {
      if ($i) $this->queue['research'][$i]['start']=$this->queue['research'][$i-1]['start']+floor($this->queue['research'][$i-1]['duration']*60);
      $this->queue['research'][$i]['duration']=$game['technologies'][$this->data['faction']][$this->queue['research'][$i]['technology']]['duration'];
      $this->queue['research'][$i]['duration']=($this->queue['research'][$i]['duration']-$this->queue['research'][$i]['duration']*$newIR)*$game['users']['speed']['research'];
      $db->query('update research set start="'.strftime('%Y-%m-%d %H:%M:%S', $this->queue['research'][$i]['start']).'", duration="'.$this->queue['research'][$i]['duration'].'" where node="'.$this->queue['research'][$i]['node'].'" and technology="'.$this->queue['research'][$i]['technology'].'"');
     }
    }
   break;
   case 'craft':
    $componentList=array();
    foreach ($game['components'][$this->data['faction']] as $key=>$component)
     if ($component['module']==$moduleId) $componentList[]=$key;
    $this->getQueue('craft', 'component', $componentList);
    $nr=count($this->queue['craft']);
    if ($nr)
    {
     $newIR=$oldIR=0;
     foreach ($this->modules as $key=>$module)
      if ($module['module']==$moduleId)
      {
       if ($module['slot']!=$slotId) $newIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
       $oldIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
      }
     if ($useOldIR) $newIR=$oldIR;
     for ($i=0; $i<$nr; $i++)
     {
      if ($i) $this->queue['craft'][$i]['start']=$this->queue['craft'][$i-1]['start']+floor($this->queue['craft'][$i-1]['duration']*60);
      $this->queue['craft'][$i]['duration']=$game['components'][$this->data['faction']][$this->queue['craft'][$i]['component']]['duration']*$this->queue['craft'][$i]['quantity'];
      $this->queue['craft'][$i]['duration']=($this->queue['craft'][$i]['duration']-$this->queue['craft'][$i]['duration']*$newIR)*$game['users']['speed']['craft'];
      $db->query('update craft set start="'.strftime('%Y-%m-%d %H:%M:%S', $this->queue['craft'][$i]['start']).'", duration="'.$this->queue['craft'][$i]['duration'].'" where id="'.$this->queue['craft'][$i]['id'].'"');
     }
    }
   break;
   case 'train':
    $unitList=array();
    foreach ($game['units'][$this->data['faction']] as $key=>$unit)
     if ($unit['module']==$moduleId) $unitList[]=$key;
    $this->getQueue('train', 'unit', $unitList);
    $nr=count($this->queue['train']);
    if ($nr)
    {
     $newIR=$oldIR=0;
     foreach ($this->modules as $key=>$module)
      if ($module['module']==$moduleId)
      {
       if ($module['slot']!=$slotId) $newIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
       $oldIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
      }
     if ($useOldIR) $newIR=$oldIR;
     for ($i=0; $i<$nr; $i++)
     {
      if ($i) $this->queue['train'][$i]['start']=$this->queue['train'][$i-1]['start']+floor($this->queue['train'][$i-1]['duration']*60);
      $this->queue['train'][$i]['duration']=$game['units'][$this->data['faction']][$this->queue['train'][$i]['unit']]['duration']*$this->queue['train'][$i]['quantity'];
      $this->queue['train'][$i]['duration']=($this->queue['train'][$i]['duration']-$this->queue['train'][$i]['duration']*$newIR)*$game['users']['speed']['train'];
      $db->query('update train set start="'.strftime('%Y-%m-%d %H:%M:%S', $this->queue['train'][$i]['start']).'", duration="'.$this->queue['train'][$i]['duration'].'" where id="'.$this->queue['train'][$i]['id'].'"');
     }
    }
   break;
   case 'trade':
    $this->getQueue('trade');
    $nr=count($this->queue['trade']);
    if ($nr)
    {
     $newIR=$oldIR=0;
     foreach ($this->modules as $key=>$module)
      if ($module['module']==$moduleId)
      {
       if ($module['slot']!=$slotId) $newIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
       $oldIR+=$module['input']*$game['modules'][$this->data['faction']][$module['module']]['ratio'];
      }
     if ($useOldIR) $newIR=$oldIR;
     for ($i=0; $i<$nr; $i++)
     {
      if ($i) $this->queue['trade'][$i]['start']=$this->queue['trade'][$i-1]['start']+floor($this->queue['trade'][$i-1]['duration']*60);
      $this->queue['trade'][$i]['duration']=$game['users']['speed']['trade']*$this->queue['trade'][$i]['distance'];
      $this->queue['trade'][$i]['duration']=$this->queue['trade'][$i]['duration']-$this->queue['trade'][$i]['duration']*$newIR;
      $db->query('update trade set start="'.strftime('%Y-%m-%d %H:%M:%S', $this->queue['trade'][$i]['start']).'", duration="'.$this->queue['trade'][$i]['duration'].'" where id="'.$this->queue['trade'][$i]['id'].'"');
     }
    }
   break;
  }
 }
 public function move($x, $y)
 {
  global $db, $game;
  $db->query('start transaction');
  $this->getResources();
  $this->getLocation();
  $warpResource=$game['factions'][$this->data['faction']]['node']['warpResource'];
  $warpCost=$game['factions'][$this->data['faction']]['node']['warpCost'];
  $cost=$warpCost*ceil(sqrt(pow($this->location['x']-$x, 2)+pow($this->location['y']-$y, 2)));
  if ($this->resources[$warpResource]['value']>=$cost)
  {
   $node=new node();
   if ($node->get('id', $this->data['id'])=='done')
   {
    $sector=grid::getSector($x, $y);
    if ($sector['type']==1)
    {
     $ok=1;
     $db->query('update grid set type="1", id=floor(1+rand()*9) where x="'.$this->location['x'].'" and y="'.$this->location['y'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $this->location['x']=$x; $this->location['y']=$y;
     $db->query('update grid set type="2", id="'.$this->data['id'].'" where x="'.$this->location['x'].'" and y="'.$this->location['y'].'"');
     if ($db->affected_rows()==-1) $ok=0;
     $db->query('update resources set value=value-'.$cost.' where node="'.$this->data['id'].'" and id="'.$warpResource.'"');
     if ($db->affected_rows()==-1) $ok=0;
     if ($ok) $status='done';
     else $status='error';
    }
    else $status='invalidGridSector';
   }
   else $status='noNode';
  }
  else $status='notEnoughResources';
  $db->query('commit');
  return $status;
 }
 public static function doCombat($data)
 {
  global $game;
  $data['input']['attacker']['hp']=$data['input']['attacker']['damage']=$data['input']['attacker']['armor']=0;
  $data['input']['defender']['hp']=$data['input']['defender']['damage']=$data['input']['defender']['armor']=0;
  foreach ($data['input']['attacker']['groups'] as $key=>$group)
  {
   $data['input']['attacker']['groups'][$key]['hp']=$game['units'][$data['input']['attacker']['faction']][$group['unitId']]['hp']*$group['quantity'];
   $data['input']['attacker']['groups'][$key]['damage']=$game['units'][$data['input']['attacker']['faction']][$group['unitId']]['damage']*$group['quantity'];
   $data['input']['attacker']['groups'][$key]['armor']=$game['units'][$data['input']['attacker']['faction']][$group['unitId']]['armor']*$group['quantity'];
   $data['input']['attacker']['hp']+=$data['input']['attacker']['groups'][$key]['hp'];
   $data['input']['attacker']['damage']+=$data['input']['attacker']['groups'][$key]['damage'];
   $data['input']['attacker']['armor']+=$data['input']['attacker']['groups'][$key]['armor'];
  }
  foreach ($data['input']['defender']['groups'] as $key=>$group)
  {
   $data['input']['defender']['groups'][$key]['hp']=$game['units'][$data['input']['defender']['faction']][$group['unitId']]['hp']*$group['quantity'];
   $data['input']['defender']['groups'][$key]['damage']=$game['units'][$data['input']['defender']['faction']][$group['unitId']]['damage']*$group['quantity'];
   $data['input']['defender']['groups'][$key]['armor']=$game['units'][$data['input']['defender']['faction']][$group['unitId']]['armor']*$group['quantity'];
   $data['input']['defender']['hp']+=$data['input']['defender']['groups'][$key]['hp'];
   $data['input']['defender']['damage']+=$data['input']['defender']['groups'][$key]['damage'];
   $data['input']['defender']['armor']+=$data['input']['defender']['groups'][$key]['armor'];
  }
  $data['input']['attacker']['trueDamage']=max($data['input']['attacker']['damage']-$data['input']['defender']['armor'], 0);
  $data['input']['defender']['trueDamage']=max($data['input']['defender']['damage']-$data['input']['attacker']['armor'], 0);
  if (!$data['input']['attacker']['trueDamage']) $data['output']['attacker']['hitsToWin']=99999999999999999999999;
  else $data['output']['attacker']['hitsToWin']=$data['input']['defender']['hp']/$data['input']['attacker']['trueDamage'];
  if (!$data['input']['defender']['trueDamage']) $data['output']['defender']['hitsToWin']=99999999999999999999999;
  else $data['output']['defender']['hitsToWin']=$data['input']['attacker']['hp']/$data['input']['defender']['trueDamage'];
  if ($data['output']['attacker']['hitsToWin']<$data['output']['defender']['hitsToWin'])
  {
   $data['output']['attacker']['winner']=1;
   $data['output']['defender']['winner']=0;
  }
  else
  {
   $data['output']['attacker']['winner']=0;
   $data['output']['defender']['winner']=1;
  }
  foreach ($data['input']['attacker']['groups'] as $key=>$group)
  {
   if ($data['input']['attacker'][$data['input']['defender']['focus']]) $ratio=$group[$data['input']['defender']['focus']]/$data['input']['attacker'][$data['input']['defender']['focus']];
   else $ratio=0;
   $group['hp']=max($group['hp']-ceil($data['input']['defender']['trueDamage']*$ratio), 0);
   if ($data['input']['attacker']['groups'][$key]['hp']) $ratio=$group['hp']/$data['input']['attacker']['groups'][$key]['hp'];
   else $ratio=0;
   $group['quantity']=floor($data['input']['attacker']['groups'][$key]['quantity']*$ratio);
   $data['output']['attacker']['groups'][$key]=$group;
  }
  foreach ($data['input']['defender']['groups'] as $key=>$group)
  {
   if ($data['input']['defender'][$data['input']['attacker']['focus']]) $ratio=$group[$data['input']['attacker']['focus']]/$data['input']['defender'][$data['input']['attacker']['focus']];
   else $ratio=0;
   $group['hp']=max($group['hp']-ceil($data['input']['attacker']['trueDamage']*$ratio), 0);
   if ($data['input']['defender']['groups'][$key]['hp']) $ratio=$group['hp']/$data['input']['defender']['groups'][$key]['hp'];
   else $ratio=0;
   $group['quantity']=floor($data['input']['defender']['groups'][$key]['quantity']*$ratio);
   $data['output']['defender']['groups'][$key]=$group;
  }
  return $data;
 }
}

class message
{
 public $data;
 public function get($id)
 {
  global $db;
  $result=$db->query('select * from messages where id="'.$id.'"');
  $this->data=db::fetch($result);
  if (isset($this->data['id'])) $status='done';
  else $status='noMessage';
  return $status;
 }
 public function set()
 {
  global $db;
  $db->query('start transaction');
  $message=new message();
  if ($message->get($this->data['id'])=='done')
  {
   $db->query('update messages set viewed="'.$this->data['viewed'].'" where id="'.$this->data['id'].'"');
   if ($db->affected_rows()>-1) $status='done';
   else $status='error';
  }
  else $status='noMessage';
  $db->query('commit');
  return $status;
 }
 public function add()
 {
  global $db;
  $db->query('start transaction');
  $this->data['id']=misc::newId('messages');
  $sent=strftime('%Y-%m-%d %H:%M:%S', time());
  $db->query('insert into messages (id, sender, recipient, subject, body, sent, viewed) values ("'.$this->data['id'].'", "'.$this->data['sender'].'", "'.$this->data['recipient'].'", "'.$this->data['subject'].'", "'.$this->data['body'].'", "'.$sent.'", "'.$this->data['viewed'].'")');
  if ($db->affected_rows()>-1) $status='done';
  else $status='error';
  $db->query('commit');
  return $status;
 }
 public static function remove($id)
 {
  global $db;
  $message=new message();
  if ($message->get($id)=='done')
  {
   $db->query('start transaction');
   $ok=1;
   $db->query('insert into free_ids (id, type) values ("'.$id.'", "messages")');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from messages where id="'.$id.'"');
   if ($db->affected_rows()==-1) $ok=0;
   if ($ok) $status='done';
   else $status='error';
   $db->query('commit');
  }
  else $status='nomessage';
  return $status;
 }
 public static function removeAll($userId)
 {
  global $db;
  $db->query('start transaction');
  $result=$db->query('select id from messages where recipient="'.$userId.'"');
  $ok=1;
  while ($row=db::fetch($result))
  {
   $db->query('insert into free_ids (id, type) values ("'.$row['id'].'", "messages")');
   if ($db->affected_rows()==-1) $ok=0;
   $db->query('delete from messages where id="'.$row['id'].'"');
   if ($db->affected_rows()==-1) $ok=0;
  }
  if ($ok) $status='done';
  else $status='error';
  $db->query('commit');
  return $status;
 }
 public static function getList($recipient, $limit, $offset)
 {
  global $db;
  $db->query('start transaction');
  $messages=array();
  $messages['messages']=array();
  $result=$db->query('select count(*) as count from messages where recipient="'.$recipient.'"');
  $row=db::fetch($result);
  $messages['count']=$row['count'];
  $result=$db->query('select * from messages where recipient="'.$recipient.'" order by sent desc limit '.$limit.' offset '.$offset);
  for ($i=0; $row=db::fetch($result); $i++)
  {
   $messages['messages'][$i]=new message();
   $messages['messages'][$i]->data=$row;
  }
  $db->query('commit');
  return $messages;
 }
 public static function getUnreadCount($recipient)
 {
  global $db;
  $result=$db->query('select count(*) as count from messages where recipient="'.$recipient.'" and viewed=0');
  $row=db::fetch($result);
  return $row['count'];
 }
}
?>