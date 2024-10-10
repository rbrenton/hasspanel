<?php
require_once('icons.php');

function map_to_rows($T, $D) {
  global $rows, $icons;

  foreach ($D as $arr) {
    $row = $T;
    foreach ($row as $k => $v) {
      preg_match_all('/%([0-9]+)%/', $v, $m);
      foreach ($m[0] as $i => $j) 
        $v = preg_replace("/%{$m[1][$i]}%/", $arr[$m[1][$i]], $v);
      if ($k == 'icon') $v = $icons[$v];
      $row[$k] = $v;
    }
    $rows[] = $row;
  }
}

// panel
$device = array(
  'node' => 'indicator1',
  'banner' => 'StricklerHome',
);

// switches
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => 'switch.%2%',
], array(
  [ 'coach-lamp'       , 'Front Porch Light', 'togglelinc_an_off_46_e4_15'  ],
  [ 'outdoor-lamp'     , 'Driveway Light'   , 'togglelinc_an_off_46_e5_13'  ],
));

// sensors
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.%2%',
], array(
  [ 'garage-variant'   , 'Garage Door'      , 'garage_door'                 ],
  [ 'lightning-bolt'   , 'Tesla Charger'    , 'tesla_wall_connector_status' ],
  [ 'trash-can-outline', 'Trash Service'    , 'garbage_pickup_desc'         ],
  [ 'recycle-variant'  , 'Recycling Service', 'recycling_pickup_desc'       ],
));

/*
$rows[] = array(
  'icon' => $icons['thermometer'],
  'label' => 'Living Room Temp',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.downstairs_temperature',
  'format' => '%s°F',
);

$rows[] = array(
  'icon' => $icons['thermometer'],
  'label' => 'Upstairs Temp',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.upstairs_temperature',
  'format' => '%s°F',
);
*/
