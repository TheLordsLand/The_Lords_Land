<?php
//general variables
$game['users']=array(
 'emailActivation'=>1,
 'nodes'=>1,//max nodes per user
 'idle'=>60,//max idle time [days] before auto-deletion
 'passwordResetIdle'=>15,//time between allowed password resets
 'speed'=>array('research'=>1, 'build'=>1, 'craft'=>1, 'train'=>1, 'trade'=>1, 'attack'=>1),//speed mofifiers
 'cost'=>array('research'=>1, 'build'=>1, 'craft'=>1, 'train'=>1, 'trade'=>1, 'attack'=>1)//cost modifiers
);
//resources
$game['resources']=array(
 0=>array('type'=>'dynamic', 'module'=>0),
 1=>array('type'=>'dynamic', 'module'=>1),
 2=>array('type'=>'dynamic', 'module'=>2),
 3=>array('type'=>'static'),
 4=>array('type'=>'static'),
 5=>array('type'=>'static')
);
//factions
$game['factions']=array(
 0=>array('modules'=>9, 'node'=>array('warpResource'=>0, 'warpCost'=>100, 'setResource'=>0, 'setCost'=>500), 'storage'=>array(0=>5000, 1=>5000, 2=>5000, 3=>100, 4=>100, 5=>200)),
 1=>array('modules'=>9, 'node'=>array('warpResource'=>0, 'warpCost'=>100, 'setResource'=>0, 'setCost'=>500), 'storage'=>array(0=>6000, 1=>6000, 2=>6000, 3=>100, 4=>80, 5=>150)),
 2=>array('modules'=>9, 'node'=>array('warpResource'=>0, 'warpCost'=>100, 'setResource'=>0, 'setCost'=>500), 'storage'=>array(0=>4000, 1=>4000, 2=>4000, 3=>100, 4=>150, 5=>250))
);
//technologies per faction
$game['technologies']=array(
 0=>array(//faction 0 technologies
  0=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>500),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  2=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>800)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  3=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>200),
    1=>array('resource'=>1, 'value'=>400),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  )
 ),
 1=>array(//faction 1 technologies
  0=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>500),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  2=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>800)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  3=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>200),
    1=>array('resource'=>1, 'value'=>400),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  )
 ),
 2=>array(//faction 2 technologies
  0=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>500),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  2=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>800)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  3=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>700),
    1=>array('resource'=>1, 'value'=>1000),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>15, 'module'=>8, 'maxTier'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>200),
    1=>array('resource'=>1, 'value'=>400),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  )
 )
);
//modules per faction
$game['modules']=array(
 0=>array(//faction 0 modules
  0=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>7, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  1=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>10, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  2=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>6, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array()
  ),
  3=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  4=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  5=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>400),
    1=>array('resource'=>1, 'value'=>900),
    2=>array('resource'=>2, 'value'=>600)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>3, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>4, 'value'=>1),
    2=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  6=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>5, 'value'=>1),
    1=>array('type'=>'technologies', 'id'=>3, 'value'=>1)
   )
  ),
  7=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>1000),
    1=>array('resource'=>1, 'value'=>2000),
    2=>array('resource'=>2, 'value'=>1500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  ),
  8=>array('type'=>'research', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>800),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  9=>array('type'=>'trade', 'inputResource'=>3, 'ratio'=>0.1, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>600),
    1=>array('resource'=>1, 'value'=>600),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  )
 ),
 1=>array(//faction 1 modules
  0=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>10, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  1=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>7, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  2=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>6, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array()
  ),
  3=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  4=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  5=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>400),
    1=>array('resource'=>1, 'value'=>900),
    2=>array('resource'=>2, 'value'=>600)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>3, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>4, 'value'=>1),
    2=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  6=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>5, 'value'=>1),
    1=>array('type'=>'technologies', 'id'=>3, 'value'=>1)
   )
  ),
  7=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>1000),
    1=>array('resource'=>1, 'value'=>2000),
    2=>array('resource'=>2, 'value'=>1500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  ),
  8=>array('type'=>'research', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>800),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  9=>array('type'=>'trade', 'inputResource'=>3, 'ratio'=>0.1, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>600),
    1=>array('resource'=>1, 'value'=>600),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  )
 ),
 2=>array(//faction 2 modules
  0=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>7, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  1=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>8, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array()
  ),
  2=>array('type'=>'harvest', 'inputResource'=>3, 'ratio'=>8, 'maxInput'=>30, 'duration'=>1, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>300),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array()
  ),
  3=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  4=>array('type'=>'craft', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>5, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>0, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>1, 'value'=>1),
    2=>array('type'=>'modules', 'id'=>2, 'value'=>1),
    3=>array('type'=>'technologies', 'id'=>0, 'value'=>1)
   )
  ),
  5=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>400),
    1=>array('resource'=>1, 'value'=>900),
    2=>array('resource'=>2, 'value'=>600)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>3, 'value'=>1),
    1=>array('type'=>'modules', 'id'=>4, 'value'=>1),
    2=>array('type'=>'technologies', 'id'=>1, 'value'=>1)
   )
  ),
  6=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>300),
    1=>array('resource'=>1, 'value'=>700),
    2=>array('resource'=>2, 'value'=>500)
   ),
   'requirements'=>array(
    0=>array('type'=>'modules', 'id'=>5, 'value'=>1),
    1=>array('type'=>'technologies', 'id'=>3, 'value'=>1)
   )
  ),
  7=>array('type'=>'train', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>1000),
    1=>array('resource'=>1, 'value'=>2000),
    2=>array('resource'=>2, 'value'=>1500)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  ),
  8=>array('type'=>'research', 'inputResource'=>3, 'ratio'=>0.05, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>500),
    1=>array('resource'=>1, 'value'=>800),
    2=>array('resource'=>2, 'value'=>700)
   ),
   'requirements'=>array()
  ),
  9=>array('type'=>'trade', 'inputResource'=>3, 'ratio'=>0.1, 'maxInput'=>10, 'duration'=>10, 'salvage'=>0.5, 'removeDuration'=>1, 'maxInstances'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>600),
    1=>array('resource'=>1, 'value'=>600),
    2=>array('resource'=>2, 'value'=>300)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>4, 'value'=>1)
   )
  )
 )
);
//components per faction
$game['components']=array(
 0=>array(//faction 0 components
  0=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>3),
    1=>array('resource'=>1, 'value'=>3),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  2=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>10),
    1=>array('resource'=>1, 'value'=>10),
    2=>array('resource'=>2, 'value'=>5)
   ),
   'requirements'=>array()
  ),
  3=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  5=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>4),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  6=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>6),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  ),
  7=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>8),
    1=>array('resource'=>1, 'value'=>8),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  )
 ),
 1=>array(//faction 1 components
  0=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>3),
    1=>array('resource'=>1, 'value'=>3),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  2=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>10),
    1=>array('resource'=>1, 'value'=>10),
    2=>array('resource'=>2, 'value'=>5)
   ),
   'requirements'=>array()
  ),
  3=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  5=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>4),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  6=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>6),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  ),
  7=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>8),
    1=>array('resource'=>1, 'value'=>8),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  )
 ),
 2=>array(//faction 2 components
  0=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>3),
    1=>array('resource'=>1, 'value'=>3),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  1=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>3,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  2=>array('duration'=>1, 'module'=>3, 'storageResource'=>4, 'storage'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>10),
    1=>array('resource'=>1, 'value'=>10),
    2=>array('resource'=>2, 'value'=>5)
   ),
   'requirements'=>array()
  ),
  3=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  4=>array('duration'=>1, 'module'=>4, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>5),
    1=>array('resource'=>1, 'value'=>5),
    2=>array('resource'=>2, 'value'=>3)
   ),
   'requirements'=>array()
  ),
  5=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>4),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>2)
   ),
   'requirements'=>array()
  ),
  6=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>6),
    1=>array('resource'=>1, 'value'=>7),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  ),
  7=>array('duration'=>1, 'module'=>4, 'storageResource'=>4, 'storage'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>8),
    1=>array('resource'=>1, 'value'=>8),
    2=>array('resource'=>2, 'value'=>4)
   ),
   'requirements'=>array()
  )
 )
);
//units per faction
$game['units']=array(
 0=>array(//faction 0 units
  0=>array('hp'=>30, 'damage'=>10, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>20)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  1=>array('hp'=>30, 'damage'=>11, 'armor'=>7, 'speed'=>8, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>30),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  2=>array('hp'=>25, 'damage'=>15, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  3=>array('hp'=>30, 'damage'=>12, 'armor'=>10, 'speed'=>7, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  4=>array('hp'=>35, 'damage'=>13, 'armor'=>12, 'speed'=>5, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>70),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>4, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  5=>array('hp'=>25, 'damage'=>30, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>50),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>5, 'value'=>1)
   )
  ),
  6=>array('hp'=>25, 'damage'=>40, 'armor'=>7, 'speed'=>10, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>50)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>6, 'value'=>1)
   )
  ),
  7=>array('hp'=>60, 'damage'=>14, 'armor'=>10, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>120),
    2=>array('resource'=>2, 'value'=>150)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  8=>array('hp'=>60, 'damage'=>13, 'armor'=>12, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>140),
    2=>array('resource'=>2, 'value'=>170)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>2),
    1=>array('type'=>'components', 'id'=>4, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  9=>array('hp'=>70, 'damage'=>14, 'armor'=>15, 'speed'=>22, 'duration'=>3, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>170),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>2),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  10=>array('hp'=>25, 'damage'=>10, 'armor'=>3, 'speed'=>17, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  11=>array('hp'=>20, 'damage'=>5, 'armor'=>1, 'speed'=>10, 'duration'=>0.5, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>70),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  12=>array('hp'=>25, 'damage'=>8, 'armor'=>2, 'speed'=>11, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  13=>array('hp'=>35, 'damage'=>12, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>120),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  14=>array('hp'=>25, 'damage'=>15, 'armor'=>2, 'speed'=>14, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  15=>array('hp'=>30, 'damage'=>20, 'armor'=>5, 'speed'=>15, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  16=>array('hp'=>25, 'damage'=>7, 'armor'=>2, 'speed'=>17, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  )
 ),
 1=>array(//faction 1 units
  0=>array('hp'=>30, 'damage'=>10, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>20)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  1=>array('hp'=>30, 'damage'=>11, 'armor'=>7, 'speed'=>8, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>30),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  2=>array('hp'=>25, 'damage'=>15, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  3=>array('hp'=>30, 'damage'=>12, 'armor'=>10, 'speed'=>7, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  4=>array('hp'=>35, 'damage'=>13, 'armor'=>12, 'speed'=>5, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>70),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>4, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  5=>array('hp'=>25, 'damage'=>30, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>50),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>5, 'value'=>1)
   )
  ),
  6=>array('hp'=>25, 'damage'=>40, 'armor'=>7, 'speed'=>10, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>50)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>6, 'value'=>1)
   )
  ),
  7=>array('hp'=>60, 'damage'=>14, 'armor'=>10, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>120),
    2=>array('resource'=>2, 'value'=>150)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  8=>array('hp'=>60, 'damage'=>13, 'armor'=>12, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>140),
    2=>array('resource'=>2, 'value'=>170)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>2),
    1=>array('type'=>'components', 'id'=>4, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  9=>array('hp'=>70, 'damage'=>14, 'armor'=>15, 'speed'=>22, 'duration'=>3, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>170),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>2),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  10=>array('hp'=>25, 'damage'=>10, 'armor'=>3, 'speed'=>17, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  11=>array('hp'=>20, 'damage'=>5, 'armor'=>1, 'speed'=>10, 'duration'=>0.5, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>70),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  12=>array('hp'=>25, 'damage'=>8, 'armor'=>2, 'speed'=>11, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  13=>array('hp'=>35, 'damage'=>12, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>120),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  14=>array('hp'=>25, 'damage'=>15, 'armor'=>2, 'speed'=>14, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  15=>array('hp'=>30, 'damage'=>20, 'armor'=>5, 'speed'=>15, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  16=>array('hp'=>25, 'damage'=>7, 'armor'=>2, 'speed'=>17, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  )
 ),
 2=>array(//faction 2 units
  0=>array('hp'=>30, 'damage'=>10, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>20)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  1=>array('hp'=>30, 'damage'=>11, 'armor'=>7, 'speed'=>8, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>30),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  2=>array('hp'=>25, 'damage'=>15, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>20),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  3=>array('hp'=>30, 'damage'=>12, 'armor'=>10, 'speed'=>7, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>1),
    1=>array('type'=>'components', 'id'=>3, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  4=>array('hp'=>35, 'damage'=>13, 'armor'=>12, 'speed'=>5, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>70),
    2=>array('resource'=>2, 'value'=>100)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>4, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  5=>array('hp'=>25, 'damage'=>30, 'armor'=>3, 'speed'=>15, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>50),
    2=>array('resource'=>2, 'value'=>40)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>5, 'value'=>1)
   )
  ),
  6=>array('hp'=>25, 'damage'=>40, 'armor'=>7, 'speed'=>10, 'duration'=>2, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>30),
    1=>array('resource'=>1, 'value'=>40),
    2=>array('resource'=>2, 'value'=>50)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>6, 'value'=>1)
   )
  ),
  7=>array('hp'=>60, 'damage'=>14, 'armor'=>10, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>120),
    2=>array('resource'=>2, 'value'=>150)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>0, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>1),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1)
   )
  ),
  8=>array('hp'=>60, 'damage'=>13, 'armor'=>12, 'speed'=>25, 'duration'=>2, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>140),
    2=>array('resource'=>2, 'value'=>170)
   ),
   'requirements'=>array(
    0=>array('type'=>'components', 'id'=>1, 'value'=>2),
    1=>array('type'=>'components', 'id'=>4, 'value'=>1),
    2=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  9=>array('hp'=>70, 'damage'=>14, 'armor'=>15, 'speed'=>22, 'duration'=>3, 'module'=>6, 'upkeepResource'=>5, 'upkeep'=>2,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>170),
    2=>array('resource'=>2, 'value'=>200)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>1, 'value'=>2),
    2=>array('type'=>'components', 'id'=>7, 'value'=>1),
    3=>array('type'=>'components', 'id'=>2, 'value'=>1)
   )
  ),
  10=>array('hp'=>25, 'damage'=>10, 'armor'=>3, 'speed'=>17, 'duration'=>1, 'module'=>5, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>50),
    1=>array('resource'=>1, 'value'=>20),
    2=>array('resource'=>2, 'value'=>30)
   ),
   'requirements'=>array(
    0=>array('type'=>'technologies', 'id'=>2, 'value'=>1),
    1=>array('type'=>'components', 'id'=>0, 'value'=>1),
    2=>array('type'=>'components', 'id'=>3, 'value'=>2)
   )
  ),
  11=>array('hp'=>20, 'damage'=>5, 'armor'=>1, 'speed'=>10, 'duration'=>0.5, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>70),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  12=>array('hp'=>25, 'damage'=>8, 'armor'=>2, 'speed'=>11, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  13=>array('hp'=>35, 'damage'=>12, 'armor'=>5, 'speed'=>10, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>120),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  14=>array('hp'=>25, 'damage'=>15, 'armor'=>2, 'speed'=>14, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>100),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  15=>array('hp'=>30, 'damage'=>20, 'armor'=>5, 'speed'=>15, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>130),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  ),
  16=>array('hp'=>25, 'damage'=>7, 'armor'=>2, 'speed'=>17, 'duration'=>1, 'module'=>7, 'upkeepResource'=>5, 'upkeep'=>1,
   'cost'=>array(
    0=>array('resource'=>0, 'value'=>110),
    1=>array('resource'=>1, 'value'=>0),
    2=>array('resource'=>2, 'value'=>0)
   ),
   'requirements'=>array()
  )
 )
);
?>