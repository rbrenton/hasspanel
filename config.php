<?php
require_once('icons.php');
require_once('util.php');

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
  'entity' => '%2%',
], array(
  [ 'outdoor-lamp'     , 'Driveway'  , 'switch.togglelinc_an_off_46_e5_13'  ],
  [ 'coach-lamp'       , 'Front Porch', 'switch.togglelinc_an_off_46_e4_15' ],
  [ 'outdoor-lamp'     , 'Lamp Post' , 'switch.togglelinc_an_off_46_e5_7e'  ],
  [ 'ceiling-light'    , 'Garage'    , 'light.garage'                       ],
));

// sensors
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.%2%',
], array(
  [ 'garage-variant'   , 'Garage Door'      , 'sensor.garage_door'                 ],
  [ 'lightning-bolt'   , 'Tesla Charger'    , 'sensor.tesla_wall_connector_status' ],
  [ 'trash-can-outline', 'Trash Service'    , 'sensor.garbage_pickup_desc'         ],
  [ 'recycle-variant'  , 'Recycling Service', 'sensor.recycling_pickup_desc'       ],
  [ 'door-closed', 'Garage Interior Door', 'binary_sensor.alarm_panel_pro_f20444_zone_3' ],
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
