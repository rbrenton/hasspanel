<?php
/**
 * Example configuration for hasspanel
 *
 * Copy this file to config.php and customize for your setup:
 *   cp config.example.php config.php
 */

require_once('icons.php');
require_once('util.php');

// Panel identification
$device = array(
  'node' => 'panel1',           // OpenHASP device name (must match your device)
  'banner' => 'My Home Panel',  // Header text displayed on the panel
);

// Switches - Interactive toggles for lights and switches
// Format: [ 'icon_name', 'Display Label', 'entity_id' ]
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'switch',
  'default' => '0',
  'on_value' => 'On',
  'off_value' => 'Off',
  'entity' => '%2%',
], array(
  [ 'lightbulb',     'Living Room',  'light.living_room'    ],
  [ 'ceiling-light', 'Kitchen',      'light.kitchen'        ],
  [ 'outdoor-lamp',  'Porch Light',  'switch.porch_light'   ],
  [ 'fan',           'Bedroom Fan',  'switch.bedroom_fan'   ],
));

// Sensors - Read-only text display
// Format: [ 'icon_name', 'Display Label', 'entity_id' ]
map_to_rows([
  'icon' => '%0%',
  'label' => '%1%',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => '%2%',
], array(
  [ 'thermometer',   'Temperature',  'sensor.indoor_temperature'  ],
  [ 'water-percent', 'Humidity',     'sensor.indoor_humidity'     ],
  [ 'door-closed',   'Front Door',   'binary_sensor.front_door'   ],
));

// Example with format string for temperature display
/*
$rows[] = array(
  'icon' => $icons['thermometer'],
  'label' => 'Living Room Temp',
  'type' => 'text',
  'default' => 'n/a',
  'entity' => 'sensor.living_room_temperature',
  'format' => '%s°F',
);
*/
